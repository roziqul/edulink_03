<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Administrator>
 */
class AdministratorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'photo' => 'https://picsum.photos/2000/3000?' . fake()->randomNumber(),
            'email' => fake()->unique()->safeEmail(),
            'nip' => fake()->unique()->numberBetween(111111111111, 999999999999),
            'fullname' => fake()->name(),
            'pob' => fake()->city(),
            'dob' => fake()->date(),
            'gender' => fake()->randomElement(['L','P']),
            'address' => fake()->address(),
            'phone' => fake()->unique()->phoneNumber(),
        ];
    }
}
