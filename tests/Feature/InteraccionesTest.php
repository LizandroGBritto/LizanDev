<?php

namespace Tests\Feature;

use App\Models\Interaccion;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Casos IN-xx de docs/casos-de-uso-panel.md.
 */
class InteraccionesTest extends TestCase
{
    use RefreshDatabase;

    private const CHROME = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 Chrome/120.0 Safari/537.36';

    private function enviar(array $datos, array $cabeceras = [])
    {
        return $this->withHeaders(['User-Agent' => self::CHROME] + $cabeceras)->post('/seguimiento', $datos);
    }

    public function test_in01_a_viewed_project_is_recorded(): void
    {
        $this->enviar(['tipo' => 'proyecto_visto', 'sujeto' => 'alonzo-style'])->assertNoContent();

        $fila = Interaccion::sole();
        $this->assertSame('proyecto_visto', $fila->tipo);
        $this->assertSame('alonzo-style', $fila->sujeto);
        $this->assertSame(64, strlen($fila->visitante));
    }

    public function test_in02_the_device_switch_needs_a_valid_view(): void
    {
        $this->enviar(['tipo' => 'vista_dispositivo', 'sujeto' => 'amalia-acosta', 'detalle' => 'phone'])->assertNoContent();
        $this->assertSame('phone', Interaccion::sole()->detalle);

        $this->enviar(['tipo' => 'vista_dispositivo', 'sujeto' => 'amalia-acosta'])->assertStatus(422);
        $this->enviar(['tipo' => 'vista_dispositivo', 'sujeto' => 'amalia-acosta', 'detalle' => 'tv'])->assertStatus(422);
        $this->assertDatabaseCount('interacciones', 1);
    }

    public function test_in03_unknown_or_malformed_events_are_rejected(): void
    {
        $this->enviar(['tipo' => 'proyecto_visto', 'sujeto' => 'no-existe'])->assertStatus(422);
        $this->enviar(['tipo' => 'borrar_todo', 'sujeto' => 'sis'])->assertStatus(422);
        $this->enviar(['sujeto' => 'sis'])->assertStatus(422);
        $this->enviar(['tipo' => 'proyecto_visto'])->assertStatus(422);
        $this->enviar(['tipo' => 'proyecto_visto', 'sujeto' => str_repeat('a', 500)])->assertStatus(422);
        $this->enviar(['tipo' => 'proyecto_visto', 'sujeto' => ['sis']])->assertStatus(422);
        $this->enviar(['tipo' => 'proyecto_visto', 'sujeto' => '<script>alert(1)</script>'])->assertStatus(422);

        $this->assertDatabaseCount('interacciones', 0);
    }

    public function test_in04_technologies_are_validated_against_the_list(): void
    {
        $this->enviar(['tipo' => 'tecnologia', 'sujeto' => 'Laravel'])->assertNoContent();
        $this->enviar(['tipo' => 'tecnologia', 'sujeto' => 'Cobol'])->assertStatus(422);
        // Un proyecto no es una tecnología, ni al revés.
        $this->enviar(['tipo' => 'tecnologia', 'sujeto' => 'sis'])->assertStatus(422);
        $this->enviar(['tipo' => 'proyecto_visto', 'sujeto' => 'Laravel'])->assertStatus(422);

        $this->assertDatabaseCount('interacciones', 1);
    }

    public function test_in05_demo_clicks_are_recorded(): void
    {
        $this->enviar(['tipo' => 'demo_clic', 'sujeto' => 'ramirez-ramirez'])->assertNoContent();

        $this->assertSame('demo_clic', Interaccion::sole()->tipo);
    }

    public function test_in06_robots_do_not_track_requests_get_the_same_answer_but_nothing_is_saved(): void
    {
        $this->enviar(['tipo' => 'proyecto_visto', 'sujeto' => 'sis'], ['DNT' => '1'])->assertNoContent();
        $this->enviar(['tipo' => 'proyecto_visto', 'sujeto' => 'sis'], ['User-Agent' => 'Googlebot/2.1'])->assertNoContent();
        $this->enviar(['tipo' => 'proyecto_visto', 'sujeto' => 'sis'], ['Sec-GPC' => '1'])->assertNoContent();

        $this->assertDatabaseCount('interacciones', 0);
    }

    public function test_in07_the_signed_in_administrator_is_not_counted(): void
    {
        $this->actingAs(User::factory()->create());
        $this->enviar(['tipo' => 'proyecto_visto', 'sujeto' => 'sis'])->assertNoContent();

        $this->assertDatabaseCount('interacciones', 0);
    }

    public function test_in08_the_endpoint_only_accepts_post_and_is_throttled(): void
    {
        $this->get('/seguimiento')->assertStatus(405);

        for ($i = 0; $i < 120; $i++) {
            $this->enviar(['tipo' => 'proyecto_visto', 'sujeto' => 'sis'], ['DNT' => '1']);
        }

        $this->enviar(['tipo' => 'proyecto_visto', 'sujeto' => 'sis'], ['DNT' => '1'])->assertStatus(429);
    }

    public function test_in09_every_project_has_a_unique_slug_and_the_page_exposes_them(): void
    {
        $slugs = array_column(config('portfolio.projects'), 'slug');

        $this->assertCount(count($slugs), array_unique($slugs));
        $this->assertNotContains(null, $slugs);

        $html = $this->get('/')->getContent();

        foreach ($slugs as $slug) {
            $this->assertStringContainsString('data-project="'.$slug.'"', $html);
        }
    }
}
