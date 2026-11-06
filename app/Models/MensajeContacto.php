<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class MensajeContacto extends Model
{
    protected $table = 'mensajes_contacto';

    protected $fillable = [
        'nombre',
        'correo',
        'mensaje',
        'idioma',
        'ip',
        'agente',
        'puntaje_recaptcha',
    ];

    protected function casts(): array
    {
        return [
            'leido_en' => 'datetime',
            'puntaje_recaptcha' => 'float',
        ];
    }

    public function scopeSinLeer(Builder $consulta): Builder
    {
        return $consulta->whereNull('leido_en');
    }

    /** Marca el mensaje como leído, o lo devuelve a «sin leer» si ya lo estaba. */
    public function alternarLeido(): void
    {
        $this->forceFill(['leido_en' => $this->estaLeido() ? null : now()])->save();
    }

    public function estaLeido(): bool
    {
        return $this->leido_en !== null;
    }
}
