<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->words(3, true),
            'slug' => fake()->unique()->slug(),
            'description' => fake()->sentence(),
            'content' => fake()->paragraphs(2, true),
            'price' => fake()->randomFloat(2, 10000, 5000000),
            'compare_at_price' => fake()->optional(0.3)->randomFloat(2, 10000, 5000000),
            'stock_quantity' => fake()->numberBetween(0, 500),
            'status' => 'active',
            'is_featured' => fake()->boolean(20),
        ];
    }
}
