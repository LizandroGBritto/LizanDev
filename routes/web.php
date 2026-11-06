<?php

use App\Http\Controllers\Admin\MensajeController;
use App\Http\Controllers\Admin\SesionController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'portfolio.index')->name('inicio');

/*
| Panel de administración: solo para ver las solicitudes de contacto.
| No hay registro; el administrador se crea con el seeder.
*/
Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('ingresar', [SesionController::class, 'create'])->name('ingresar');
        Route::post('ingresar', [SesionController::class, 'store'])->middleware('throttle:5,1')->name('ingresar.store');
    });

    Route::middleware('auth')->group(function () {
        Route::redirect('/', '/admin/mensajes')->name('inicio');
        Route::post('salir', [SesionController::class, 'destroy'])->name('salir');
        Route::get('mensajes', [MensajeController::class, 'index'])->name('mensajes.index');
        Route::patch('mensajes/{mensaje}/leido', [MensajeController::class, 'marcarLeido'])->name('mensajes.leido');
        Route::delete('mensajes/{mensaje}', [MensajeController::class, 'destroy'])->name('mensajes.destroy');
    });
});
