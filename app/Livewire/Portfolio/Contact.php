<?php

namespace App\Livewire\Portfolio;

use App\Models\MensajeContacto;
use App\Services\Recaptcha;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\HtmlString;
use Livewire\Component;

class Contact extends Component
{
    private const MAX_ENVIOS_POR_HORA = 5;

    public string $nombre = '';

    public string $correo = '';

    public string $mensaje = '';

    /** Trampa para bots: un humano no ve este campo. */
    public string $sitioWeb = '';

    /** Token de reCAPTCHA v3, lo completa features/recaptcha.js antes de enviar. */
    public string $recaptchaToken = '';

    /** El dominio del correo lleva al menos un punto: «ana@localhost» pasa `email` pero no sirve para responder. */
    private const CORREO_CON_DOMINIO = '/@[^@\s]+\.[^@\s.]{2,}$/';

    protected function rules(): array
    {
        return [
            'nombre' => ['required', 'string', 'min:3', 'max:120'],
            'correo' => ['required', 'string', 'email:rfc', 'regex:'.self::CORREO_CON_DOMINIO, 'not_regex:/\s/', 'max:190'],
            'mensaje' => ['required', 'string', 'min:10', 'max:3000'],
        ];
    }

    /** Un mensaje por cada regla, en el idioma de la sesión y sin nombres internos de campo. */
    protected function messages(): array
    {
        return [
            'nombre.required' => __('Please enter your name.'),
            'nombre.min' => __('Your name must have at least :min characters.', ['min' => 3]),
            'nombre.max' => __('Your name cannot be longer than :max characters.', ['max' => 120]),
            'correo.required' => __('Please enter your email.'),
            'correo.email' => __('Enter a valid email, like name@example.com.'),
            'correo.regex' => __('Enter a valid email, like name@example.com.'),
            'correo.not_regex' => __('Enter a valid email, like name@example.com.'),
            'correo.max' => __('Your email cannot be longer than :max characters.', ['max' => 190]),
            'mensaje.required' => __('Please write your message.'),
            'mensaje.min' => __('Your message must have at least :min characters.', ['min' => 10]),
            'mensaje.max' => __('Your message cannot be longer than :max characters.', ['max' => 3000]),
        ];
    }

    public function submit(Recaptcha $recaptcha)
    {
        // Sin espacios de más: «   » no es un nombre y los espacios no cuentan como mensaje.
        $this->nombre = trim($this->nombre);
        $this->correo = trim($this->correo);
        $this->mensaje = trim($this->mensaje);

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
