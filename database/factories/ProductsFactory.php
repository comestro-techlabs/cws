<?php

namespace Database\Factories;

use App\Models\ProductCategories;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Products>
 */
class ProductsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_category_id' => ProductCategories::inRandomOrder()->first()->id ?? ProductCategories::factory(),
            'name' => fake()->unique()->word() . ' Product',
            'description' => fake()->sentence(),
            'points' => fake()->numberBetween(50, 500),
            'imageUrl' => fake()->imageUrl(200, 200, 'product'),
            'availableQuantity' => fake()->numberBetween(5, 50),
        ];
    }
}
