<?php
namespace App\Livewire\Student\Dashboard\Takeexam;

use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\Answer;



#[Layout('components.layouts.student')]

class ShowAllAttempt extends Component
{
    public $course;         
    public $attempts_data; 

    public function mount($course_id)
    {
        $this->course = Course::with('exams')->find($course_id);

        if (!$this->course) {
            abort(404, 'Course not found');
        }

        abort_if(!Auth::check(), 403, 'You must be logged in to access this page');

        $user_id = Auth::id();
        $exam_ids = $this->course->exams->pluck('id');

        $attempts = Answer::where('user_id', $user_id)
            ->whereIn('exam_id', $exam_ids)
            ->orderBy('attempt')
            ->get()
            ->groupBy('attempt');

        $this->attempts_data = $attempts->map(function ($answers, $attempt) {
            return [
                'attempt' => $attempt,
                'total_marks' => $answers->sum('obtained_marks'),
            ];
        })->values();
    }

    public function render()
    {
        return view('livewire.student.dashboard.takeexam.show-all-attempt');
    }
}