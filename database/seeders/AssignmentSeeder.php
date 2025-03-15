<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Assignments;
use App\Models\Course;
use App\Models\Batch;
use App\Models\Assignment_upload;
use App\Models\User;
use Carbon\Carbon;

class AssignmentSeeder extends Seeder
{
    public function run(): void
    {
        $courses = Course::all();
        $batches = Batch::all();
        $students = User::where('isAdmin', false)->get();

        if ($courses->isEmpty() || $batches->isEmpty() || $students->isEmpty()) {
            $this->command->info('Please seed courses, batches and users first.');
            return;
        }

        $assignments = [
            [
                'title' => 'Introduction to HTML5',
                'description' => 'Create a responsive landing page using HTML5 and CSS3',
                'due_date' => Carbon::now()->addDays(7),
            ],
            [
                'title' => 'JavaScript Basics',
                'description' => 'Build a simple calculator using vanilla JavaScript',
                'due_date' => Carbon::now()->addDays(14),
            ],
            [
                'title' => 'PHP Fundamentals',
                'description' => 'Create a basic CRUD application using PHP and MySQL',
                'due_date' => Carbon::now()->addDays(21),
            ],
            [
                'title' => 'Laravel Project',
                'description' => 'Develop a blog system using Laravel framework',
                'due_date' => Carbon::now()->addDays(30),
            ]
        ];

        foreach ($assignments as $assignment) {
            $course = $courses->random();
            $batch = $batches->where('course_id', $course->id)->first() ?? $batches->random();

            $newAssignment = Assignments::create([
                'title' => $assignment['title'],
                'description' => $assignment['description'],
                'due_date' => $assignment['due_date'],
                'course_id' => $course->id,
                'batch_id' => $batch->id,
                'status' => true,
            ]);

            // Get students for this course
            $courseStudents = User::whereHas('courses', function($query) use ($course) {
                $query->where('course_id', $course->id);
            })->get();

            if ($courseStudents->isNotEmpty()) {
                // Calculate how many students to assign (minimum between 3 and total students)
                $numStudents = min(3, $courseStudents->count());
                $selectedStudents = $courseStudents->random($numStudents);

                foreach ($selectedStudents as $student) {
                    $isLate = (bool)rand(0, 1);
                    $submittedAt = $isLate 
                        ? $assignment['due_date']->copy()->addDays(rand(1, 5))
                        : $assignment['due_date']->copy()->subDays(rand(1, 3));

                    Assignment_upload::create([
                        'student_id' => $student->id,
                        'assignment_id' => $newAssignment->id,
                        'file_path' => 'sample_file_' . rand(1000, 9999),
                        'submitted_at' => $submittedAt,
                        'grade' => rand(60, 100),
                        'status' => 'graded',
                    ]);
                }
            }
        }
    }
}
