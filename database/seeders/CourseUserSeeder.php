<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Course;
use App\Models\Batch;
use Illuminate\Database\Seeder;

class CourseUserSeeder extends Seeder
{
    public function run(): void
    {
        $students = User::where('isAdmin', false)->get();
        $courses = Course::all();
        
        foreach ($students as $student) {
            // Enroll each student in 1-3 random courses
            $randomCourses = $courses->random(rand(1, 3));
            
            foreach ($randomCourses as $course) {
                // Get a random batch for this course
                $batch = Batch::where('course_id', $course->id)
                    ->inRandomOrder()
                    ->first();

                if ($batch) {
                    $student->courses()->attach($course->id, [
                        'batch_id' => $batch->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }
}
