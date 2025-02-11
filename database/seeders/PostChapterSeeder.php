<?php

namespace Database\Seeders;

use App\Models\PostChapter;
use Illuminate\Database\Seeder;

class PostChapterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Generate 10 chapters for each PostCourse
        \App\Models\PostCourse::all()->each(function ($course) {
            PostChapter::factory()->count(10)->create([
                'post_course_id' => $course->id, // Assign chapters to existing courses
            ]);
        });
    }
}
