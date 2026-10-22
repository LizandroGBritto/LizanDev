<?php

namespace App\Livewire\Portfolio;

use Livewire\Component;

class Hero extends Component
{
    public function render()
    {
        $name = config('portfolio.name');
        $description = __(config('portfolio.hero.description'));
        $roles = array_map('__', config('portfolio.hero.roles'));
        $socials = config('portfolio.socials');
        // En inglés el rol va antes de "Developer"; en español, después.
        $roleFirst = app()->getLocale() === 'en';

        return view('livewire.portfolio.hero', compact('name', 'description', 'roles', 'socials', 'roleFirst'));
    }
}
