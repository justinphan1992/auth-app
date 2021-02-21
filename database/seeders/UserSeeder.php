<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            'username' => 'test123',
            'email' => 'test258@yopmail.com',
            'dob' => '1992-08-25',
            'password' => bcrypt('test123')
        ]);
    }
}
