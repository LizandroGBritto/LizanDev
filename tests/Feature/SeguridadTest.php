<?php

namespace Tests\Feature;

use Tests\TestCase;

class SeguridadTest extends TestCase
{
    public function test_public_only_contains_what_the_web_server_may_serve(): void
    {
        $permitidos = ['.htaccess', 'assets', 'build', 'apple-touch-icon.png', 'favicon.ico', 'favicon.svg', 'index.php', 'robots.txt', 'storage', 'hot'];

        foreach (scandir(public_path()) as $entrada) {
            if (in_array($entrada, ['.', '..'], true)) {
                continue;
            }

            $this->assertContains($entrada, $permitidos, "public/{$entrada} no debería estar en la raíz web");
        }
    }

    public function test_no_sensitive_file_is_inside_public(): void
    {
        $iterador = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator(public_path(), \FilesystemIterator::SKIP_DOTS));

        foreach ($iterador as $archivo) {
            $this->assertDoesNotMatchRegularExpression(
                '/\.(env|sqlite3?|db|sql|bak|backup|log|pem|key)$|^\.env/i',
                $archivo->getFilename(),
                'Archivo sensible dentro de public/: '.$archivo->getPathname(),
            );
        }
    }

    public function test_env_files_are_never_tracked_by_git(): void
    {
        $gitignore = file_get_contents(base_path('.gitignore'));

        $this->assertMatchesRegularExpression('/^\.env$/m', $gitignore);
        $this->assertMatchesRegularExpression('/^\.env\.\*$/m', $gitignore);
        $this->assertMatchesRegularExpression('/^!\.env\.example$/m', $gitignore);
    }

    public function test_production_template_turns_debug_off_and_secures_cookies(): void
    {
        $plantilla = file_get_contents(base_path('deploy/env.produccion.example'));

        $this->assertStringContainsString('APP_ENV=production', $plantilla);
        $this->assertMatchesRegularExpression('/^APP_DEBUG=false/m', $plantilla);
        $this->assertMatchesRegularExpression('/^SESSION_SECURE_COOKIE=true/m', $plantilla);
    }

    public function test_the_nginx_template_blocks_hidden_files_and_other_php_scripts(): void
    {
        $conf = file_get_contents(base_path('deploy/nginx-dev.lizan.site.conf'));

        $this->assertStringContainsString('root /var/www/dev.lizan.site/public;', $conf);
        $this->assertStringContainsString('location ~ /\.(?!well-known) { deny all; return 404; }', $conf);
        $this->assertStringContainsString('location ~ \.php$ { return 404; }', $conf);
        $this->assertStringContainsString('server_tokens off;', $conf);
    }

    public function test_security_endpoints_are_not_indexable_and_errors_do_not_leak(): void
    {
        $this->get('/login')->assertSee('noindex', false);
        $this->get('/ruta-que-no-existe')->assertNotFound()->assertDontSee('vendor/laravel', false);
    }
}
