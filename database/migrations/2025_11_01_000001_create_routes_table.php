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
        Schema::create('routes', function (Blueprint $table) {
            $table->id();
            $table->string('origin'); // Kota asal
            $table->string('destination'); // Kota tujuan
            $table->integer('estimated_duration_hours'); // Estimasi durasi perjalanan (jam)
            $table->text('description')->nullable(); // Deskripsi rute
            $table->boolean('is_active')->default(true); // Status aktif
            $table->timestamps();

            // Indexes
            $table->index(['origin', 'destination']);
            $table->index(['is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('routes');
    }
};
