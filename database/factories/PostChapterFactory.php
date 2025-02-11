<?php

namespace Database\Factories;

use App\Models\PostCourse;
use App\Models\PostChapter;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostChapterFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PostChapter::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'post_course_id' => PostCourse::factory(),  // Creating a related PostCourse model
            'chapter_name' => $this->faker->word,
            'chapter_description' => $this->faker->paragraph,
            'chapter_slug' => $this->faker->slug,
            'order' => $this->faker->randomDigitNotNull(),
        ];
    }
}
