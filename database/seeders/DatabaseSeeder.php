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

        // Verificar y crear roles
        $adminRole = Role::firstOrCreate(['name' => 'administrador']);
        $clientRole = Role::firstOrCreate(['name' => 'cliente']);

        // Crear permisos solo si no existen
        Permission::firstOrCreate(['name' => 'gestionar salas']);
        Permission::firstOrCreate(['name' => 'gestionar reservas']);
        Permission::firstOrCreate(['name' => 'reservar espacios']);




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
