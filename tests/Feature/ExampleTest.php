<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function test_home_is_the_root_route(): void
    {
        $this->get('/')->assertOk();
    }

    public function test_the_old_prefix_no_longer_exists(): void
    {
        $this->get('/LizanDev')->assertNotFound();
    }

    public function test_portfolio_renders_every_section(): void
    {
        $response = $this->get('/');

        $response->assertOk();
        $response->assertSeeInOrder([
            'id="hero-section"',
            'id="projects"',
            'id="skills"',
            'id="about"',
            'id="contact"',
        ], false);
    }

    public function test_the_three_d_pieces_are_rendered_from_the_config(): void
    {
        $response = $this->withSession(['locale' => 'en'])->get('/');

        $response->assertSee('data-flip', false);
        $response->assertSee('data-deck-root', false);
        $response->assertSee('data-tech', false);
        $response->assertSee('data-about-robot', false);

        foreach (config('portfolio.technologies') as $tech) {
            $response->assertSee('data-tech-pick="'.$tech['name'].'"', false);
        }

        foreach (config('portfolio.projects') as $project) {
            $response->assertSee($project['title']);
        }
    }

    public function test_unused_technologies_do_not_invent_projects(): void
    {
        $docker = collect(\App\Support\Portfolio\TechCatalog::all())->firstWhere('name', 'Docker');
        $laravel = collect(\App\Support\Portfolio\TechCatalog::all())->firstWhere('name', 'Laravel');

        $this->assertSame([], $docker['uses']);
        $this->assertContains('SIS System', $laravel['uses']);
    }

    public function test_design_stays_flat_without_glass_glow_or_gradients(): void
    {
        $banned = ['backdrop-', 'blur-', 'mix-blend', 'bg-gradient', 'bg-linear', 'bg-clip-text', 'animate-ping', 'animate-pulse', 'animate-bounce'];

        foreach ($this->sources([resource_path('views'), resource_path('css')]) as $file) {
            $source = file_get_contents($file->getPathname());

            foreach ($banned as $effect) {
                $this->assertStringNotContainsString($effect, $source, $file->getFilename()." usa «{$effect}»");
            }

            $this->assertDoesNotMatchRegularExpression('/(linear|radial|conic)-gradient|box-shadow|backdrop-filter/', $source, $file->getFilename().' tiene degradado, sombra o filtro');
        }
    }

    public function test_components_read_colors_from_theme_tokens(): void
    {
        // Los colores se definen una vez en theme.css; el resto los lee con var().
        $files = array_filter(
            $this->sources([resource_path('css'), resource_path('views')]),
            fn ($file) => $file->getFilename() !== 'theme.css',
        );

        foreach ($files as $file) {
            $source = file_get_contents($file->getPathname());

            $this->assertDoesNotMatchRegularExpression('/#[0-9a-fA-F]{3,8}\b(?![^<]*>)|rgba?\(|hsla?\(/', preg_replace('/\{\{--.*?--\}\}|\/\*.*?\*\//s', '', $source), $file->getFilename().' tiene un color escrito a mano; usá un token de theme.css con var()');
            $this->assertDoesNotMatchRegularExpression('/\[#[0-9a-fA-F]{3,8}\]/', $source, $file->getFilename().' tiene un color arbitrario en una clase');
        }
    }

    public function test_views_stay_free_of_inline_php_styles_and_scripts(): void
    {
        foreach ($this->sources([resource_path('views')]) as $file) {
            if (! str_ends_with($file->getFilename(), '.blade.php')) {
                continue;
            }

            $source = file_get_contents($file->getPathname());

            $this->assertStringNotContainsString('@php', $source, $file->getFilename().' usa @php');
            $this->assertStringNotContainsString('<style', $source, $file->getFilename().' tiene <style>');
            $this->assertStringNotContainsString('<script', $source, $file->getFilename().' tiene <script>');
            $this->assertStringNotContainsString('onclick=', $source, $file->getFilename().' tiene onclick');
        }
    }

    /** @return list<\SplFileInfo> */
    private function sources(array $dirs): array
    {
        $files = [];

        foreach ($dirs as $dir) {
            foreach (new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($dir)) as $file) {
                // welcome.blade.php es del esqueleto de Laravel y no tiene ruta.
                if ($file->isFile() && $file->getFilename() !== 'welcome.blade.php') {
                    $files[] = $file;
                }
            }
        }

        return $files;
    }
}
