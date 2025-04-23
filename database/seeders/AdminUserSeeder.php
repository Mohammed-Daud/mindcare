<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if admin user already exists
        if (!User::where('email', 'admin@admin.com')->exists()) {
            User::create([
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('12345678'),
                'email_verified_at' => now(),
                'is_admin' => true,
            ]);

            $this->command->info('Admin user created successfully.');
        } else {
            $this->command->info('Admin user already exists.');
        }
    }
}
