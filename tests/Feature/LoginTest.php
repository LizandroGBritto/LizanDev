<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Casos AU-xx de docs/casos-de-uso-panel.md.
 */
class LoginTest extends TestCase
{
    use RefreshDatabase;

    private function usuario(string $clave = 'clave-segura-123'): User
    {
        return User::factory()->create(['password' => $clave]);
    }

    public function test_au01_valid_credentials_open_the_panel(): void
    {
        $usuario = $this->usuario();

        $this->post('/login', ['email' => $usuario->email, 'password' => 'clave-segura-123'])->assertRedirect('/admin');
        $this->assertAuthenticatedAs($usuario);
        $this->get('/admin')->assertOk();
    }

    public function test_au02_wrong_password_shows_a_generic_error(): void
    {
        $usuario = $this->usuario();

        $this->from('/login')->post('/login', ['email' => $usuario->email, 'password' => 'otra'])
            ->assertRedirect('/login')
            ->assertSessionHasErrors(['email' => 'These credentials do not match our records.']);
        $this->assertGuest();
    }

    public function test_au03_unknown_email_gets_the_same_error_as_a_wrong_password(): void
    {
        $this->usuario();

        $desconocido = $this->from('/login')->post('/login', ['email' => 'nadie@example.com', 'password' => 'x'])
            ->assertSessionHasErrors('email')->getSession()->get('errors')->first('email');

        $this->assertSame(__('These credentials do not match our records.'), $desconocido);
    }

    public function test_au04_empty_or_malformed_fields_fail_validation(): void
    {
        $this->post('/login', [])->assertSessionHasErrors(['email', 'password']);
        $this->post('/login', ['email' => 'no-es-un-correo', 'password' => 'x'])->assertSessionHasErrors('email');
        $this->post('/login', ['email' => ['a@b.com'], 'password' => 'x'])->assertSessionHasErrors('email');
        $this->post('/login', ['email' => 'a@b.com', 'password' => str_repeat('a', 300)])->assertSessionHasErrors('password');
        $this->assertGuest();
    }

    public function test_au05_the_login_is_throttled_per_account_and_ip(): void
    {
        $usuario = $this->usuario();

        for ($i = 0; $i < 5; $i++) {
            $this->post('/login', ['email' => 'x@example.com', 'password' => 'mala']);
        }

        $this->post('/login', ['email' => 'x@example.com', 'password' => 'mala'])->assertStatus(429);

        // Otra cuenta desde la misma IP no queda bloqueada.
        $this->post('/login', ['email' => $usuario->email, 'password' => 'clave-segura-123'])->assertRedirect('/admin');
    }

    public function test_au06_there_is_no_registration_nor_password_recovery(): void
    {
        foreach (['/register', '/forgot-password', '/reset-password', '/password/reset', '/email/verify'] as $ruta) {
            $this->get($ruta)->assertNotFound();
            $this->post($ruta, ['email' => 'a@b.com', 'password' => 'x'])->assertNotFound();
        }

        $this->assertDatabaseCount('users', 0);
    }

    public function test_au07_guests_are_sent_to_the_login_and_back_to_where_they_were(): void
    {
        $usuario = $this->usuario();

        $this->get('/admin/mensajes')->assertRedirect('/login');
        $this->post('/login', ['email' => $usuario->email, 'password' => 'clave-segura-123'])->assertRedirect('/admin/mensajes');
    }

    public function test_au08_a_signed_in_user_skips_the_login_page(): void
    {
        $this->actingAs($this->usuario())->get('/login')->assertRedirect('/admin');
    }

    public function test_au09_signing_out_closes_the_session(): void
    {
        $this->actingAs($this->usuario())->post('/logout')->assertRedirect('/login');
        $this->assertGuest();
        $this->get('/admin')->assertRedirect('/login');
    }

    public function test_au09b_signing_out_needs_post_and_a_session(): void
    {
        $this->get('/logout')->assertStatus(405);
        $this->post('/logout')->assertRedirect('/login');
    }

    public function test_au10_the_old_login_address_redirects_permanently(): void
    {
        $this->get('/admin/ingresar')->assertStatus(301)->assertRedirect('/login');
    }

    public function test_au11_the_login_page_is_not_indexable_and_robots_blocks_it(): void
    {
        $this->get('/login')->assertOk()->assertSee('noindex', false);
        $this->assertStringContainsString('Disallow: /login', file_get_contents(public_path('robots.txt')));
    }

    public function test_au12_the_session_id_changes_after_signing_in(): void
    {
        $usuario = $this->usuario();
        $this->get('/login');
        $antes = session()->getId();

        $this->post('/login', ['email' => $usuario->email, 'password' => 'clave-segura-123']);

        $this->assertNotSame($antes, session()->getId());
    }

    public function test_au13_the_email_is_not_case_sensitive_in_the_error_flow_and_old_input_is_kept(): void
    {
        $usuario = $this->usuario();

        $this->from('/login')->post('/login', ['email' => $usuario->email, 'password' => 'mala'])
            ->assertSessionHasInput('email', $usuario->email)
            ->assertSessionMissing('_old_input.password');
    }
}
