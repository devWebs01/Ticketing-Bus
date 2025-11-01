<?php

namespace Database\Factories;

use App\Models\Route;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Schedule>
 */
class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'route_id' => Route::factory(),
            'departure_time' => $this->faker->time('H:i'),
            'date' => $this->faker->dateTimeBetween('now', '+30 days'),
            'price' => $this->faker->randomFloat(2, 100000, 1000000),
            'total_seats' => $this->faker->numberBetween(20, 50),
            'status' => $this->faker->randomElement(['active', 'cancelled', 'completed']),
            'vehicle_number' => $this->faker->bothify('?? #### ??'),
            'vehicle_type' => $this->faker->randomElement(['bus', 'minibus', 'van']),
        ];
    }

    public function active()
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'active',
            'date' => $this->faker->dateTimeBetween('now', '+7 days'),
        ]);
    }

    public function future()
    {
        return $this->state(fn (array $attributes) => [
            'date' => $this->faker->dateTimeBetween('+1 day', '+30 days'),
            'status' => 'active',
        ]);
    }

    public function forRoute(Route $route)
    {
        return $this->state(fn (array $attributes) => [
            'route_id' => $route->id,
        ]);
    }
}
