<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersSeeder extends Seeder
{

    public function run()
    {
        //crear usuarios
        $admin = User::create([
            'name' => 'Administrador',
            'email' => 'admin@administrador.com',
            'password' => bcrypt('12345678'),  
        ]);

        $admin->assignRole('administrador');

        $user = User::create([
            'name' => 'Cliente',
            'email' => 'cliente@gmail.com',
            'password' => bcrypt('12345678'),
        ]);

        $user->assignRole('cliente');
    }
}
