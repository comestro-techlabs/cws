<?php
namespace App\Livewire\Student\Dashboard\Takeexam;

use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\ExamUser;
use App\Models\Answer;
use App\Models\Quiz;
use Illuminate\Support\Facades\Auth;

#[Layout('components.layouts.student')]
class Result extends Component
{
    public $examId;
    public $examUser;
    public $answers;
    public $stats = [];
    public $quizzes;

    public function mount($examId)
    {
        $this->examId = $examId;
        $this->loadResults();
    }

    private function loadResults()
    {
        $this->examUser = ExamUser::where('user_id', Auth::id())
            ->where('exam_id', $this->examId)
            ->firstOrFail();

        $this->answers = Answer::where('user_id', Auth::id())
            ->where('exam_id', $this->examId)
            ->with('quiz') // Load quiz relationship
            ->get();

        $this->quizzes = Quiz::where('exam_id', $this->examId)->get();

        $this->calculateStats();
    }

    private function calculateStats()
    {
        $totalQuestions = $this->answers->count();
        $correctAnswers = $this->answers->where('obtained_marks', '>', 0)->count();
        $incorrectAnswers = $totalQuestions - $correctAnswers;
        $totalPossibleMarks = $this->answers->count();
        $obtainedMarks = $this->examUser->total_marks; 

        $this->stats = [
            'percentage' => $totalPossibleMarks > 0 ? round(($obtainedMarks / $totalPossibleMarks) * 100, 2) : 0,
            'marks' => "$obtainedMarks/$totalPossibleMarks",
            'correct' => $correctAnswers,
            'incorrect' => $incorrectAnswers,
        ];
    }

    public function render()
    {
        return view('livewire.student.dashboard.takeexam.result', [
            'stats' => $this->stats,
            'answers' => $this->answers,
            'examUser' => $this->examUser,
            'quizzes' => $this->quizzes,
        ]);
    }
}