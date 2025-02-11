<?php

namespace Database\Factories;

use App\Models\PostCourse;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PostCourse>
 */
class PostCourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = PostCourse::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence, 
            'description' => $this->faker->paragraph, 
            'image' => $this->faker->imageUrl(), 
            'status' => $this->faker->boolean(80),
            'course_slug' => $this->faker->slug, 
        ];
    }
}
