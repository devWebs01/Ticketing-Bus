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
        Schema::create('trip_manifests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('schedule_id')->constrained()->onDelete('cascade');
            $table->foreignId('driver_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('conductor_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('manifest_number')->unique();
            $table->datetime('departure_time_actual')->nullable();
            $table->datetime('arrival_time_actual')->nullable();
            $table->integer('total_passengers')->default(0);
            $table->decimal('total_revenue', 12, 2)->default(0);
            $table->text('notes')->nullable();
            $table->enum('status', ['prepared', 'active', 'completed', 'cancelled'])->default('prepared');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trip_manifests');
    }
};
