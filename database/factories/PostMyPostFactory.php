<?php

namespace Database\Factories;

use App\Models\PostMyPost;
use App\Models\PostTopicPost;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PostMyPost>
 */
class PostMyPostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PostMyPost::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'post_topic_post_id' => PostTopicPost::factory(),
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'image_path' => $this->faker->imageUrl(),
        ];
    }
}
