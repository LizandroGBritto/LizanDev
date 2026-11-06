<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

/**
 * Verificación de reCAPTCHA v3 contra Google. Devuelve el puntaje (0 a 1) o
 * null si el token no es válido. Sin clave secreta solo se acepta en local y
 * en tests; en producción falla cerrado para no dejar el formulario abierto.
 */
class Recaptcha
{
    public const ACCION = 'contacto';

    public function habilitado(): bool
    {
        return filled(config('services.recaptcha.site_key')) && filled(config('services.recaptcha.secret_key'));
    }

    public function puntaje(?string $token, ?string $ip): ?float
    {
        if (! $this->habilitado()) {
            return app()->environment('local', 'testing') ? 1.0 : null;
        }

        if (blank($token)) {
            return null;
        }

        $respuesta = Http::asForm()->timeout(5)->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => config('services.recaptcha.secret_key'),
            'response' => $token,
            'remoteip' => $ip,
        ]);

        if (! $respuesta->ok() || ! $respuesta->json('success') || $respuesta->json('action') !== self::ACCION) {
            return null;
        }

        return (float) $respuesta->json('score', 0);
    }

    public function aprueba(?float $puntaje): bool
    {
        return $puntaje !== null && $puntaje >= (float) config('services.recaptcha.minimum_score');
    }
}
