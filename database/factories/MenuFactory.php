<?php

namespace Database\Factories;

use App\Enums\CategoryStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Menu>
 */
class MenuFactory extends Factory
{
    public function definition(): array
    {
        $name = fake()->words(2, true);

        return [
            'name' => ['en' => $name, 'vi' => $name],
            'slug' => Str::slug($name).'-'.fake()->unique()->numberBetween(1, 9999),
            'sort_order' => fake()->numberBetween(0, 100),
            'status' => CategoryStatus::Active,
        ];
    }
}
