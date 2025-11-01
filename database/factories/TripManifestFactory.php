<?php

namespace Database\Factories;

use App\Models\Schedule;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TripManifest>
 */
class TripManifestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'schedule_id' => Schedule::factory(),
            'driver_id' => User::factory()->create()->id,
            'conductor_id' => User::factory()->create()->id,
            'manifest_number' => $this->faker->unique()->bothify('MF-########'),
            'departure_time_actual' => $this->faker->dateTimeBetween('-1 day', 'now'),
            'arrival_time_actual' => $this->faker->dateTimeBetween('now', '+1 day'),
            'total_passengers' => $this->faker->numberBetween(15, 45),
            'total_revenue' => $this->faker->randomFloat(2, 1500000, 15000000),
            'notes' => $this->faker->optional(0.4)->sentence(),
            'status' => $this->faker->randomElement(['prepared', 'active', 'completed', 'cancelled']),
        ];
    }

    public function active()
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'active',
            'departure_time_actual' => $this->faker->dateTimeBetween('-2 hours', 'now'),
        ]);
    }

    public function completed()
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'completed',
            'arrival_time_actual' => $this->faker->dateTimeBetween('-1 day', 'now'),
        ]);
    }
}
