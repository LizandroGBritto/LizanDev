<?php

namespace App\Livewire\Portfolio;

use Livewire\Component;

class Skills extends Component
{
    public function render()
    {
        $skills = collect(config('portfolio.skills'))
            ->map(fn (array $group) => [
                'category' => __($group['category']),
                'icon' => $group['icon'],
                'items' => array_map('__', $group['items']),
            ])
            ->all();
        $alsoWorkWith = config('portfolio.also_work_with');

        return view('livewire.portfolio.skills', compact('skills', 'alsoWorkWith'));
    }
}
