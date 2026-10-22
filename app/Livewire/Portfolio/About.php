<?php

namespace App\Livewire\Portfolio;

use Livewire\Component;

class About extends Component
{
    public function render()
    {
        $bio = config('portfolio.about.bio');
        $photoPath = config('portfolio.about.photo');
        $photo = is_file(public_path($photoPath)) ? asset($photoPath) : null;

        return view('livewire.portfolio.about', compact('bio', 'photo'));
    }
}
