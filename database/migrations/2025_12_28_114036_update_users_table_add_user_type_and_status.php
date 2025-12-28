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
        Schema::table('users', function (Blueprint $table) {
            // Remove is_admin field
            $table->dropColumn('is_admin');

            // Add user_type field (101: Super Admin, 201: Professional, 301: Client)
            $table->integer('user_type')->default(301)->after('email');

            // Add status field (1: Active, 0: Inactive)
            $table->tinyInteger('status')->default(1)->after('user_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Add back is_admin field
            $table->boolean('is_admin')->default(false)->after('password');

            // Remove new fields
            $table->dropColumn(['user_type', 'status']);
        });
    }
};
