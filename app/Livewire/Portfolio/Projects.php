<?php

namespace App\Livewire\Portfolio;

use App\Support\Portfolio\ProjectCatalog;
use Livewire\Component;

class Projects extends Component
{
    public function render()
    {
        $projects = ProjectCatalog::all();

        return view('livewire.portfolio.projects', compact('projects'));
    }
}
