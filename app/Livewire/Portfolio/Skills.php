<?php

namespace App\Livewire\Portfolio;

use App\Support\Portfolio\TechCatalog;
use Livewire\Component;

class Skills extends Component
{
    public function render()
    {
        $technologies = TechCatalog::all();

        return view('livewire.portfolio.skills', compact('technologies'));
    }
}
