<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => "Reiman Alfonso Azcuy",
            'username' => 'razcuy',
            'email' => 'reiman@gmail.com',
            'phone_number' => '555555',
            'rols_id' => 1,
            'departments_id' => 1,
            'password' => Hash::make('admin123'),
        ]);
        DB::table('users')->insert([
            'name' => "Juana de Arco",
            'username' => 'jdarco',
            'email' => 'jdarco@gmail.com',
            'phone_number' => '555546',
            'rols_id' => 2,
            'departments_id' => 1,
            'password' => Hash::make('qa'),
        ]);


        
    }
}
