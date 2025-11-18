<?php

use Illuminate\Support\Facades\Route;

// Redirección desde la raíz
Route::get('/', function () {
    return redirect('/LizanDev');
});

// Portfolio Landing Page
Route::prefix('LizanDev')->group(function () {
    Route::get('/', function () {
        return view('portfolio.index');
    })->name('portfolio.index');
});
