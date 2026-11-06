<?php

namespace Tests\Feature;

use App\Models\MensajeContacto;
use App\Models\User;
use Database\Seeders\AdministradorSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    private function mensaje(array $campos = []): MensajeContacto
    {
        return MensajeContacto::unguarded(fn () => MensajeContacto::create($campos + [
            'nombre' => 'Ana Gómez',
            'correo' => 'ana@example.com',
            'mensaje' => 'Hola, quiero cotizar un sitio.',
            'idioma' => 'es',
            'ip' => '127.0.0.1',
        ]));
    }

    public function test_guests_are_sent_to_the_login(): void
    {
        $this->get('/admin')->assertRedirect('/admin/ingresar');
        $this->get('/admin/mensajes')->assertRedirect('/admin/ingresar');
        $this->patch('/admin/mensajes/1/leido')->assertRedirect('/admin/ingresar');
        $this->delete('/admin/mensajes/1')->assertRedirect('/admin/ingresar');
    }

    public function test_the_login_page_is_not_indexable(): void
    {
        $this->get('/admin/ingresar')->assertOk()->assertSee('noindex', false);
    }

    public function test_the_administrator_can_sign_in_and_out(): void
    {
        $usuario = User::factory()->create(['password' => 'clave-segura-123']);

        $this->post('/admin/ingresar', ['email' => $usuario->email, 'password' => 'clave-segura-123'])
            ->assertRedirect('/admin/mensajes');
        $this->assertAuthenticatedAs($usuario);

        $this->post('/admin/salir')->assertRedirect('/admin/ingresar');
        $this->assertGuest();
    }

    public function test_wrong_credentials_are_rejected(): void
    {
        $usuario = User::factory()->create(['password' => 'clave-segura-123']);

        $this->from('/admin/ingresar')
            ->post('/admin/ingresar', ['email' => $usuario->email, 'password' => 'otra'])
            ->assertRedirect('/admin/ingresar')
            ->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_the_login_is_throttled(): void
    {
        for ($i = 0; $i < 5; $i++) {
            $this->post('/admin/ingresar', ['email' => 'x@example.com', 'password' => 'mala']);
        }

        $this->post('/admin/ingresar', ['email' => 'x@example.com', 'password' => 'mala'])->assertStatus(429);
    }

    public function test_signed_in_users_skip_the_login_page(): void
    {
        $this->actingAs(User::factory()->create())->get('/admin/ingresar')->assertRedirect('/admin/mensajes');
    }

    public function test_the_administrator_sees_the_requests_and_the_unread_count(): void
    {
        $this->mensaje(['nombre' => 'Ana Gómez']);
        $this->mensaje(['nombre' => 'Luis Pérez', 'leido_en' => now()]);

        $this->actingAs(User::factory()->create())
            ->get('/admin/mensajes')
            ->assertOk()
            ->assertSee('Ana Gómez')
            ->assertSee('Luis Pérez')
            ->assertSee('1 unread message');
    }

    public function test_the_unread_filter_hides_read_requests(): void
    {
        $this->mensaje(['nombre' => 'Ana Gómez']);
        $this->mensaje(['nombre' => 'Luis Pérez', 'leido_en' => now()]);

        $this->actingAs(User::factory()->create())
            ->get('/admin/mensajes?filtro=sin-leer')
            ->assertSee('Ana Gómez')
            ->assertDontSee('Luis Pérez');
    }

    public function test_message_content_is_escaped(): void
    {
        $this->mensaje(['mensaje' => '<script>alert(1)</script>']);

        $this->actingAs(User::factory()->create())
            ->get('/admin/mensajes')
            ->assertDontSee('<script>alert(1)</script>', false)
            ->assertSee('&lt;script&gt;alert(1)&lt;/script&gt;', false);
    }

    public function test_a_request_can_be_marked_read_and_unread(): void
    {
        $mensaje = $this->mensaje();
        $this->actingAs(User::factory()->create());

        $this->patch("/admin/mensajes/{$mensaje->id}/leido")->assertRedirect();
        $this->assertTrue($mensaje->fresh()->estaLeido());

        $this->patch("/admin/mensajes/{$mensaje->id}/leido");
        $this->assertFalse($mensaje->fresh()->estaLeido());
    }

    public function test_a_request_can_be_deleted(): void
    {
        $mensaje = $this->mensaje();

        $this->actingAs(User::factory()->create())->delete("/admin/mensajes/{$mensaje->id}")->assertRedirect();

        $this->assertModelMissing($mensaje);
    }

    public function test_the_seeder_creates_the_administrator_from_the_environment(): void
    {
        config(['panel.administrador' => ['nombre' => 'Panel', 'correo' => 'panel@example.com', 'clave' => 'clave-del-seeder']]);

        $this->seed(AdministradorSeeder::class);

        $this->post('/admin/ingresar', ['email' => 'panel@example.com', 'password' => 'clave-del-seeder'])
            ->assertRedirect('/admin/mensajes');
    }
}
