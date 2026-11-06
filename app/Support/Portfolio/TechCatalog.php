<?php

namespace App\Support\Portfolio;

/**
 * Tecnologías del anillo del robot, con los proyectos donde se usó. El uso
 * sale de las etiquetas de cada proyecto: si ninguna coincide, la lista queda
 * vacía y la vista lo dice, en vez de inventar experiencia.
 */
class TechCatalog
{
    public static function all(): array
    {
        $projects = config('portfolio.projects');

        return array_map(function (array $tech) use ($projects) {
            $uses = $tech['uses'] ?? collect($projects)
                ->filter(fn (array $project) => self::usesTech($project['tech'], $tech['match']))
                ->pluck('title')
                ->all();

            return [
                'name' => $tech['name'],
                'category' => __($tech['category']),
                'uses' => array_map('__', $uses),
            ];
        }, config('portfolio.technologies'));
    }

    private static function usesTech(array $tags, array $keywords): bool
    {
        foreach ($tags as $tag) {
            foreach ($keywords as $keyword) {
                if (str_contains(strtolower($tag), $keyword)) {
                    return true;
                }
            }
        }

        return false;
    }
}
