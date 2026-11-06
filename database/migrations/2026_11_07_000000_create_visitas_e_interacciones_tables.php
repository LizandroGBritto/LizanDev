<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Una fila por visita (sesión de 30 min de un visitante). No guarda la IP:
        // `visitante` es un hash que cambia cada día.
        Schema::create('visitas', function (Blueprint $table) {
            $table->id();
            $table->string('visitante', 64)->index();
            $table->string('ruta', 191);
            $table->string('referente', 191)->nullable();
            $table->string('idioma', 5)->nullable();
            $table->string('dispositivo', 12);
            $table->string('navegador', 24);
            $table->timestamp('created_at')->nullable()->index();
        });

        // Qué hizo el visitante: proyecto visto, cambio de dispositivo, clic en demo, tecnología.
        Schema::create('interacciones', function (Blueprint $table) {
            $table->id();
            $table->string('visitante', 64)->index();
            $table->string('tipo', 24);
            $table->string('sujeto', 80)->nullable();
            $table->string('detalle', 24)->nullable();
            $table->timestamp('created_at')->nullable()->index();

            $table->index(['tipo', 'sujeto']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('interacciones');
        Schema::dropIfExists('visitas');
    }
};
