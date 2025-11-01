<?php

namespace Database\Factories;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'booking_id' => Booking::factory(),
            'payment_method' => $this->faker->randomElement(['cash', 'transfer', 'credit_card', 'e_wallet']),
            'amount' => $this->faker->randomFloat(2, 100000, 1000000),
            'status' => $this->faker->randomElement(['pending', 'success', 'failed', 'refunded']),
            'payment_date' => $this->faker->dateTimeBetween('-1 week', 'now'),
            'transaction_id' => $this->faker->unique()->bothify('TXN############'),
            'payment_gateway_response' => $this->faker->optional(0.7)->randomElement([
                ['status' => 'success', 'message' => 'Payment successful'],
                ['status' => 'failed', 'message' => 'Insufficient funds'],
                ['status' => 'pending', 'message' => 'Processing payment'],
            ]),
        ];
    }

    public function successful()
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'success',
            'payment_date' => $this->faker->dateTimeBetween('-1 week', 'now'),
        ]);
    }

    public function pending()
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'pending',
        ]);
    }
}
