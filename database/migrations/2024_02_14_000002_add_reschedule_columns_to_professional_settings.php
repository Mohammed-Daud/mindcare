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
        Schema::table('professional_settings', function (Blueprint $table) {
            if (!Schema::hasColumn('professional_settings', 'allow_client_reschedule')) {
                $table->boolean('allow_client_reschedule')->default(false);
            }
            if (!Schema::hasColumn('professional_settings', 'max_reschedule_count')) {
                $table->integer('max_reschedule_count')->default(0);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('professional_settings', function (Blueprint $table) {
            $table->dropColumn('allow_client_reschedule');
            $table->dropColumn('max_reschedule_count');
        });
    }
}; 