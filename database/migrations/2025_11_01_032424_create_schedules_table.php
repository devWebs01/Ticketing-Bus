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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->string('departure_city');
            $table->string('arrival_city');
            $table->time('departure_time');
            $table->time('arrival_time');
            $table->date('date');
            $table->decimal('price', 10, 2);
            $table->integer('total_seats');
            $table->enum('status', ['active', 'cancelled', 'completed'])->default('active');
            $table->string('vehicle_number')->nullable();
            $table->string('vehicle_type')->default('bus');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
