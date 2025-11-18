<?php

namespace App\Livewire\Portfolio;

use Livewire\Component;

class Projects extends Component
{
    public $projects = [
        [
            'title' => 'E-Commerce Platform',
            'description' => 'Plataforma completa de comercio electrónico con panel de administración, gestión de inventario y pasarela de pagos.',
            'image' => 'https://images.unsplash.com/photo-1557821552-17105176677c?w=800&q=80',
            'tags' => ['Laravel', 'Vue.js', 'Stripe', 'MySQL'],
            'github' => '#',
            'demo' => '#'
        ],
        [
            'title' => 'Task Management App',
            'description' => 'Aplicación de gestión de tareas con colaboración en tiempo real usando WebSockets.',
            'image' => 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?w=800&q=80',
            'tags' => ['Laravel', 'Livewire', 'Alpine.js', 'Tailwind'],
            'github' => '#',
            'demo' => '#'
        ],
        [
            'title' => 'Analytics Dashboard',
            'description' => 'Dashboard interactivo de analíticas con visualización de datos en tiempo real.',
            'image' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=800&q=80',
            'tags' => ['React', 'Node.js', 'Chart.js', 'MongoDB'],
            'github' => '#',
            'demo' => '#'
        ],
    ];

    public function render()
    {
        return view('livewire.portfolio.projects');
    }
}
