<?php

namespace App\Livewire;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class LanguageSwitcher extends Component
{
    public $currentLocale;
    public $isOpen = false;

    public function mount()
    {
        $this->currentLocale = App::getLocale();
    }

    public function switchLocale($locale)
    {
        $availableLocales = config('app.available_locales', ['es', 'en']);

        if (in_array($locale, $availableLocales)) {
            Session::put('locale', $locale);
            App::setLocale($locale);
            $this->currentLocale = $locale;
            $this->isOpen = false;

            // Disparar evento JavaScript para recargar la página
            $this->dispatch('locale-changed');
        }
    }

    public function toggleDropdown()
    {
        $this->isOpen = !$this->isOpen;
    }

    public function render()
    {
        return view('livewire.language-switcher');
    }
}
