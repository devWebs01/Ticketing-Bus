<?php

namespace Database\Factories;

use App\Models\Schedule;
use App\Models\Seat;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'schedule_id' => Schedule::factory()->future(),
            'seat_id' => Seat::factory()->available(),
            'booking_date' => $this->faker->dateTimeBetween('-1 week', 'now'),
            'status' => $this->faker->randomElement(['pending', 'confirmed', 'cancelled', 'checked']),
            'total_price' => $this->faker->randomFloat(2, 100000, 1000000),
            'booking_reference' => $this->faker->unique()->bothify('BK-########'),
            'notes' => $this->faker->optional(0.3)->sentence(),
        ];
    }

    public function confirmed()
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'confirmed',
        ]);
    }

    public function pending()
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'pending',
        ]);
    }
}
