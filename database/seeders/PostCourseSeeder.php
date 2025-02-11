<?php

namespace Database\Seeders;

use App\Models\PostCourse;
use Illuminate\Database\Seeder;

class PostCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        PostCourse::factory()->count(20)->create();
    }
}
