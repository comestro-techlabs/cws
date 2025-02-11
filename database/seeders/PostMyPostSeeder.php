<?php

namespace Database\Seeders;

use App\Models\PostMyPost;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostMyPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        PostMyPost::factory()->count(100)->create();

    }
}
