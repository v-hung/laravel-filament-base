<?php

namespace Database\Factories;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MenuItem>
 */
class MenuItemFactory extends Factory
{
    public function definition(): array
    {
        $title = fake()->words(2, true);

        return [
            'menu_id' => Menu::factory(),
            'parent_id' => null,
            'title' => ['en' => $title, 'vi' => $title],
            'type' => 'custom',
            'linkable_type' => null,
            'linkable_id' => null,
            'url' => fake()->optional()->url(),
            'target' => '_self',
            'icon' => null,
            'sort_order' => fake()->numberBetween(0, 100),
            'is_active' => true,
        ];
    }
}
