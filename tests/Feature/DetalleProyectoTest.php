<?php

namespace Tests\Feature;

use App\Models\Interaccion;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Modal de detalles de cada proyecto (casos DP-xx de docs/casos-de-uso-panel.md).
 */
class DetalleProyectoTest extends TestCase
{
    use RefreshDatabase;

    private const CHROME = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 Chrome/120.0 Safari/537.36';

    public function test_dp01_there_is_one_modal_per_project_with_its_views_and_highlights(): void
    {
        $html = $this->get('/')->getContent();

        foreach (config('portfolio.projects') as $proyecto) {
            $this->assertStringContainsString('<dialog class="detalle" data-detail="'.$proyecto['slug'].'"', $html);
        }

        $this->assertSame(count(config('portfolio.projects')), substr_count($html, '<dialog class="detalle"'));
        $this->assertSame(count(config('portfolio.projects')), substr_count($html, 'data-detail-open'));
    }

    public function test_dp02_every_view_image_exists_on_disk(): void
    {
        foreach (config('portfolio.projects') as $proyecto) {
            foreach ($proyecto['views'] ?? [] as $vista) {
                $this->assertFileExists(public_path($vista['image']), $proyecto['slug']);

                if (isset($vista['mobile'])) {
                    $this->assertFileExists(public_path($vista['mobile']), $proyecto['slug']);
                }
            }
        }
    }

    public function test_dp03_opening_a_modal_is_recorded_and_unknown_projects_are_refused(): void
    {
        $this->withHeaders(['User-Agent' => self::CHROME])
            ->post('/seguimiento', ['tipo' => 'detalle_abierto', 'sujeto' => 'ramirez-ramirez'])->assertNoContent();

        $this->assertSame('detalle_abierto', Interaccion::sole()->tipo);

        $this->withHeaders(['User-Agent' => self::CHROME])
            ->post('/seguimiento', ['tipo' => 'detalle_abierto', 'sujeto' => 'no-existe'])->assertStatus(422);
    }

    public function test_dp04_the_modal_text_is_translated(): void
    {
        $this->withSession(['locale' => 'es'])->get('/')
            ->assertSee('Puntos clave')
            ->assertSee('Agenda de turnos para clientes');
    }
}
