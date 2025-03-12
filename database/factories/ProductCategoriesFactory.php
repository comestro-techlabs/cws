<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductCategories>
 */
class ProductCategoriesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->word(), // Generates unique category name
            'description' => fake()->sentence(),
            'isActive' => fake()->boolean(),
            'imageUrl' => fake()->imageUrl(200, 200, 'category'), // Generates a random image URL
            'availableQuantity' => fake()->numberBetween(10, 100),
        ];
    }
}
