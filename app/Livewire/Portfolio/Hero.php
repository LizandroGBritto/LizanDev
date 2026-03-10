<?php

namespace App\Livewire\Portfolio;

use Livewire\Component;

class Hero extends Component
{
    public $name = 'Lizandro Britto';
    public $description = 'Passionate about creating innovative and scalable digital solutions';
    public $cvUrl = '#';

    public function render()
    {
        return view('livewire.portfolio.hero');
    }
}
