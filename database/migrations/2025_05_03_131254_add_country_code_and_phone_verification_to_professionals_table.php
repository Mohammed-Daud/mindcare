<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('professionals', function (Blueprint $table) {
            $table->string('country_code')->default('+91')->after('email'); // Default to India country code
            $table->boolean('is_phone_verified')->default(false)->after('phone');
            
            // Drop the unique constraint on phone column
            $table->dropUnique(['phone']);
            
            // Add a unique constraint on the combination of country_code and phone
            $table->unique(['country_code', 'phone']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('professionals', function (Blueprint $table) {
            // Drop the unique constraint on the combination
            $table->dropUnique(['country_code', 'phone']);
            
            // Add back the unique constraint on phone column
            $table->unique(['phone']);
            
            // Drop the columns
            $table->dropColumn('country_code');
            $table->dropColumn('is_phone_verified');
        });
    }
};
