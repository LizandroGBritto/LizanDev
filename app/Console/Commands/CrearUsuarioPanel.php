<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CrearUsuarioPanel extends Command
{
    protected $signature = 'panel:usuario {nombre : Nombre completo} {correo : Email para ingresar}
                            {--actualizar : Si el correo ya existe, le genera una contraseña nueva}';

    protected $description = 'Crea un usuario del panel con una contraseña aleatoria que se muestra una única vez';

    public function handle(): int
    {
        $datos = ['nombre' => trim($this->argument('nombre')), 'correo' => strtolower(trim($this->argument('correo')))];

        $validador = Validator::make($datos, [
            'nombre' => ['required', 'string', 'max:255'],
            'correo' => ['required', 'email', 'max:255'],
        ]);

        if ($validador->fails()) {
            $this->error($validador->errors()->first());

            return self::FAILURE;
        }

        $existente = User::where('email', $datos['correo'])->first();

        if ($existente && ! $this->option('actualizar')) {
            $this->error("Ya existe un usuario con {$datos['correo']}. Usá --actualizar para generarle otra contraseña.");

            return self::FAILURE;
        }

        $clave = Str::random(20);

        User::updateOrCreate(
            ['email' => $datos['correo']],
            ['name' => $datos['nombre'], 'password' => $clave],
        );

        $this->info($existente ? 'Usuario actualizado.' : 'Usuario creado.');
        $this->line("Nombre:     {$datos['nombre']}");
        $this->line("Email:      {$datos['correo']}");
        $this->line("Contraseña: {$clave}");
        $this->warn('Esta contraseña no se guarda en ningún lado y no se vuelve a mostrar.');

        return self::SUCCESS;
    }
}
