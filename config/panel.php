<?php

/*
| Administrador del panel de solicitudes de contacto. El seeder
| AdministradorSeeder lo crea o actualiza con estos valores.
*/
return [
    'administrador' => [
        'nombre' => env('ADMIN_NAME', 'Administrador'),
        'correo' => env('ADMIN_EMAIL'),
        'clave' => env('ADMIN_PASSWORD'),
    ],
];
