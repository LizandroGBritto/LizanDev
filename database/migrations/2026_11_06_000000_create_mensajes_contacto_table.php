<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mensajes_contacto', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 120);
            $table->string('correo', 190);
            $table->text('mensaje');
            $table->string('idioma', 5)->nullable();
            $table->string('ip', 45)->nullable();
            $table->string('agente', 255)->nullable();
            $table->decimal('puntaje_recaptcha', 3, 2)->nullable();
            $table->timestamp('leido_en')->nullable();
            $table->timestamps();

            $table->index('leido_en');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mensajes_contacto');
    }
};
