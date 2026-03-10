<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create an Admin user
        User::updateOrCreate(
            ['email' => 'admin@payment.com'],
            [
                'name' => 'Admin Payment',
                'password' => Hash::make('admin123'),
                'email_verified_at' => now(),
            ]
        );

        // Create some demo users using factory if factory exists
        User::factory(10)->create();
    }
}
