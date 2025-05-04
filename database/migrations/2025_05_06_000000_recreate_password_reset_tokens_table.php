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
        // Backup existing tokens if any
        $tokens = [];
        if (Schema::hasTable('password_reset_tokens')) {
            $tokens = DB::table('password_reset_tokens')->get()->toArray();
            
            // Drop the existing table
            Schema::dropIfExists('password_reset_tokens');
        }
        
        // Create the table with the correct structure
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->string('user_type')->default('user');
            $table->timestamp('created_at')->nullable();
        });
        
        // Restore the tokens
        foreach ($tokens as $token) {
            $data = [
                'email' => $token->email,
                'token' => $token->token,
                'created_at' => $token->created_at
            ];
            
            // Add user_type if it exists in the original data
            if (isset($token->user_type)) {
                $data['user_type'] = $token->user_type;
            } else {
                $data['user_type'] = 'user'; // Set default user_type
            }
            
            DB::table('password_reset_tokens')->insert($data);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No need to do anything here as we can't restore the original state
    }
};