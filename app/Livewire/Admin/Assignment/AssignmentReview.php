<?php

namespace App\Livewire\Admin\Assignment;

use Livewire\Component;
use App\Models\Assignment_upload;
use App\Models\Course;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.admin')]
#[Title('Manage Assignments')]
class AssignmentReview extends Component
{
    public $slug;

    public function mount($slug)
    {
        $this->slug = $slug;
    }
    public function render()
    {
        $course = Course::with(['assignments', 'assignments.uploads.user'])
            ->where('slug', $this->slug)
            ->firstOrFail();
            $batchName = $course->assignments->first()?->batch->batch_name ?? 'No Batch Assigned';
        $students = Assignment_upload::whereIn('assignment_id', $course->assignments->pluck('id'))
            ->with('user')
            ->get()
            ->groupBy('student_id')
            ->map(function ($uploads) {
                return [
                    'user' => $uploads->first()->user,
                    'upload_count' => $uploads->count(),
                    'grade' => $uploads->first()->grade,
                ];
            });
        return view('livewire.admin.assignment.assignment-review', [
            'course' => $course,
            'students' => $students,
            'assignments' => $course->assignments,
            'batchName' => $batchName
        ]);
    }
}
