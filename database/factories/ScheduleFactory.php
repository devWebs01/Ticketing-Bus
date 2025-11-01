<?php

namespace Database\Factories;

use App\Models\Route;
use App\Models\Vehicle;
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
            'vehicle_id' => Vehicle::factory(),
            'departure_time' => $this->faker->time('H:i:s'),
            'price' => $this->faker->randomFloat(2, 100000, 1000000),
            'status' => $this->faker->randomElement(['active', 'cancelled', 'completed']),
        ];
    }

    public function active()
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'active',
        ]);
    }

    public function forRoute(Route $route)
    {
        return $this->state(fn (array $attributes) => [
            'route_id' => $route->id,
        ]);
    }

    public function withDays(?array $days = null)
    {
        $days = $days ?? $this->faker->randomElements([
            'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday',
        ], $this->faker->numberBetween(1, 7));

        return $this->afterCreating(function (\App\Models\Schedule $schedule) use ($days) {
            foreach ($days as $day) {
                $schedule->days()->create(['day_of_week' => $day]);
            }
        });
    }
}
