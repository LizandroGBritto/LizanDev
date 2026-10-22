<?php

namespace App\Livewire\Portfolio;

use Livewire\Component;
use Livewire\Attributes\Validate;

class Contact extends Component
{
    #[Validate('required|min:3')]
    public $name = '';

    #[Validate('required|email')]
    public $email = '';

    #[Validate('required|min:10')]
    public $message = '';

    public $sent = false;

    public function submit()
    {
        $this->validate();

        // Aquí puedes implementar el envío del email
        // Mail::to('tu@email.com')->send(new ContactMail($this->name, $this->email, $this->message));

        $this->sent = true;
        $this->reset(['name', 'email', 'message']);

        session()->flash('success', '¡Mensaje enviado exitosamente!');
    }

    public function render()
    {
        $contact = config('portfolio.contact');
        $cards = [
            ['icon' => 'mail', 'title' => 'Email', 'text' => $contact['email'], 'href' => 'mailto:'.$contact['email']],
            ['icon' => 'location', 'title' => 'Ubicación', 'text' => $contact['location'], 'href' => null],
            ['icon' => 'github', 'title' => 'GitHub', 'text' => $contact['github_handle'], 'href' => $contact['github_url']],
        ];

        return view('livewire.portfolio.contact', compact('cards'));
    }
}
