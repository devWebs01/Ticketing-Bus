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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('vehicle_number')->unique(); // Nomor polisi
            $table->string('vehicle_type'); // Jenis (bus, minibus, van, dll)
            $table->integer('total_seats'); // Jumlah kursi
            $table->enum('status', ['active', 'inactive', 'maintenance'])->default('active');
            $table->text('notes')->nullable(); // opsional (misal kapasitas, fasilitas, dll)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
