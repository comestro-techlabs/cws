<?php

namespace Database\Seeders;

use App\Models\PostChapter;
use App\Models\PostCourse;
use Illuminate\Database\Seeder;

class PostChapterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    // public function run()
    // {
    //     // Generate 10 chapters for each PostCourse
    //     \App\Models\PostCourse::all()->each(function ($course) {
    //         PostChapter::factory()->count(10)->create([
    //             'post_course_id' => $course->id, // Assign chapters to existing courses
    //         ]);
    //     });
    // }
    public function run()
    {
        $courses = PostCourse::all();

        foreach ($courses as $course) {
            PostChapter::factory(3)->create([
                'post_course_id' => $course->id,
            ]); // Creates 3 chapters per course
        }
    }
}
