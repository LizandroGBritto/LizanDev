<?php

namespace Tests\Feature;

use App\Livewire\Portfolio\Contact;
use App\Models\MensajeContacto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Livewire;
use Tests\TestCase;

class ContactoTest extends TestCase
{
    use RefreshDatabase;

    private function formulario(array $campos = [])
    {
        return Livewire::test(Contact::class)
            ->set('nombre', $campos['nombre'] ?? 'Ana Gómez')
            ->set('correo', $campos['correo'] ?? 'ana@example.com')
            ->set('mensaje', $campos['mensaje'] ?? 'Hola, me gustaría hablar de un proyecto.')
            ->set('sitioWeb', $campos['sitioWeb'] ?? '')
            ->set('recaptchaToken', $campos['token'] ?? '');
    }

    private function configurarRecaptcha(): void
    {
        config([
            'services.recaptcha.site_key' => 'clave-publica',
            'services.recaptcha.secret_key' => 'clave-secreta',
            'services.recaptcha.minimum_score' => 0.5,
        ]);
    }

    public function test_it_saves_the_message_when_recaptcha_approves(): void
    {
        $this->configurarRecaptcha();
        Http::fake(['www.google.com/*' => Http::response(['success' => true, 'score' => 0.9, 'action' => 'contacto'])]);

        $this->formulario(['token' => 'token-valido'])->call('submit')->assertHasNoErrors();

        $mensaje = MensajeContacto::sole();
        $this->assertSame('Ana Gómez', $mensaje->nombre);
        $this->assertSame('ana@example.com', $mensaje->correo);
        $this->assertSame(0.9, $mensaje->puntaje_recaptcha);
        $this->assertNull($mensaje->leido_en);

        Http::assertSent(fn ($request) => $request['secret'] === 'clave-secreta' && $request['response'] === 'token-valido');
    }

    public function test_it_rejects_a_low_score(): void
    {
        $this->configurarRecaptcha();
        Http::fake(['www.google.com/*' => Http::response(['success' => true, 'score' => 0.1, 'action' => 'contacto'])]);

        $this->formulario(['token' => 'token'])->call('submit')->assertHasErrors('mensaje');

        $this->assertSame(0, MensajeContacto::count());
    }

    public function test_it_rejects_a_token_for_another_action(): void
    {
        $this->configurarRecaptcha();
        Http::fake(['www.google.com/*' => Http::response(['success' => true, 'score' => 0.9, 'action' => 'login'])]);

        $this->formulario(['token' => 'token'])->call('submit')->assertHasErrors('mensaje');

        $this->assertSame(0, MensajeContacto::count());
    }

    public function test_it_rejects_a_missing_token_without_calling_google(): void
    {
        $this->configurarRecaptcha();
        Http::fake();

        $this->formulario()->call('submit')->assertHasErrors('mensaje');

        Http::assertNothingSent();
        $this->assertSame(0, MensajeContacto::count());
    }

    public function test_it_fails_closed_in_production_without_keys(): void
    {
        $this->app['env'] = 'production';

        $this->formulario()->call('submit')->assertHasErrors('mensaje');

        $this->assertSame(0, MensajeContacto::count());
    }

    public function test_the_honeypot_discards_the_message_silently(): void
    {
        $this->formulario(['sitioWeb' => 'https://spam.example'])->call('submit')->assertHasNoErrors();

        $this->assertSame(0, MensajeContacto::count());
    }

    public function test_it_validates_the_fields(): void
    {
        Livewire::test(Contact::class)
            ->set('nombre', 'A')
            ->set('correo', 'no-es-un-correo')
            ->set('mensaje', 'corto')
            ->call('submit')
            ->assertHasErrors(['nombre', 'correo', 'mensaje']);
    }

    public function test_an_email_without_a_real_domain_is_refused(): void
    {
        foreach (['ana@localhost', 'ana@b', 'ana@x.', 'ana @example.com'] as $correo) {
            $this->formulario(['correo' => $correo])->call('submit')->assertHasErrors('correo');
        }

        $this->assertSame(0, MensajeContacto::count());
    }

    public function test_spaces_around_the_fields_are_trimmed_and_do_not_count(): void
    {
        $this->configurarRecaptcha();
        Http::fake(['www.google.com/*' => Http::response(['success' => true, 'score' => 0.9, 'action' => 'contacto'])]);

        $this->formulario(['nombre' => '  Ana Gómez  ', 'correo' => ' ana@example.com ', 'token' => 'tok'])->call('submit')->assertHasNoErrors();
        $this->assertSame('Ana Gómez', MensajeContacto::sole()->nombre);

        $this->formulario(['mensaje' => '      hola      '])->call('submit')->assertHasErrors('mensaje');
        $this->formulario(['nombre' => '     '])->call('submit')->assertHasErrors('nombre');
    }

    public function test_errors_are_readable_and_translated_without_internal_field_names(): void
    {
        app()->setLocale('es');

        $html = $this->formulario(['nombre' => '', 'correo' => 'nada', 'mensaje' => 'corto'])->call('submit')->html();

        $this->assertStringContainsString('Escribe tu nombre.', $html);
        $this->assertStringContainsString('Escribe un correo válido, como nombre@ejemplo.com.', $html);
        $this->assertStringContainsString('Tu mensaje debe tener al menos 10 caracteres.', $html);
        $this->assertStringNotContainsString('field is required', $html);
        $this->assertStringContainsString('aria-invalid="true"', $html);
    }

    public function test_required_fields_are_marked_in_the_form(): void
    {
        $html = $this->get('/')->getContent();

        $this->assertStringContainsString('Fields marked with * are required.', $html);
        $this->assertSame(3, substr_count($html, 'aria-hidden="true">*</span>'));
    }

    public function test_it_limits_how_many_messages_one_ip_can_send(): void
    {
        for ($i = 0; $i < 5; $i++) {
            RateLimiter::hit('contacto:127.0.0.1', 3600);
        }

        $this->formulario()->call('submit')->assertHasErrors('mensaje');

        $this->assertSame(0, MensajeContacto::count());
    }

    public function test_the_form_only_loads_recaptcha_when_it_is_configured(): void
    {
        $this->get('/')->assertDontSee('data-recaptcha-site-key', false);

        $this->configurarRecaptcha();

        $this->get('/')
            ->assertSee('data-recaptcha-site-key="clave-publica"', false)
            ->assertSee('Protected by reCAPTCHA', false);
    }
}
