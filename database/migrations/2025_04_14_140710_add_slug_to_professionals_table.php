<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Professional;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Generate slugs for existing records that have null or empty slugs
        Professional::where(function($query) {
            $query->whereNull('slug')
                  ->orWhere('slug', '');
        })->each(function ($professional) {
            $baseSlug = Str::slug($professional->first_name . '-' . $professional->last_name);
            $slug = $baseSlug;
            $counter = 1;
            
            // Make sure the slug is unique
            while (Professional::where('slug', $slug)->where('id', '!=', $professional->id)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }
            
            $professional->slug = $slug;
            $professional->save();
        });

        // Add unique constraint
        Schema::table('professionals', function (Blueprint $table) {
            $table->unique('slug');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('professionals', function (Blueprint $table) {
            $table->dropUnique(['slug']);
        });
    }

    private function hasUniqueConstraint($table, $column)
    {
        $sm = Schema::getConnection()->getDoctrineSchemaManager();
        $indexes = $sm->listTableIndexes($table);
        $indexName = $table . '_' . $column . '_unique';
        return isset($indexes[$indexName]);
    }
};
