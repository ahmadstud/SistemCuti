<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'ic' => 'A1234567A',
            'phone_number' => '1234567890',
        ]);

        User::create([
            'name' => 'staff',
            'email' => 'staff@example.com',
            'password' => Hash::make('password'),
            'role' => 'staff',
            'ic' => 'S1234567A',
            'phone_number' => '0987654321',
        ]);

        User::create([
            'name' => 'officer',
            'email' => 'officer@example.com',
            'password' => Hash::make('password'),
            'role' => 'officer',
            'ic' => 'O1234567A',
            'phone_number' => '1122334455',
        ]);

    }
}
