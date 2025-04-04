<?php

namespace Database\Factories;

use App\Models\PostChapter;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostChapterFactory extends Factory
{
    protected $model = PostChapter::class;

    public function definition()
    {
        $title = $this->faker->unique()->sentence;

        return [
            'post_course_id' => \App\Models\PostCourse::factory(),
            'chapter_name' => $title,
            'chapter_description' => $this->faker->paragraph,
            'chapter_slug' => Str::slug($title) . '-' . Str::random(5), // Ensure unique slug
            'order' => $this->faker->numberBetween(1, 10),
        ];
    }
}
