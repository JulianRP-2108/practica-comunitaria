<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AfiliadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('afiliados')->insert([
            'nombre' => 'Martin',
            'apellido' => 'Perez Roman',
            'dni' => '39932955',
            'email' => 'tperezroman'.'@gmail.com',
            'telefono' => '2954548482',
            'localidad' => 'General Pico',
            'cantidadHijos' => 1,
            'tipoEmpleado' => 'publico',
        ]);

        DB::table('afiliados')->insert([
            'nombre' => 'David',
            'apellido' => 'Perez Roman',
            'dni' => '38037562',
            'email' => 'david'.'@gmail.com',
            'telefono' => '2954646973',
            'localidad' => 'General Pico',
            'cantidadHijos' => 1,
            'tipoEmpleado' => 'publico',
        ]);
    }
}
