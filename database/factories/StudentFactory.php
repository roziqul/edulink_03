<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
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
            'nisn' => fake()->unique()->numberBetween(111111111111, 999999999999),
            'class' => fake()->randomElement(['10 MIPA 1','10 IPS 1','10 IBB 1']),
            'fullname' => fake()->name(),
            'pob' => fake()->city(),
            'dob' => fake()->date(),
            'gender' => fake()->randomElement(['L','P']),
            'address' => fake()->address(),
            'phone' => fake()->unique()->phoneNumber(),
            'role' => 'student'
        ];
    }
}
