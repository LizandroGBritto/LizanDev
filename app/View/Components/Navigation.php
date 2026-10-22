<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Navigation extends Component
{
    public function render(): View
    {
        $items = array_map(
            fn (array $item) => ['id' => $item['id'], 'label' => __($item['label'])],
            config('portfolio.navigation'),
        );

        return view('partials.navigation', compact('items'));
    }
}
