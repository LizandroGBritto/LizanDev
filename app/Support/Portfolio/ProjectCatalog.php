<?php

namespace App\Support\Portfolio;

/**
 * Arma los grupos de proyectos listos para la vista: textos traducidos,
 * rutas resueltas con asset() y todas las claves presentes, de modo que
 * Blade solo itere y muestre.
 */
class ProjectCatalog
{
    public static function groups(): array
    {
        return collect(config('portfolio.project_groups'))
            ->map(fn (array $group) => [
                'title' => __($group['title']),
                'icon' => $group['icon'],
                'projects' => collect($group['projects'])
                    ->map(fn (array $project) => self::project($project))
                    ->all(),
            ])
            ->all();
    }

    private static function project(array $project): array
    {
        return [
            'id' => $project['id'],
            'badge' => __($project['badge']),
            'title' => __($project['title']),
            'description' => __($project['description']),
            'tech' => $project['tech'],
            'demo' => $project['demo'] ?? null,
            'reverse' => $project['reverse'] ?? false,
            'carousel' => isset($project['carousel']) ? self::carousel($project['carousel']) : null,
            'placeholder' => isset($project['placeholder']) ? [
                'icon' => $project['placeholder']['icon'],
                'label' => __($project['placeholder']['label']),
            ] : null,
        ];
    }

    private static function carousel(array $carousel): array
    {
        return collect($carousel['slides'])
            ->map(fn (array $slide) => [
                'src' => asset($carousel['dir'].'/'.$slide['file']),
                'caption' => __($slide['caption']),
            ])
            ->all();
    }
}
