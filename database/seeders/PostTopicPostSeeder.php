<?php

namespace Database\Seeders;

use App\Models\PostTopicPost;
use Illuminate\Database\Seeder;

class PostTopicPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        PostTopicPost::factory(50)->create();
    }
}
