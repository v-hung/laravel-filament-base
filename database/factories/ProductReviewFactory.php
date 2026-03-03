<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductReview>
 */
class ProductReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => Product::factory(),
            'user_id' => User::factory(),
            'reviewer_name' => fake()->name(),
            'reviewer_email' => fake()->safeEmail(),
            'rating' => fake()->numberBetween(1, 5),
            'comment' => fake()->paragraph(),
            'is_approved' => fake()->boolean(70),
        ];
    }

    public function approved(): static
    {
        return $this->state(fn (array $attributes): array => [
            'is_approved' => true,
        ]);
    }

    public function pending(): static
    {
        return $this->state(fn (array $attributes): array => [
            'is_approved' => false,
        ]);
    }
}
