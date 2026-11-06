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
            'title' => __($project['title']),
            'description' => __($project['description']),
            'tech' => $project['tech'],
            'demo' => $project['demo'] ?? null,
            'image' => isset($project['image']) ? asset($project['image']) : null,
            'mobile' => isset($project['mobile']) ? asset($project['mobile']) : null,
            'placeholder' => $project['placeholder'] ?? null,
        ], config('portfolio.projects'));
    }
}
