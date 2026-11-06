<?php

namespace App\Livewire\Portfolio;

use Livewire\Component;

class About extends Component
{
    public function render()
    {
        $bio = __(config('portfolio.about.bio'));
        $path = config('portfolio.photo');
        $photo = is_file(public_path($path)) ? asset($path) : null;

        return view('livewire.portfolio.about', compact('bio', 'photo'));
    }
}
