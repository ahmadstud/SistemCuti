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
            'address' => '123 Admin Street',
            'city' => 'Admin City',
            'postcode' => '12345',
            'state' => 'Admin State',
            'job_status' => 'active',
            'total_mc_days' => 0,
        ]);

        User::create([
            'name' => 'staff',
            'email' => 'staff@example.com',
            'password' => Hash::make('password'),
            'role' => 'staff',
            'ic' => 'S1234567A',
            'phone_number' => '0987654321',
            'address' => '456 Staff Avenue',
            'city' => 'Staff City',
            'postcode' => '67890',
            'state' => 'Staff State',
            'job_status' => 'active',
            'total_mc_days' => 0,
        ]);

        User::create([
            'name' => 'officer',
            'email' => 'officer@example.com',
            'password' => Hash::make('password'),
            'role' => 'officer',
            'ic' => 'O1234567A',
            'phone_number' => '1122334455',
            'address' => '789 Officer Boulevard',
            'city' => 'Officer City',
            'postcode' => '13579',
            'state' => 'Officer State',
            'job_status' => 'active',
            'total_mc_days' => 0,
        ]);
    }
}
