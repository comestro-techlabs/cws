<?php
namespace App\Livewire\Student\Dashboard\Takeexam;

use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Answer;
use App\Models\ExamUser;

#[Layout('components.layouts.student')]
class Result extends Component
{
    public $results;
    public $totalMarks;
    public $attempt; 

    public function mount($exam_id = null)
    {
        if ($exam_id) {
            $this->showResults($exam_id);
        }
    }

    // Show results for a specific exam
    public function showResults($exam_id)
    {
        if (!Auth::check()) {
            return redirect()->route('auth.login')->with('error', 'You must be logged in to access this page.');
        }
        
        $user = Auth::user();

        $this->results = Answer::where('user_id', $user->id)
            ->where('exam_id', $exam_id)
            ->get();

        $exam_user = ExamUser::where('user_id', $user->id)
            ->where('exam_id', $exam_id)
            ->first();

        if (!$exam_user) {
            return redirect()->route('student.takeExam')->with('error', 'No attempt found for this exam.');
        }

        
        $this->totalMarks = $exam_user->total_marks;
        $this->attempt = $exam_user->attempts; 
    }

    public function courseResult()
    {
        if (!Auth::check()) {
            return redirect()->route('auth.login')->with('error', 'You must be logged in to access this page.');
        }

        $user = Auth::user();
        $courses = $user->courses()
            ->with([
                'users',
                'exams' => function ($query) use ($user) {
                    $query->withCount(['examUsers' => function ($query) use ($user) {
                        $query->where('user_id', $user->id); 
                    }]);
                }
            ])
            ->get();

        return view('student.take-exam', compact('courses'));
    }

    public function render()
    {
        return view('livewire.student.dashboard.takeexam.result', [
            'results' => $this->results,
            'totalMarks' => $this->totalMarks,
            'attempt' => $this->attempt,
            'totalQuestions' => $this->results->count(),
        ]);
    }
}