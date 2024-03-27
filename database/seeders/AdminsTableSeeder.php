<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->insert([
            [
                'name' => 'Admin1',
                'email' => 'admin1@example.com',
                'password' => Hash::make('123'),
            ],
            [
                'name' => 'Admin2',
                'email' => 'admin2@example.com',
                'password' => Hash::make('123'),
            ],
        ]);
    }
}
