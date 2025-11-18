<?php

namespace App\Livewire\Portfolio;

use Livewire\Component;

class Skills extends Component
{
    public $skills = [
        [
            'category' => 'Frontend',
            'items' => [
                ['name' => 'HTML5/CSS3', 'level' => 90],
                ['name' => 'JavaScript/TypeScript', 'level' => 85],
                ['name' => 'Vue.js / React', 'level' => 80],
                ['name' => 'Tailwind CSS', 'level' => 95],
            ]
        ],
        [
            'category' => 'Backend',
            'items' => [
                ['name' => 'PHP / Laravel', 'level' => 90],
                ['name' => 'Node.js', 'level' => 75],
                ['name' => 'MySQL / PostgreSQL', 'level' => 85],
                ['name' => 'RESTful APIs', 'level' => 88],
            ]
        ],
        [
            'category' => 'DevOps & Tools',
            'items' => [
                ['name' => 'Git / GitHub', 'level' => 90],
                ['name' => 'Docker', 'level' => 75],
                ['name' => 'CI/CD', 'level' => 70],
                ['name' => 'AWS / Cloud', 'level' => 65],
            ]
        ],
    ];

    public function render()
    {
        return view('livewire.portfolio.skills');
    }
}
