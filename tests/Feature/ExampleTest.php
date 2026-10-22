<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function test_root_redirects_to_the_portfolio(): void
    {
        $this->get('/')->assertRedirect('/LizanDev');
    }

    public function test_portfolio_renders_every_section(): void
    {
        $response = $this->get('/LizanDev');

        $response->assertOk();
        $response->assertSeeInOrder([
            'id="hero-section"',
            'id="projects"',
            'id="skills"',
            'id="about"',
            'id="contact"',
        ], false);
    }

    public function test_design_stays_flat_without_glass_glow_or_gradients(): void
    {
        $banned = ['backdrop-', 'blur-', 'mix-blend', 'bg-gradient', 'bg-linear', 'bg-clip-text', 'animate-ping', 'animate-pulse', 'animate-bounce'];

        foreach ([resource_path('views'), resource_path('css')] as $dir) {
            $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($dir));

            foreach ($files as $file) {
                if (! $file->isFile() || $file->getFilename() === 'welcome.blade.php') {
                    continue;
                }

                $source = file_get_contents($file->getPathname());

                foreach ($banned as $effect) {
                    $this->assertStringNotContainsString($effect, $source, $file->getFilename()." usa «{$effect}»");
                }

                $this->assertDoesNotMatchRegularExpression('/linear-gradient|radial-gradient|box-shadow|backdrop-filter/', $source, $file->getFilename().' tiene degradado, sombra o filtro');
            }
        }
    }

    public function test_views_stay_free_of_inline_php_styles_and_scripts(): void
    {
        $views = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator(resource_path('views')));

        foreach ($views as $file) {
            if (! str_ends_with($file->getFilename(), '.blade.php') || $file->getFilename() === 'welcome.blade.php') {
                continue;
            }

            $source = file_get_contents($file->getPathname());

            $this->assertStringNotContainsString('@php', $source, $file->getFilename().' usa @php');
            $this->assertStringNotContainsString('<style', $source, $file->getFilename().' tiene <style>');
            $this->assertStringNotContainsString('<script', $source, $file->getFilename().' tiene <script>');
            $this->assertStringNotContainsString('onclick=', $source, $file->getFilename().' tiene onclick');
        }
    }
}
