<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // First, ensure the password_reset_tokens table has the user_type column
        if (Schema::hasTable('password_reset_tokens') && !Schema::hasColumn('password_reset_tokens', 'user_type')) {
            Schema::table('password_reset_tokens', function (Blueprint $table) {
                $table->string('user_type')->default('user')->after('token');
            });
        }

        // Migrate tokens from client_password_reset_tokens if it exists
        if (Schema::hasTable('client_password_reset_tokens')) {
            $clientTokens = DB::table('client_password_reset_tokens')->get();
            
            foreach ($clientTokens as $token) {
                // Check if this email already exists in the main table
                $existingToken = DB::table('password_reset_tokens')
                    ->where('email', $token->email)
                    ->first();
                
                if ($existingToken) {
                    // Update the existing record
                    DB::table('password_reset_tokens')
                        ->where('email', $token->email)
                        ->update([
                            'token' => $token->token,
                            'user_type' => 'client',
                            'created_at' => $token->created_at
                        ]);
                } else {
                    // Insert a new record
                    DB::table('password_reset_tokens')->insert([
                        'email' => $token->email,
                        'token' => $token->token,
                        'user_type' => 'client',
                        'created_at' => $token->created_at
                    ]);
                }
            }
            
            // Drop the client_password_reset_tokens table
            Schema::dropIfExists('client_password_reset_tokens');
        }
        
        // Do the same for admin_password_reset_tokens if it exists
        if (Schema::hasTable('admin_password_reset_tokens')) {
            $adminTokens = DB::table('admin_password_reset_tokens')->get();
            
            foreach ($adminTokens as $token) {
                $existingToken = DB::table('password_reset_tokens')
                    ->where('email', $token->email)
                    ->first();
                
                if ($existingToken) {
                    DB::table('password_reset_tokens')
                        ->where('email', $token->email)
                        ->update([
                            'token' => $token->token,
                            'user_type' => 'admin',
                            'created_at' => $token->created_at
                        ]);
                } else {
                    DB::table('password_reset_tokens')->insert([
                        'email' => $token->email,
                        'token' => $token->token,
                        'user_type' => 'admin',
                        'created_at' => $token->created_at
                    ]);
                }
            }
            
            Schema::dropIfExists('admin_password_reset_tokens');
        }
        
        // Do the same for professional_password_reset_tokens if it exists
        if (Schema::hasTable('professional_password_reset_tokens')) {
            $professionalTokens = DB::table('professional_password_reset_tokens')->get();
            
            foreach ($professionalTokens as $token) {
                $existingToken = DB::table('password_reset_tokens')
                    ->where('email', $token->email)
                    ->first();
                
                if ($existingToken) {
                    DB::table('password_reset_tokens')
                        ->where('email', $token->email)
                        ->update([
                            'token' => $token->token,
                            'user_type' => 'professional',
                            'created_at' => $token->created_at
                        ]);
                } else {
                    DB::table('password_reset_tokens')->insert([
                        'email' => $token->email,
                        'token' => $token->token,
                        'user_type' => 'professional',
                        'created_at' => $token->created_at
                    ]);
                }
            }
            
            Schema::dropIfExists('professional_password_reset_tokens');
        }
    }

    /**
     * Reverse the migrations.
     * 
     * Note: This is a destructive migration that consolidates tables.
     * The down method cannot fully restore the original state.
     */
    public function down(): void
    {
        // We can recreate the tables, but we can't restore the data
        if (!Schema::hasTable('client_password_reset_tokens')) {
            Schema::create('client_password_reset_tokens', function (Blueprint $table) {
                $table->string('email')->primary();
                $table->string('token');
                $table->timestamp('created_at')->nullable();
            });
        }
        
        if (!Schema::hasTable('admin_password_reset_tokens')) {
            Schema::create('admin_password_reset_tokens', function (Blueprint $table) {
                $table->string('email')->primary();
                $table->string('token');
                $table->timestamp('created_at')->nullable();
            });
        }
        
        if (!Schema::hasTable('professional_password_reset_tokens')) {
            Schema::create('professional_password_reset_tokens', function (Blueprint $table) {
                $table->string('email')->primary();
                $table->string('token');
                $table->timestamp('created_at')->nullable();
            });
        }
    }
};