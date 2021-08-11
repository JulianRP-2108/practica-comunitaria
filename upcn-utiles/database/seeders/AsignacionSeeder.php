<?php

namespace Database\Seeders;

use Carbon\Carbon;
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
                'fkIdAfiliado' => rand(1,3),
                'fkIdKit' => rand(1,3),
                'fkIdUsuario' => 1,
                'cantidad' => rand(1,4),
                'created_at' => Carbon::now()
            ]);
        }

        for($i=0; $i<5; $i++){
            DB::table('asignaciones')->insert([
                'fkIdAfiliado' => rand(1,3),
                'fkIdKit' => rand(1,3),
                'fkIdUsuario' => 1,
                'cantidad' => rand(1,4),
                'created_at' => Carbon::parse('2021-02-10')
            ]);
        }

        for($i=0; $i<10; $i++){
            DB::table('asignaciones')->insert([
                'fkIdAfiliado' => rand(1,3),
                'fkIdKit' => rand(1,3),
                'fkIdUsuario' => 1,
                'cantidad' => rand(1,4),
                'created_at' => Carbon::parse('2020-02-15')
            ]);
        }
    }
}
