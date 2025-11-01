<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserDetail>
 */
class UserDetailFactory extends Factory
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
            'role' => $this->faker->randomElement(['customer', 'admin', 'checker']),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'profile_image' => $this->faker->optional(0.7)->imageUrl(200, 200, 'people'),
            'date_of_birth' => $this->faker->dateTimeBetween('-65 years', '-17 years'),
            'gender' => $this->faker->randomElement(['L', 'P']), // Laki-laki/Perempuan
            'identity_number' => $this->faker->numerify('################'), // 16 digit KTP
            'emergency_contact_name' => $this->faker->name(),
            'emergency_contact_phone' => $this->faker->phoneNumber(),
        ];
    }

    public function customer(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'customer',
        ]);
    }

    public function admin(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'admin',
        ]);
    }

    public function checker(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'checker',
        ]);
    }
}
