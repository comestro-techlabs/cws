<?php

namespace App\Livewire\Admin\Assignment;

use App\Models\Assignment_upload;
use App\Models\Course;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.admin')]
#[Title('Manage Assignments')]
class AssignmentCourse extends Component
{
    public function render()
    {
        $courses = Course::with('assignments', 'users')
            ->has('assignments')
            ->get();

        foreach ($courses as $course) {
            $course->unique_user_count = Assignment_upload::whereIn('assignment_id', $course->assignments->pluck('id'))
                ->distinct('student_id')
                ->count('student_id');
            $course->total_users = $course->users->count();
        }
        return view('livewire.admin.assignment.assignment-course', ['courses' => $courses]);
    }
}