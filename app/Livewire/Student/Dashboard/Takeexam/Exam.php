<?php
namespace App\Livewire\Student\Dashboard\Takeexam;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\ExamUser; // Assuming this model exists

class Exam extends Component
{
    public $courses;
    public $attempts = []; 

    public function mount()
    {
        if (!Auth::check()) {
            return redirect()->route('auth.login')->with('error', 'You must be logged in to access this page');
        }

        $user = Auth::user();

        // Get the batch IDs for the courses the user is enrolled in
        $batchIds = DB::table('course_student')
            ->where('user_id', $user->id)
            ->pluck('batch_id', 'course_id');

        $this->courses = $user->courses()
            ->with([
                'users',
                'exams' => function ($query) use ($batchIds) {
                    $query->whereIn('batch_id', $batchIds); // Only show exams for the user's batch
                }
            ])
            ->get();

        // Fetch attempts for each exam
        $this->attempts = ExamUser::where('user_id', $user->id)
            ->whereIn('exam_id', $this->courses->flatMap->exams->pluck('id'))
            ->pluck('attempts', 'exam_id')
            ->toArray(); // Map attempts by exam_id
    }

    #[Layout('components.layouts.student')]
    public function render()
    {
        return view('livewire.student.dashboard.takeexam.exam', [
            'courses' => $this->courses,
            'attempts' => $this->attempts,
        ]);
    }
}