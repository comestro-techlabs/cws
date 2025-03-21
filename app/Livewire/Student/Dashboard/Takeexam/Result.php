<?php
namespace App\Livewire\Student\Dashboard\Takeexam;

use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Answer;
use App\Models\ExamUser;
use App\Models\Quiz;

#[Layout('components.layouts.student')]
class Result extends Component
{
    public $results;
    public $totalMarks;
    public $attempt; 
    public $examName;
    public $percentage;
    public $correctAnswers = 0;
    public $incorrectAnswers = 0;
    public $unattempted = 0;

    public function mount($exam_id = null)
    {
        $this->dispatch('loading');
        
        if ($exam_id) {
            $this->showResults($exam_id);
        }
    }

    // Show results for a specific exam
    public function showResults($exam_id)
    {
        $this->dispatch('loading');
        if (!Auth::check()) {
            return redirect()->route('auth.login')->with('error', 'You must be logged in to access this page.');
        }
        
        $user = Auth::user();

        $this->results = Answer::with('quiz')
            ->where('user_id', $user->id)
            ->where('exam_id', $exam_id)
            ->get();

        $exam_user = ExamUser::with('exam')->where('user_id', $user->id)
            ->where('exam_id', $exam_id)
            ->first();

        if (!$exam_user) {
            return redirect()->route('student.takeExam')->with('error', 'No attempt found for this exam.');
        }

        $this->examName = $exam_user->exam->exam_name;
        $this->totalMarks = $exam_user->total_marks;
        $this->attempt = $exam_user->attempts;

        // Calculate statistics
        $totalQuestions = $this->results->count();
        $this->correctAnswers = $this->results->where('obtained_marks', '>', 0)->count();
        $this->incorrectAnswers = $totalQuestions - $this->correctAnswers;
        $maxPossibleMarks = $this->results->sum(function($answer) {
            return $answer->quiz->marks;
        });
        
        $this->percentage = $maxPossibleMarks > 0 
            ? round(($this->totalMarks / $maxPossibleMarks) * 100, 2)
            : 0;
    }

    public function courseResult()
    {
        $this->dispatch('loading');
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