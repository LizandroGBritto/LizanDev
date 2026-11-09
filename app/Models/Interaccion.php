<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Interaccion extends Model
{
    public const UPDATED_AT = null;

    public const PROYECTO_VISTO = 'proyecto_visto';
    public const VISTA_DISPOSITIVO = 'vista_dispositivo';
    public const DEMO_CLIC = 'demo_clic';
    public const TECNOLOGIA = 'tecnologia';
    public const DETALLE_ABIERTO = 'detalle_abierto';

    public const TIPOS = [self::PROYECTO_VISTO, self::VISTA_DISPOSITIVO, self::DEMO_CLIC, self::TECNOLOGIA, self::DETALLE_ABIERTO];

    protected $table = 'interacciones';

    protected $fillable = ['visitante', 'tipo', 'sujeto', 'detalle'];
}
