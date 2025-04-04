<?php

namespace Database\Factories;

use App\Models\PostTopicPost;
use App\Models\PostChapter;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostTopicPostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PostTopicPost::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->unique()->sentence;

        return [
            'post_chapter_id' => PostChapter::factory(),
            'topic_name' => $title,
            'topic_description' => $this->faker->paragraph,
            'order' => $this->faker->numberBetween(1, 10),
            'topic_slug' => Str::slug($title) . '-' . Str::random(5), // Ensure unique slug
        ];
    }
}
