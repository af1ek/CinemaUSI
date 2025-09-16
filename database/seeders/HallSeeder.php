<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Hall;

class HallSeeder extends Seeder
{
    public function run(): void
    {
        Hall::create(['name' => 'Main Hall', 'total_seats' => 200]);
        Hall::create(['name' => 'VIP Hall', 'total_seats' => 50]);
    }
}
