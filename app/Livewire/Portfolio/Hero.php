<?php

namespace App\Livewire\Portfolio;

use Livewire\Component;

class Hero extends Component
{
    public function render()
    {
        [$firstName, $lastName] = array_pad(explode(' ', config('portfolio.name'), 2), 2, '');
        $role = __(config('portfolio.role'));
        $description = __(config('portfolio.hero.description'));
        $status = __(config('portfolio.hero.status'));
        $photo = $this->photo();
        $skills = array_map(fn (array $skill) => [__($skill[0]), __($skill[1])], config('portfolio.carnet_skills'));

        return view('livewire.portfolio.hero', compact('firstName', 'lastName', 'role', 'description', 'status', 'photo', 'skills'));
    }

    private function photo(): ?string
    {
        $path = config('portfolio.photo');

        return is_file(public_path($path)) ? asset($path) : null;
    }
}
