<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visita extends Model
{
    public const UPDATED_AT = null;

    protected $table = 'visitas';

    protected $fillable = ['visitante', 'ruta', 'referente', 'idioma', 'dispositivo', 'navegador'];
}
