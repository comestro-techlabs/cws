<?php

namespace Database\Factories;

use App\Models\PostMyPost;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PostMyPost>
 */
class PostMyPostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = PostMyPost::class;

    public function definition(): array
    {
        return [
            'post_topic_post_id'=> $this->faker->numberBetween(101, 150),
            'title'=> $this->faker->sentence,
            'content'=>$this->faker->paragraph, 
            'image_path'=>$this->faker->imageUrl()
        ];
    }
}
