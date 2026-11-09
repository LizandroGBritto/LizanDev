<?php

namespace App\Support\Portfolio;

/**
 * Arma los proyectos de la baraja listos para la vista: textos traducidos,
 * rutas resueltas con asset() y todas las claves presentes, de modo que
 * Blade solo itere y muestre.
 */
class ProjectCatalog
{
    public static function all(): array
    {
        return array_map(fn (array $project) => [
            'badge' => __($project['badge']),
            'slug' => $project['slug'],
            'title' => __($project['title']),
            'description' => __($project['description']),
            'highlights' => array_map(fn (string $punto) => __($punto), $project['highlights'] ?? []),
            'tech' => $project['tech'],
            'demo' => $project['demo'] ?? null,
            'image' => isset($project['image']) ? asset($project['image']) : null,
            'mobile' => isset($project['mobile']) ? asset($project['mobile']) : null,
            'views' => self::views($project),
            'placeholder' => $project['placeholder'] ?? null,
        ], config('portfolio.projects'));
    }

    /**
     * Vistas del modal de detalles: la captura principal de la card va primero
     * como «Inicio» (o `main_label`) y le siguen las vistas extra de la config.
     */
    private static function views(array $project): array
    {
        $vistas = [];

        if (isset($project['image'])) {
            $vistas[] = ['label' => __($project['main_label'] ?? 'Home'), 'image' => $project['image'], 'mobile' => $project['mobile'] ?? null];
        }

        foreach ($project['views'] ?? [] as $vista) {
            $vistas[] = ['label' => __($vista['label']), 'image' => $vista['image'], 'mobile' => $vista['mobile'] ?? null];
        }

        return array_map(fn (array $vista) => [
            'label' => $vista['label'],
            'image' => asset($vista['image']),
            'mobile' => $vista['mobile'] ? asset($vista['mobile']) : null,
        ], $vistas);
    }
}
