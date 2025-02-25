<?php

namespace App\Livewire\Admin\Assignment;

use App\Models\Assignment_upload;
use App\Models\Course;
use Livewire\Attributes\Layout;
use Livewire\Component;

class AssignmentCourse extends Component
{
    public $assignments = [];
    public $courses = []; 

    #[Layout('components.layouts.admin')]
    public function mount()
    {
        $this->courses = Course::with(['assignments', 'users'])
            ->has('assignments')
            ->get()
            ->map(function ($course) {
                $course->unique_user_count = Assignment_upload::whereIn('assignment_id', 
                    $course->assignments->pluck('id'))
                    ->distinct('student_id')
                    ->count('student_id');
                $course->total_users = $course->users->count();
                return $course;
            });
    }

    public function render()
    {
        return view('livewire.admin.assignment.assignment-course', [
            'assignments' => $this->assignments,
            'courses' => $this->courses,
        ]);
    }
}