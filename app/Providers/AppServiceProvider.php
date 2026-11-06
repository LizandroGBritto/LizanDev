<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // 5 intentos por minuto por cuenta y por IP: frena la fuerza bruta sin
        // dejar que alguien bloquee la cuenta del administrador desde otra IP.
        RateLimiter::for('login', function (Request $request) {
            $correo = $request->input('email');

            // Un valor que no es texto (p. ej. email[]=x) no debe romper el límite.
            return Limit::perMinute(5)->by((is_string($correo) ? strtolower($correo) : 'invalido').'|'.$request->ip());
        });
    }
}
