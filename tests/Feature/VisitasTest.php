<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Visita;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

/**
 * Casos VI-xx de docs/casos-de-uso-panel.md.
 */
class VisitasTest extends TestCase
{
    use RefreshDatabase;

    private const CHROME = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 Chrome/120.0 Safari/537.36';
    private const IPHONE = 'Mozilla/5.0 (iPhone; CPU iPhone OS 17_0 like Mac OS X) AppleWebKit/605.1.15 Version/17.0 Mobile/15E148 Safari/604.1';

    protected function setUp(): void
    {
        parent::setUp();

        Cache::flush();
    }

    private function visitar(array $cabeceras = [], string $ruta = '/')
    {
        return $this->withHeaders(['User-Agent' => self::CHROME] + $cabeceras)->get($ruta);
    }

    public function test_vi01_a_visit_is_recorded_with_device_browser_and_language(): void
    {
        $this->withSession(['locale' => 'es'])->withHeaders(['User-Agent' => self::IPHONE])->get('/')->assertOk();

        $visita = Visita::sole();
        $this->assertSame('movil', $visita->dispositivo);
        $this->assertSame('Safari', $visita->navegador);
        $this->assertSame('es', $visita->idioma);
        $this->assertSame('/', $visita->ruta);
    }

    public function test_vi01b_desktop_and_tablet_are_told_apart(): void
    {
        $this->visitar();
        $this->assertSame('escritorio', Visita::first()->dispositivo);
        $this->assertSame('Chrome', Visita::first()->navegador);

        Cache::flush();
        $this->withHeaders(['User-Agent' => 'Mozilla/5.0 (iPad; CPU OS 17_0) AppleWebKit/605 Version/17 Safari/604'])->get('/');
        $this->assertSame('tablet', Visita::latest('id')->first()->dispositivo);
    }

    public function test_vi02_reloading_within_thirty_minutes_does_not_duplicate_the_visit(): void
    {
        $this->visitar();
        $this->visitar();
        $this->visitar();

        $this->assertDatabaseCount('visitas', 1);
    }

    public function test_vi02b_a_new_visit_counts_after_thirty_minutes(): void
    {
        $this->visitar();
        $this->travel(31)->minutes();
        $this->visitar();

        $this->assertDatabaseCount('visitas', 2);
    }

    public function test_vi03_robots_and_requests_without_user_agent_are_ignored(): void
    {
        foreach (['Googlebot/2.1', 'curl/8.4.0', 'python-requests/2.31', 'Mozilla/5.0 HeadlessChrome/120', 'facebookexternalhit/1.1'] as $agente) {
            Cache::flush();
            $this->withHeaders(['User-Agent' => $agente])->get('/')->assertOk();
        }

        $this->withHeaders(['User-Agent' => ''])->get('/')->assertOk();

        $this->assertDatabaseCount('visitas', 0);
    }

    public function test_vi04_do_not_track_and_global_privacy_control_are_respected(): void
    {
        $this->visitar(['DNT' => '1']);
        Cache::flush();
        $this->visitar(['Sec-GPC' => '1']);

        $this->assertDatabaseCount('visitas', 0);
    }

    public function test_vi05_the_signed_in_administrator_is_not_counted(): void
    {
        $this->actingAs(User::factory()->create());
        $this->visitar();

        $this->assertDatabaseCount('visitas', 0);
    }

    public function test_vi06_the_ip_is_never_stored(): void
    {
        $this->withServerVariables(['REMOTE_ADDR' => '203.0.113.77'])->withHeaders(['User-Agent' => self::CHROME])->get('/');

        $this->assertFalse(Schema::hasColumn('visitas', 'ip'));
        $visita = Visita::sole();
        $this->assertStringNotContainsString('203.0.113.77', json_encode($visita->toArray()));
        $this->assertSame(64, strlen($visita->visitante));
    }

    public function test_vi07_only_external_referrers_are_kept(): void
    {
        $this->visitar(['Referer' => 'https://www.google.com/search?q=lizan']);
        $this->assertSame('www.google.com', Visita::sole()->referente);

        Cache::flush();
        Visita::query()->delete();
        $this->visitar(['Referer' => 'http://localhost/login']);
        $this->assertNull(Visita::sole()->referente);
    }

    public function test_vi08_a_database_failure_never_breaks_the_page(): void
    {
        Schema::drop('visitas');

        $this->visitar()->assertOk()->assertSee('LizanDev');
    }

    public function test_vi09_the_visitor_hash_changes_from_one_day_to_the_next(): void
    {
        $this->visitar();
        $this->travel(1)->days();
        $this->visitar();

        $this->assertSame(2, Visita::query()->distinct()->count('visitante'));
    }

    public function test_vi10_the_panel_and_the_login_are_not_tracked(): void
    {
        $this->visitar([], '/login');
        $this->visitar([], '/admin');

        $this->assertDatabaseCount('visitas', 0);
    }

    public function test_vi11_a_missing_page_is_not_tracked(): void
    {
        $this->visitar([], '/no-existe')->assertNotFound();

        $this->assertDatabaseCount('visitas', 0);
    }
}
