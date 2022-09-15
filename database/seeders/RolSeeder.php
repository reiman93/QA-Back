<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rols')->insert([
            'name' => "ADMIN",
            'description' => 'Administrador del sistema',
        ]);
        DB::table('rols')->insert([
            'name' => "QA",
            'description' => 'Analista de calidad del sistema',
        ]);
    }
}
