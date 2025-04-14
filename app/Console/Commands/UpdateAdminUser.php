<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class UpdateAdminUser extends Command
{
    protected $signature = 'admin:update {email} {password?}';
    protected $description = 'Update or create an admin user';

    public function handle()
    {
        $email = $this->argument('email');
        $password = $this->argument('password');

        $user = User::where('email', $email)->first();

        if ($user) {
            $user->is_admin = true;
            if ($password) {
                $user->password = Hash::make($password);
            }
            $user->save();
            $this->info('Admin user has been updated.');
        } else {
            // Create new admin user
            User::create([
                'name' => 'Admin',
                'email' => $email,
                'password' => Hash::make($password ?? '12345678'),
                'is_admin' => true,
            ]);
            $this->info('Admin user has been created.');
        }

        return Command::SUCCESS;
    }
} 