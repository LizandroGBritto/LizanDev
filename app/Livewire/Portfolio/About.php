<?php

namespace App\Livewire\Portfolio;

use Livewire\Component;

class About extends Component
{
    public $bio = 'Desarrollador de software con experiencia en crear aplicaciones web modernas y escalables. Me especializo en el stack Laravel, PHP, JavaScript y frameworks modernos.';

    public $experience = [
        [
            'years' => '3+',
            'label' => 'Años de Experiencia'
        ],
        [
            'years' => '20+',
            'label' => 'Proyectos Completados'
        ],
        [
            'years' => '15+',
            'label' => 'Clientes Satisfechos'
        ],
    ];

    public function render()
    {
        return view('livewire.portfolio.about');
    }
}
