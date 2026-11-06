<?php

use App\Http\Controllers\Admin\MensajeController;
use App\Http\Controllers\Admin\ResumenController;
use App\Http\Controllers\Admin\SesionController;
use App\Http\Controllers\SeguimientoController;
use App\Http\Middleware\RegistrarVisita;
use Illuminate\Support\Facades\Route;

Route::view('/', 'portfolio.index')->middleware(RegistrarVisita::class)->name('inicio');

// Interacciones del visitante (proyecto visto, demo, tecnología). Responde 204.
Route::post('seguimiento', [SeguimientoController::class, 'store'])->middleware('throttle:120,1')->name('seguimiento');

/*
| Acceso al panel: solo login. No hay registro ni recuperación de contraseña;
| los usuarios se crean con `php artisan panel:usuario`.
*/
Route::middleware('guest')->group(function () {
    Route::get('login', [SesionController::class, 'create'])->name('login');
    Route::post('login', [SesionController::class, 'store'])->middleware('throttle:login')->name('login.store');
});

Route::redirect('admin/ingresar', '/login', 301);
Route::post('logout', [SesionController::class, 'destroy'])->middleware('auth')->name('logout');

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', ResumenController::class)->name('resumen');
    Route::get('mensajes', [MensajeController::class, 'index'])->name('mensajes.index');
    Route::patch('mensajes/{mensaje}/leido', [MensajeController::class, 'marcarLeido'])->name('mensajes.leido');
    Route::delete('mensajes/{mensaje}', [MensajeController::class, 'destroy'])->name('mensajes.destroy');
});
