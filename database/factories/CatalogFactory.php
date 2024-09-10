<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Catalog>
 */
class CatalogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $now = Carbon::now()->year;

        return [
            'code' => fake()->numberBetween(100, 999),
            'cover' => 'https://picsum.photos/2000/3000?' . fake()->randomNumber(),
            'section_id' => fake()->numberBetween(1, 16),
            'category_id' => fake()->numberBetween(1, 8),
            'title' => fake()->words(5,true),
            'writer' => fake()->name(),
            'publisher' => fake()->name(),
            'release_year' => fake()->numberBetween(1000, $now),
            'price' => fake()->numberBetween(50000, 999999),
        ];
    }
}

