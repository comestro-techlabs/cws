<?php

namespace Database\Seeders;

use App\Models\PostChapter;
use App\Models\PostTopicPost;
use Illuminate\Database\Seeder;

class PostTopicPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    // public function run()
    // {
    //     PostTopicPost::factory(50)->create();
    // }

    public function run()
    {
        $chapters = PostChapter::all();

        foreach ($chapters as $chapter) {
            PostTopicPost::factory(10)->create([
                'post_chapter_id' => $chapter->id,
            ]); // Creates 4 topics per chapter
        }
    }
}
