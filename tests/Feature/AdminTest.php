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
        $this->get('/admin')->assertRedirect('/login');
        $this->get('/admin/mensajes')->assertRedirect('/login');
        $this->patch('/admin/mensajes/1/leido')->assertRedirect('/login');
        $this->delete('/admin/mensajes/1')->assertRedirect('/login');
    }

    public function test_the_login_page_is_not_indexable(): void
    {
        $this->get('/login')->assertOk()->assertSee('noindex', false);
    }

    public function test_the_administrator_can_sign_in_and_out(): void
    {
        $usuario = User::factory()->create(['password' => 'clave-segura-123']);

        $this->post('/login', ['email' => $usuario->email, 'password' => 'clave-segura-123'])
            ->assertRedirect('/admin');
        $this->assertAuthenticatedAs($usuario);

        $this->post('/logout')->assertRedirect('/login');
        $this->assertGuest();
    }

    public function test_wrong_credentials_are_rejected(): void
    {
        $usuario = User::factory()->create(['password' => 'clave-segura-123']);

        $this->from('/login')
            ->post('/login', ['email' => $usuario->email, 'password' => 'otra'])
            ->assertRedirect('/login')
            ->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_the_login_is_throttled(): void
    {
        for ($i = 0; $i < 5; $i++) {
            $this->post('/login', ['email' => 'x@example.com', 'password' => 'mala']);
        }

        $this->post('/login', ['email' => 'x@example.com', 'password' => 'mala'])->assertStatus(429);
    }

    public function test_signed_in_users_skip_the_login_page(): void
    {
        $this->actingAs(User::factory()->create())->get('/login')->assertRedirect('/admin');
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

        $this->post('/login', ['email' => 'panel@example.com', 'password' => 'clave-del-seeder'])
            ->assertRedirect('/admin');
    }

    public function test_me07_the_list_is_paginated_newest_first(): void
    {
        foreach (range(1, 17) as $i) {
            $this->mensaje(['nombre' => "Persona {$i}", 'created_at' => now()->subMinutes(20 - $i)]);
        }

        $this->actingAs(User::factory()->create());

        $this->get('/admin/mensajes')->assertSee('Persona 17')->assertDontSee('Persona 2<', false)->assertSee('1 / 2');
        $this->get('/admin/mensajes?page=2')->assertSee('Persona 2')->assertDontSee('Persona 17');
    }

    public function test_me12_acting_on_a_message_that_does_not_exist_gives_404(): void
    {
        $this->actingAs(User::factory()->create());

        $this->patch('/admin/mensajes/999/leido')->assertNotFound();
        $this->delete('/admin/mensajes/999')->assertNotFound();
    }
}
