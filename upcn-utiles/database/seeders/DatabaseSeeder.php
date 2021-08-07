<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(AfiliadoSeeder::class);
        $this->call(KitSeeder::class);
        $this->call(AsignacionSeeder::class);
    }
}
