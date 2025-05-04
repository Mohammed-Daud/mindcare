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
        Schema::table('appointments', function (Blueprint $table) {
            // Add meeting_room column to store the unique meeting room identifier
            if (!Schema::hasColumn('appointments', 'meeting_room')) {
                $table->string('meeting_room', 255)->nullable()->after('notes')
                    ->comment('Unique identifier for the virtual meeting room');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            // Drop the meeting_room column if it exists
            if (Schema::hasColumn('appointments', 'meeting_room')) {
                $table->dropColumn('meeting_room');
            }
        });
    }
};
