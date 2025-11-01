<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Route>
 */
class RouteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $cities = ['Jakarta', 'Bandung', 'Surabaya', 'Yogyakarta', 'Semarang', 'Malang', 'Solo', 'Denpasar', 'Medan', 'Palembang'];

        $origin = $this->faker->randomElement($cities);
        $destination = $this->faker->randomElement(array_diff($cities, [$origin]));

        return [
            'origin' => $origin,
            'destination' => $destination,
            'estimated_duration_hours' => $this->faker->numberBetween(2, 12),
            'description' => $this->faker->optional(0.7)->sentence(),
            'is_active' => $this->faker->boolean(90), // 90% chance active
        ];
    }

    public function active()
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => true,
        ]);
    }

    public function inactive()
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }
}
