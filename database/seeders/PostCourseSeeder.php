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
        PostCourse::factory(15)->create(); // Creates 10 courses
    }
}
