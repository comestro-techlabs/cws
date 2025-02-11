<?php

namespace Database\Factories;

use App\Models\PostTopicPost;
use App\Models\PostChapter;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        return [
            'post_chapter_id' => $this->faker->numberBetween(1, 20),
            'topic_name' => $this->faker->sentence,
            'topic_description' => $this->faker->paragraph,
            'order' => $this->faker->numberBetween(1, 10),
            'topic_slug' => $this->faker->slug,
        ];
    }
}
