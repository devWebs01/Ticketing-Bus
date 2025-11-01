<?php

namespace Database\Factories;

use App\Models\Schedule;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Seat>
 */
class SeatFactory extends Factory
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
            'seat_number' => $this->faker->unique()->numerify('A##'),
            'seat_type' => $this->faker->randomElement(['regular', 'vip', 'business']),
            'status' => $this->faker->randomElement(['available', 'booked', 'blocked']),
            'price' => $this->faker->randomFloat(2, 50000, 500000),
        ];
    }

    public function available()
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'available',
        ]);
    }

    public function booked()
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'booked',
        ]);
    }

    public function vip()
    {
        return $this->state(fn (array $attributes) => [
            'seat_type' => 'vip',
            'price' => $this->faker->randomFloat(2, 200000, 800000),
        ]);
    }
}
