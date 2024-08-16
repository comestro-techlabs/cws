<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'slug' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(3),
            'duration' => $this->faker->numberBetween(1, 12),
            'fees' => $this->faker->randomFloat(2, 10, 100),
            'discounted_fees' => $this->faker->randomFloat(2, 10, 100),
            'instructor' => $this->faker->word(),
            'category_id' => $this->faker->numberBetween(5, 11),
            'course_image' => "https://www.picsum.photos/300/300"
        ];
    }
}
