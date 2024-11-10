<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorkspacesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { //crear salas
        DB::table('workspaces')->insert([
            [
                'name' => 'Sala 101',
                'description' => 'Sala para reuniones pequeñas.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sala 102',
                'description' => 'Sala para reuniones medianas con equipo de videoconferencia.',  
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sala 201',
                'description' => 'Sala para talleres o capacitaciones.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sala 202',
                'description' => 'Sala para trabajo en grupo con pizarras.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
