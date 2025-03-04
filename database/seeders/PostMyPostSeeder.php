<?php

namespace Database\Seeders;

use App\Models\PostMyPost;
use App\Models\PostTopicPost;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostMyPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    // public function run()
    // {
    //     PostMyPost::factory()->count(100)->create();

    // }
    public function run()
    {
        $topics = PostTopicPost::all();

        foreach ($topics as $topic) {
            PostMyPost::factory(5)->create([
                'post_topic_post_id' => $topic->id,
            ]); // Creates 5 posts per topic
        }
    }
}
