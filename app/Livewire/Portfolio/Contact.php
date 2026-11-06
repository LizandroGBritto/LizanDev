<?php

namespace App\Livewire\Portfolio;

use App\Models\MensajeContacto;
use App\Services\Recaptcha;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\HtmlString;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Contact extends Component
{
    private const MAX_ENVIOS_POR_HORA = 5;

    #[Validate('required|min:3|max:120')]
    public string $nombre = '';

    #[Validate('required|email|max:190')]
    public string $correo = '';

    #[Validate('required|min:10|max:3000')]
    public string $mensaje = '';

    /** Trampa para bots: un humano no ve este campo. */
    public string $sitioWeb = '';

    /** Token de reCAPTCHA v3, lo completa features/recaptcha.js antes de enviar. */
    public string $recaptchaToken = '';

    public function submit(Recaptcha $recaptcha)
    {
        $this->validate();

        // Un bot que llena la trampa recibe la misma confirmación y no se guarda nada.
        if ($this->sitioWeb !== '') {
            return $this->confirmar();
        }

        $clave = 'contacto:'.request()->ip();

        if (RateLimiter::tooManyAttempts($clave, self::MAX_ENVIOS_POR_HORA)) {
            $this->addError('mensaje', __('Too many messages. Please try again later.'));

            return;
        }

        $puntaje = $recaptcha->puntaje($this->recaptchaToken, request()->ip());

        if (! $recaptcha->aprueba($puntaje)) {
            $this->recaptchaToken = '';
            $this->addError('mensaje', __('We could not verify that you are human. Please try again.'));

            return;
        }

        RateLimiter::hit($clave, 3600);

        MensajeContacto::create([
            'nombre' => $this->nombre,
            'correo' => $this->correo,
            'mensaje' => $this->mensaje,
            'idioma' => app()->getLocale(),
            'ip' => request()->ip(),
            'agente' => mb_substr((string) request()->userAgent(), 0, 255),
            'puntaje_recaptcha' => $puntaje,
        ]);

        return $this->confirmar();
    }

    private function confirmar(): void
    {
        $this->reset(['nombre', 'correo', 'mensaje', 'sitioWeb', 'recaptchaToken']);

        session()->flash('success', __('Message sent successfully!'));
    }

    public function render()
    {
        $contact = config('portfolio.contact');
        $cards = [
            ['icon' => 'mail', 'title' => 'Email', 'text' => $contact['email'], 'href' => 'mailto:'.$contact['email']],
            ['icon' => 'location', 'title' => __('Location'), 'text' => $contact['location'], 'href' => null],
            ['icon' => 'github', 'title' => 'GitHub', 'text' => $contact['github_handle'], 'href' => $contact['github_url']],
            ['icon' => 'linkedin', 'title' => 'LinkedIn', 'text' => $contact['linkedin_handle'], 'href' => $contact['linkedin_url']],
        ];
        $recaptchaSiteKey = app(Recaptcha::class)->habilitado() ? config('services.recaptcha.site_key') : null;
        $recaptchaNotice = $recaptchaSiteKey ? $this->recaptchaNotice() : null;

        return view('livewire.portfolio.contact', compact('cards', 'recaptchaSiteKey', 'recaptchaNotice'));
    }

    /** Aviso obligatorio de Google, en una sola frase para que cada idioma ordene las palabras a su manera. */
    private function recaptchaNotice(): HtmlString
    {
        $enlace = fn (string $url, string $texto) => '<a class="underline" href="'.$url.'" target="_blank" rel="noopener">'.e($texto).'</a>';

        $frase = e(__('Protected by reCAPTCHA. The Google :privacy and :terms apply.', [
            'privacy' => '@@privacy@@',
            'terms' => '@@terms@@',
        ]));

        return new HtmlString(strtr($frase, [
            '@@privacy@@' => $enlace('https://policies.google.com/privacy', __('Privacy Policy')),
            '@@terms@@' => $enlace('https://policies.google.com/terms', __('Terms of Service')),
        ]));
    }
}
