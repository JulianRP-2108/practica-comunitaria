<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kits')->insert([
            'nivel' => 'inicial',
            'descripcion' => 'Descripcion de lo que lleva el kit inicial',
            'stock' => 55,
        ]);

        DB::table('kits')->insert([
            'nivel' => 'primario',
            'descripcion' => 'Descripcion de lo que lleva el kit primario',
            'stock' => 87,
        ]);

        DB::table('kits')->insert([
            'nivel' => 'secundario',
            'descripcion' => 'Descripcion de lo que lleva el kit secundario',
            'stock' => 65,
        ]);
    }
}
