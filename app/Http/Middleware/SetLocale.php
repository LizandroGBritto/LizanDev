<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verificar si hay un idioma en la sesión
        if (Session::has('locale')) {
            $locale = Session::get('locale');
        } else {
            // Detectar idioma del navegador
            $locale = $this->detectBrowserLocale($request);
            Session::put('locale', $locale);
        }

        // Establecer el idioma de la aplicación
        App::setLocale($locale);

        return $next($request);
    }

    /**
     * Detectar el idioma preferido del navegador
     */
    private function detectBrowserLocale(Request $request): string
    {
        $availableLocales = config('app.available_locales', ['es', 'en']);
        $browserLocale = $request->getPreferredLanguage($availableLocales);

        // Si el navegador devuelve algo válido, usarlo
        if ($browserLocale && in_array($browserLocale, $availableLocales)) {
            return $browserLocale;
        }

        // Si el navegador usa variantes (es-ES, es-MX, en-US, en-GB)
        $acceptLanguage = $request->header('Accept-Language');
        if ($acceptLanguage) {
            $languages = explode(',', $acceptLanguage);
            foreach ($languages as $language) {
                $lang = substr($language, 0, 2);
                if (in_array($lang, $availableLocales)) {
                    return $lang;
                }
            }
        }

        // Por defecto, usar ingles
        return 'en';
    }
}
