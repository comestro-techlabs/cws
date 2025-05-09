<?php
namespace App\Livewire\Student\Dashboard\Takeexam;

use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\ExamUser;
use App\Models\Answer;
use App\Models\Quiz;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
#[Title('Result')]
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
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('auth.login');
        }

        $this->hasAccess = $user->hasAccess();
        if (!$this->hasAccess) {
            session()->flash('showAccessModal', true);
            return redirect()->route('student.takeExam');
        }

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
            ->with(['quiz' => function($query) {
                $query->select('id', 'question', 'marks', 'option1', 'option2', 'option3', 'option4', 'correct_answer');
            }])
            ->select('id', 'quiz_id', 'selected_option', 'obtained_marks', 'exam_id', 'user_id')
            ->get();
        // dd($this->answers);
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