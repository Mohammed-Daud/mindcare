<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdminUser extends Command
{
    protected $signature = 'admin:create {email} {password}';
    protected $description = 'Create an admin user with specified email and password';

    public function handle()
    {
        $email = $this->argument('email');
        $password = $this->argument('password');

        // Check if user already exists
        $user = User::where('email', $email)->first();
        
        if ($user) {
            // Update existing user to admin
            $user->is_admin = true;
            $user->password = Hash::make($password);
            $user->save();
            $this->info('Existing user has been updated to admin.');
        } else {
            // Create new admin user
            User::create([
                'name' => 'Admin',
                'email' => $email,
                'password' => Hash::make($password),
                'is_admin' => true,
            ]);
            $this->info('Admin user created successfully.');
        }

        return Command::SUCCESS;
    }
} 