<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UsersSeeder extends Seeder
{

    public function run()
    {
        // Crear usuarios
        $admin = User::firstOrCreate(
            ['email' => 'admin@administrador.com'], // Condición de búsqueda
            [ // Datos a crear si no existe
                'name' => 'Administrador',
                'password' => bcrypt('12345678'),
            ]
        );

        // Asegurar que el rol 'administrador' exista antes de asignarlo
        if (Role::where('name', 'administrador')->exists()) {
            $admin->assignRole('administrador');
        } else {
            echo "El rol 'administrador' no existe.";
        }

        $user = User::firstOrCreate(
            ['email' => 'cliente@gmail.com'], // Condición de búsqueda
            [ // Datos a crear si no existe
                'name' => 'Cliente',
                'password' => bcrypt('12345678'),
            ]
        );

        // Asegurar que el rol 'cliente' exista antes de asignarlo
        if (Role::where('name', 'cliente')->exists()) {
            $user->assignRole('cliente');
        } else {
            echo "El rol 'cliente' no existe.";
        }
    }
}
