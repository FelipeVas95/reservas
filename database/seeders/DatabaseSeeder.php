<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // crear roles
        $adminRole = Role::create(['name' => 'administrador']);
        $clientRole = Role::create(['name' => 'cliente']);

        //crear permisos
        Permission::create(['name' => 'gestionar salas']);
        Permission::create(['name' => 'gestionar reservas']);
        Permission::create(['name' => 'reservar espacios']);
       
        


        // asignar permisos a roles
        $adminRole->givePermissionTo(['gestionar salas', 'gestionar reservas', 'reservar espacios']);
        $clientRole->givePermissionTo('reservar espacios'); 

        //ejecutar demas seeders
         $this->call([
            UsersSeeder::class, 
            WorkspacesSeeder::class, 
        ]); 
    }
}
