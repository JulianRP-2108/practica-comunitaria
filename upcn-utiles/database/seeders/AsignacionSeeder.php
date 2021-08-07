<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AsignacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0; $i<15; $i++){
            DB::table('asignaciones')->insert([
                'fkIdAfiliado' => 1,
                'fkIdKit' => 1,
                'fkIdUsuario' => 1,
                'cantidad' => 3,
            ]);
        }
    }
}
