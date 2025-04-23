<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use App\Models\Professional;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('professionals', function (Blueprint $table) {
            $table->string('slug')->unique()->nullable()->after('last_name');
        });

        // Generate slugs for existing professionals
        Professional::all()->each(function ($professional) {
            $professional->slug = Str::slug($professional->first_name . ' ' . $professional->last_name);
            $professional->save();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('professionals', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
