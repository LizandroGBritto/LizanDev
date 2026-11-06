<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

/**
 * Crea o actualiza al administrador del panel con ADMIN_EMAIL y
 * ADMIN_PASSWORD del .env. Sin esas variables no hace nada.
 */
class AdministradorSeeder extends Seeder
{
    public function run(): void
    {
        ['nombre' => $nombre, 'correo' => $correo, 'clave' => $clave] = config('panel.administrador');

        if (blank($correo) || blank($clave)) {
            $this->command?->warn('Definí ADMIN_EMAIL y ADMIN_PASSWORD en el .env para crear al administrador.');

            return;
        }

        User::updateOrCreate(
            ['email' => $correo],
            ['name' => $nombre, 'password' => $clave],
        );
    }
}
