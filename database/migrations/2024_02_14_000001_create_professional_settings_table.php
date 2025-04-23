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
        Schema::create('professional_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('professional_id')->constrained()->onDelete('cascade');
            $table->json('session_durations')->nullable();
            $table->json('session_fees')->nullable();
            $table->json('working_hours')->nullable();
            $table->json('working_days')->nullable();
            $table->integer('buffer_time')->default(15);
            $table->boolean('is_available')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('professional_settings');
    }
}; 