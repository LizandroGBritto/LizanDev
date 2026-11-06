<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    private const DEFAULT = 'en';

    /**
     * Toma el idioma de la sesión o, en la primera visita, del navegador.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $disponibles = config('app.available_locales', ['es', 'en']);
        $locale = Session::get('locale');

        if (! in_array($locale, $disponibles, true)) {
            $locale = $this->detectBrowserLocale($request, $disponibles);
            Session::put('locale', $locale);
        }

        App::setLocale($locale);

        return $next($request);
    }

    /**
     * Primer idioma de Accept-Language que el sitio tenga, con o sin región
     * (es-PY, en-GB). Si ninguno coincide cae en inglés: Symfony en ese caso
     * devolvería el primer idioma disponible, que sería español.
     *
     * @param  list<string>  $disponibles
     */
    private function detectBrowserLocale(Request $request, array $disponibles): string
    {
        foreach ($request->getLanguages() as $idioma) {
            $base = strtolower(substr($idioma, 0, 2));

            if (in_array($base, $disponibles, true)) {
                return $base;
            }
        }

        return self::DEFAULT;
    }
}
