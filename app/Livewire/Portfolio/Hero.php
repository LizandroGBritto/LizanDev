<?php

namespace App\Livewire\Portfolio;

use Livewire\Component;

class Hero extends Component
{
    public $name = 'Lizandro Britto';
    public $description = 'Apasionado por crear soluciones digitales innovadoras y escalables';
    public $cvUrl = '#';

    public function render()
    {
        return view('livewire.portfolio.hero');
    }
}
