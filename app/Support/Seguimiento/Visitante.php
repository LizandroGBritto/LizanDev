<?php

namespace App\Support\Seguimiento;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Identifica sin cookies ni IP guardada: el visitante es un hash de IP + navegador
 * + fecha, así que no se puede seguir a nadie de un día para otro ni volver a la IP.
 */
class Visitante
{
    private const ROBOTS = '/bot|crawl|spider|slurp|curl|wget|python|httpclient|headless|lighthouse|preview|monitor|facebookexternalhit|whatsapp|telegram|go-http|java\//i';

    public static function hash(Request $request): string
    {
        return hash_hmac(
            'sha256',
            $request->ip().'|'.$request->userAgent().'|'.now()->format('Y-m-d'),
            (string) config('app.key'),
        );
    }

    /** No se registra a robots, a quien pidió no ser rastreado ni al administrador logueado. */
    public static function ignorar(Request $request): bool
    {
        $agente = (string) $request->userAgent();

        return $agente === ''
            || preg_match(self::ROBOTS, $agente) === 1
            || $request->header('DNT') === '1'
            || $request->header('Sec-GPC') === '1'
            || Auth::check();
    }

    public static function dispositivo(?string $agente): string
    {
        $agente = (string) $agente;

        return match (true) {
            (bool) preg_match('/ipad|tablet|kindle|silk|playbook/i', $agente) => 'tablet',
            (bool) preg_match('/mobi|android|iphone|ipod/i', $agente) => 'movil',
            default => 'escritorio',
        };
    }

    public static function navegador(?string $agente): string
    {
        $agente = (string) $agente;

        return match (true) {
            str_contains($agente, 'Edg/') => 'Edge',
            str_contains($agente, 'OPR/') || str_contains($agente, 'Opera') => 'Opera',
            str_contains($agente, 'Firefox/') => 'Firefox',
            str_contains($agente, 'Chrome/') || str_contains($agente, 'CriOS/') => 'Chrome',
            str_contains($agente, 'Safari/') => 'Safari',
            default => 'Otro',
        };
    }
}
