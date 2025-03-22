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
    public $examUser;
    public $answers;
    public $totalQuestions;
    public $correctAnswers;
    public $incorrectAnswers;
    public $percentage;
    public $examId;

    public function mount()
    {
        // Update to use examId parameter name
        if (!request()->route('examId')) {
            return redirect()->route('student.dashboard');
        }

        $this->examId = request()->route('examId');
        
        $this->examUser = ExamUser::where('exam_id', $this->examId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // Update the answers query to eager load quiz with all options
        $this->answers = Answer::with(['quiz' => function($query) {
            $query->select('id', 'question', 'option1', 'option2', 'option3', 'option4', 'correct_option');
        }])
        ->where('exam_id', $this->examId)
        ->where('user_id', Auth::id())
        ->get();

        // Add debugging to check if answers are loaded
        if ($this->answers->isEmpty()) {
            session()->flash('error', 'No answers found for this exam.');
        }

        $this->totalQuestions = $this->answers->count();
        $this->correctAnswers = $this->answers->where('obtained_marks', '>', 0)->count();
        $this->incorrectAnswers = $this->totalQuestions - $this->correctAnswers;
        $this->percentage = $this->totalQuestions > 0 
            ? ($this->examUser->total_marks / ($this->totalQuestions * 5)) * 100 
            : 0;
    }

    public function render()
    {
        return view('livewire.student.dashboard.takeexam.result', [
            'hasAnswers' => $this->answers->isNotEmpty()
        ]);
    }
}