<?php

namespace Database\Factories;

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
        $departureTime = $this->faker->time('H:i');
        $arrivalTime = $this->faker->time('H:i', $departureTime);

        return [
            'departure_city' => $this->faker->randomElement(['Jakarta', 'Bandung', 'Surabaya', 'Yogyakarta', 'Semarang', 'Malang', 'Solo', 'Denpasar']),
            'arrival_city' => $this->faker->randomElement(['Jakarta', 'Bandung', 'Surabaya', 'Yogyakarta', 'Semarang', 'Malang', 'Solo', 'Denpasar']),
            'departure_time' => $departureTime,
            'arrival_time' => $arrivalTime,
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
}
