<?php

namespace Tests\Feature;

use Tests\TestCase;

class IdiomasTest extends TestCase
{
    public function test_both_languages_define_exactly_the_same_keys(): void
    {
        $es = json_decode(file_get_contents(resource_path('lang/es.json')), true, flags: JSON_THROW_ON_ERROR);
        $en = json_decode(file_get_contents(resource_path('lang/en.json')), true, flags: JSON_THROW_ON_ERROR);

        $this->assertSame([], array_diff_key($es, $en), 'Claves en es.json que faltan en en.json');
        $this->assertSame([], array_diff_key($en, $es), 'Claves en en.json que faltan en es.json');

        foreach ($es as $clave => $texto) {
            $this->assertNotSame('', trim($texto), "«{$clave}» está vacía en español");
        }
    }

    public function test_every_translated_config_text_has_a_spanish_version(): void
    {
        $es = json_decode(file_get_contents(resource_path('lang/es.json')), true, flags: JSON_THROW_ON_ERROR);
        $claves = [config('portfolio.role'), config('portfolio.hero.description'), config('portfolio.hero.status'), config('portfolio.about.bio')];

        foreach (config('portfolio.projects') as $project) {
            array_push($claves, $project['badge'], $project['title'], $project['description']);
        }

        foreach (config('portfolio.navigation') as $item) {
            $claves[] = $item['label'];
        }

        foreach (config('portfolio.technologies') as $tech) {
            $claves[] = $tech['category'];
        }

        foreach ($claves as $clave) {
            $this->assertArrayHasKey($clave, $es, "Falta traducir al español: {$clave}");
        }
    }

    public function test_the_page_renders_in_english_and_spanish(): void
    {
        $this->withSession(['locale' => 'en'])->get('/')
            ->assertOk()
            ->assertSee('<html lang="en"', false)
            ->assertSee("Hello, I'm")
            ->assertSee('Technologies I have worked with')
            ->assertSee('Send Message');

        $this->withSession(['locale' => 'es'])->get('/')
            ->assertOk()
            ->assertSee('<html lang="es"', false)
            ->assertSee('Hola, soy')
            ->assertSee('Tecnologías con las que he trabajado')
            ->assertSee('Enviar Mensaje')
            ->assertSee('Sistema SIS');
    }

    public function test_the_first_visit_follows_the_browser_language(): void
    {
        $this->get('/', ['Accept-Language' => 'es-PY,es;q=0.9'])->assertSee('<html lang="es"', false);
        $this->flushSession();
        $this->get('/', ['Accept-Language' => 'fr-FR'])->assertSee('<html lang="en"', false);
    }
}
