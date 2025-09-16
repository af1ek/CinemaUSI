<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
            'role' => 'admin'
        ]);

        User::create([
            'username' => 'visitor1',
            'email' => 'milan@gmail.com',
            'password' => Hash::make('123'),
            'role' => 'visitor'
        ]);
    }
}
