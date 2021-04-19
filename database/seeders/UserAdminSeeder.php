<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'firstname' => "Mashiyyat",
            'lastname' => "Delos Santos",
            'role' => 'admin',
            'email' => 'delossantos.mash@gmail.com',
            'image' => 'none',
            'address' => 'none',
            'contact' => '09982205660',
            'password' => Hash::make('11111111')
        ]);
    }
}
