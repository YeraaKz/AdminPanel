<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('posts')->insert([
            [
                'warehouse' => 'Almaty',
                'city' => 'Atyrau',
                'card' => 'Black',
                'quantity' => 300,
                'date' => '2024-03-01 06:11:19',
                'status' => 'New',
            ],
            [
                'warehouse' => 'Almaty',
                'city' => 'Atyrau',
                'card' => 'Black',
                'quantity' => 300,
                'date' => '2024-03-01 06:11:19',
                'status' => 'New',
            ],
            [
                'warehouse' => 'Almaty',
                'city' => 'Aktobe',
                'card' => 'Black',
                'quantity' => 300,
                'date' => '2024-03-01 06:11:19',
                'status' => 'New',
            ],
            [
                'warehouse' => 'Aktobe',
                'city' => 'Aktau',
                'card' => 'Black',
                'quantity' => 300,
                'date' => '2024-03-01 06:11:19',
                'status' => 'New',
            ],
            [
                'warehouse' => 'Almaty',
                'city' => 'Atyrau',
                'card' => 'Black',
                'quantity' => 300,
                'date' => '2024-03-01 06:11:19',
                'status' => 'New',
            ],
            [
                'warehouse' => 'Almaty',
                'city' => 'Atyrau',
                'card' => 'Black',
                'quantity' => 300,
                'date' => '2024-03-01 06:11:19',
                'status' => 'New',
            ],
            [
                'warehouse' => 'Almaty',
                'city' => 'Atyrau',
                'card' => 'Black',
                'quantity' => 300,
                'date' => '2024-03-01 06:11:19',
                'status' => 'New',
            ],
            [
                'warehouse' => 'Almaty',
                'city' => 'Aktobe',
                'card' => 'Black',
                'quantity' => 300,
                'date' => '2024-03-01 06:11:19',
                'status' => 'New',
            ],
            [
                'warehouse' => 'Almaty',
                'city' => 'Aktobe',
                'card' => 'Black',
                'quantity' => 300,
                'date' => '2024-03-01 06:11:19',
                'status' => 'New',
            ],
        ]);
    }
}
