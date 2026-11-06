<?php

namespace Tests\Feature;

use App\Models\Interaccion;
use App\Models\User;
use App\Models\Visita;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Casos RE-xx de docs/casos-de-uso-panel.md.
 */
class ResumenTest extends TestCase
{
    use RefreshDatabase;

    private function visita(array $campos = [], $fecha = null): Visita
    {
        $visita = Visita::create($campos + [
            'visitante' => bin2hex(random_bytes(32)),
            'ruta' => '/',
            'dispositivo' => 'escritorio',
            'navegador' => 'Chrome',
            'idioma' => 'es',
        ]);

        if ($fecha) {
            $visita->forceFill(['created_at' => $fecha])->save();
        }

        return $visita;
    }

    private function interaccion(string $tipo, string $sujeto, array $extra = [], $fecha = null): void
    {
        $fila = Interaccion::create(['visitante' => bin2hex(random_bytes(32)), 'tipo' => $tipo, 'sujeto' => $sujeto] + $extra);

        if ($fecha) {
            $fila->forceFill(['created_at' => $fecha])->save();
        }
    }

    private function panel(string $consulta = '')
    {
        return $this->actingAs(User::factory()->create())->get('/admin'.$consulta);
    }

    public function test_re01_the_overview_needs_a_session(): void
    {
        $this->get('/admin')->assertRedirect('/login');
    }

    public function test_re02_it_shows_visits_visitors_and_today(): void
    {
        $this->visita(['visitante' => 'a']);
        $this->visita(['visitante' => 'a']);
        $this->visita(['visitante' => 'b']);
        $this->visita(['visitante' => 'c'], now()->subDays(3));

        $respuesta = $this->panel()->assertOk();

        $this->assertSame(
            ['4', '3', '3'],
            $this->numeros($respuesta->getContent(), ['Visits', 'Visitors', 'Today']),
        );
    }

    private function numeros(string $html, array $etiquetas): array
    {
        return array_map(function (string $etiqueta) use ($html) {
            preg_match('/<dt[^>]*>'.preg_quote($etiqueta, '/').'<\/dt>\s*<dd[^>]*>\s*([\d,]+)\s*<\/dd>/', $html, $m);

            return $m[1] ?? 'no encontrado: '.$etiqueta;
        }, $etiquetas);
    }

    public function test_re03_an_invalid_period_falls_back_to_thirty_days(): void
    {
        $this->visita([], now()->subDays(45));
        $this->visita();

        foreach (['?dias=abc', '?dias=9999', '?dias=-5', '?dias[]=7', '?dias=0', '?dias=30; drop table visitas'] as $consulta) {
            $respuesta = $this->panel($consulta)->assertOk();
            $this->assertSame(['1'], $this->numeros($respuesta->getContent(), ['Visits']), $consulta);
        }
    }

    public function test_re04_the_period_filters_visits(): void
    {
        $this->visita();
        $this->visita([], now()->subDays(20));
        $this->visita([], now()->subDays(60));

        $this->assertSame(['1'], $this->numeros($this->panel('?dias=7')->getContent(), ['Visits']));
        $this->assertSame(['2'], $this->numeros($this->panel('?dias=30')->getContent(), ['Visits']));
        $this->assertSame(['3'], $this->numeros($this->panel('?dias=90')->getContent(), ['Visits']));
    }

    public function test_re05_every_project_is_listed_even_without_interactions(): void
    {
        $respuesta = $this->panel()->assertOk();

        foreach (config('portfolio.projects') as $proyecto) {
            $respuesta->assertSee($proyecto['title']);
        }
    }

    public function test_re06_projects_are_sorted_by_views_and_count_phone_views_and_demo_clicks(): void
    {
        foreach (range(1, 3) as $i) {
            $this->interaccion('proyecto_visto', 'amalia-acosta');
        }
        $this->interaccion('proyecto_visto', 'sis');
        $this->interaccion('vista_dispositivo', 'amalia-acosta', ['detalle' => 'phone']);
        $this->interaccion('vista_dispositivo', 'amalia-acosta', ['detalle' => 'laptop']);
        $this->interaccion('demo_clic', 'amalia-acosta');

        $html = $this->panel()->getContent();

        $this->assertLessThan(strpos($html, 'SIS System'), strpos($html, 'Amalia Acosta'));
        $this->assertMatchesRegularExpression('/Amalia Acosta<\/th>\s*<td[^>]*>3<\/td>\s*<td[^>]*>3<\/td>\s*<td[^>]*>1<\/td>\s*<td[^>]*>1<\/td>/', $html);
    }

    public function test_re07_old_interactions_are_left_out(): void
    {
        $this->interaccion('proyecto_visto', 'sis', [], now()->subDays(100));

        $this->assertMatchesRegularExpression('/SIS System<\/th>\s*<td[^>]*>0<\/td>/', $this->panel('?dias=90')->getContent());
    }

    public function test_re08_with_no_data_it_shows_empty_states_instead_of_failing(): void
    {
        $this->panel()->assertOk()->assertSee('No data yet.');
    }

    public function test_re09_referrers_devices_and_languages_are_summarised(): void
    {
        $this->visita(['referente' => 'www.google.com']);
        $this->visita(['referente' => 'www.google.com', 'dispositivo' => 'movil', 'idioma' => 'en']);
        $this->visita();

        $this->panel()->assertOk()
            ->assertSee('www.google.com')
            ->assertSee('Direct')
            ->assertSee('Mobile')
            ->assertSee('EN');
    }

    public function test_re10_the_chart_has_one_bar_per_day_of_the_period(): void
    {
        $html = $this->panel('?dias=7')->getContent();

        $this->assertSame(7, substr_count($html, 'class="panel-serie__dia"'));
    }

    public function test_re11_hostile_values_stored_in_the_tables_are_escaped(): void
    {
        $this->visita(['referente' => '<img src=x onerror=alert(1)>']);

        $this->panel()->assertDontSee('<img src=x onerror=alert(1)>', false)->assertSee('&lt;img src=x', false);
    }
}
