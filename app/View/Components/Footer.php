<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Footer extends Component
{
    public function render(): View
    {
        $year = date('Y');
        $socials = config('portfolio.socials');

        return view('partials.footer', compact('year', 'socials'));
    }
}
