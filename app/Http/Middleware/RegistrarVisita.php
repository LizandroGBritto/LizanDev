<?php

namespace App\Http\Middleware;

use App\Models\Visita;
use App\Support\Seguimiento\Visitante;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

/**
 * Cuenta una visita por visitante cada 30 minutos. Nunca rompe la página: si
 * guardar falla, se anota en el log y el visitante no se entera.
 */
class RegistrarVisita
{
    public function handle(Request $request, Closure $next): Response
    {
        $respuesta = $next($request);

        if ($request->isMethod('GET') && $respuesta->getStatusCode() === 200 && ! Visitante::ignorar($request)) {
            $this->registrar($request);
        }

        return $respuesta;
    }

    private function registrar(Request $request): void
    {
        try {
            $visitante = Visitante::hash($request);

            if (! Cache::add('visita:'.$visitante, true, now()->addMinutes(30))) {
                return;
            }

            $referente = parse_url((string) $request->headers->get('referer'), PHP_URL_HOST) ?: null;

            Visita::create([
                'visitante' => $visitante,
                'ruta' => mb_substr('/'.ltrim($request->path(), '/'), 0, 191),
                'referente' => $referente && $referente !== $request->getHost() ? mb_substr($referente, 0, 191) : null,
                'idioma' => app()->getLocale(),
                'dispositivo' => Visitante::dispositivo($request->userAgent()),
                'navegador' => Visitante::navegador($request->userAgent()),
            ]);
        } catch (\Throwable $error) {
            Log::warning('No se pudo registrar la visita: '.$error->getMessage());
        }
    }
}
