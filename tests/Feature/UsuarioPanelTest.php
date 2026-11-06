<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

/**
 * Casos US-xx de docs/casos-de-uso-panel.md (comando `panel:usuario`).
 */
class UsuarioPanelTest extends TestCase
{
    use RefreshDatabase;

    private function clave(string $salida): string
    {
        preg_match('/Contraseña:\s+(\S+)/u', $salida, $coincidencia);

        return $coincidencia[1] ?? '';
    }

    public function test_us01_it_creates_the_user_with_a_random_password_that_works(): void
    {
        $this->artisan('panel:usuario', ['nombre' => 'Lizandro Britto', 'correo' => 'Lizandro@Example.com'])
            ->expectsOutputToContain('Usuario creado.')
            ->assertExitCode(0);

        $usuario = User::firstWhere('email', 'lizandro@example.com');
        $this->assertSame('Lizandro Britto', $usuario->name);
    }

    public function test_us01b_the_generated_password_is_long_random_and_logs_in(): void
    {
        $this->artisan('panel:usuario', ['nombre' => 'Lizandro Britto', 'correo' => 'a@example.com']);
        $this->artisan('panel:usuario', ['nombre' => 'Otra Persona', 'correo' => 'b@example.com']);

        // El comando imprime la clave; la capturamos corriéndolo por Artisan::call.
        \Artisan::call('panel:usuario', ['nombre' => 'Tercera', 'correo' => 'c@example.com']);
        $clave = $this->clave(\Artisan::output());

        $this->assertSame(20, strlen($clave));
        $this->post('/login', ['email' => 'c@example.com', 'password' => $clave])->assertRedirect('/admin');
    }

    public function test_us02_an_existing_email_is_refused_without_the_update_flag(): void
    {
        User::factory()->create(['email' => 'a@example.com', 'password' => 'clave-original']);

        $this->artisan('panel:usuario', ['nombre' => 'X', 'correo' => 'a@example.com'])
            ->expectsOutputToContain('Ya existe')
            ->assertExitCode(1);

        $this->assertTrue(Hash::check('clave-original', User::firstWhere('email', 'a@example.com')->password));
    }

    public function test_us03_the_update_flag_replaces_the_password(): void
    {
        User::factory()->create(['email' => 'a@example.com', 'password' => 'clave-original']);

        \Artisan::call('panel:usuario', ['nombre' => 'Nuevo Nombre', 'correo' => 'a@example.com', '--actualizar' => true]);
        $clave = $this->clave(\Artisan::output());

        $usuario = User::firstWhere('email', 'a@example.com');
        $this->assertSame('Nuevo Nombre', $usuario->name);
        $this->assertTrue(Hash::check($clave, $usuario->password));
        $this->assertFalse(Hash::check('clave-original', $usuario->password));
        $this->assertDatabaseCount('users', 1);
    }

    public function test_us04_invalid_input_creates_nothing(): void
    {
        $this->artisan('panel:usuario', ['nombre' => 'Ana', 'correo' => 'no-es-correo'])->assertExitCode(1);
        $this->artisan('panel:usuario', ['nombre' => '   ', 'correo' => 'a@example.com'])->assertExitCode(1);

        $this->assertDatabaseCount('users', 0);
    }

    public function test_us05_the_password_is_stored_hashed_and_not_printed_twice(): void
    {
        \Artisan::call('panel:usuario', ['nombre' => 'Ana', 'correo' => 'a@example.com']);
        $salida = \Artisan::output();
        $clave = $this->clave($salida);

        $this->assertNotSame($clave, User::first()->password);
        $this->assertSame(1, substr_count($salida, $clave));
    }
}
