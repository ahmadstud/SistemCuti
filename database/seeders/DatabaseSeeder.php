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
            'state' => '',
            'job_status' => 'Permenant',
            'fullname' => 'admin',
            'selected_officer_id' => '',

        ]);
    }
}
