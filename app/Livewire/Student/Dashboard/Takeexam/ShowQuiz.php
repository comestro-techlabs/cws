<?php
namespace App\Livewire\Student\Dashboard\Takeexam;

use App\Models\Answer;
use App\Models\ExamUser;
use App\Models\Quiz;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\Course;

#[Layout('components.layouts.exam')]
class ShowQuiz extends Component
{
    public $courses = null;
    public $quizzes = null;
    public $courseId = null;
    public $examId = null;
    public $submitted = false;
    public $passcode = '';
    public $passcodeVerified = false;
    public $passcodeError = null;
    public $currentQuestion = 0;
    public $answers = []; // Array to store answers, keyed by quiz ID
    public $currentAnswer = null; // Temporary storage for the current question's answer
    public $isFullscreen = false;
    public $timeRemaining = '45:00';
    protected $timer;

    protected $listeners = [
        'startTimer' => 'startTimer',
        'fullscreenChanged' => 'handleFullscreenChange'
    ];

    public function mount($courseId)
    {
        try {
            $this->courseId = $courseId;
            $user = Auth::user();
            
            if (!$user) {
                throw new \Exception('User not authenticated');
            }

            $examAttempt = ExamUser::where('user_id', $user->id)
                ->whereHas('exam', function ($query) use ($courseId) {
                    $query->where('course_id', $courseId);
                })
                ->first();

            if ($examAttempt && $examAttempt->attempts >= 1) {
                return redirect()->route('student.takeExam')
                    ->with('error', 'You have already taken this exam. Multiple attempts are not allowed.');
            }
        } catch (\Exception $e) {
            return redirect()->route('auth.login')
                ->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function verifyPasscode()
    {
        $this->validate([
            'passcode' => 'required|string',
        ]);

        $this->dispatch('loading');
        if (!Auth::check()) {
            return redirect()->route('auth.login');
        }

        $user = Auth::user();
        
        $this->courses = Course::with(['exams' => function($query) {
            $query->where('status', true);
        }, 'exams.quizzes' => function($query) {
            $query->where('status', true);
        }])->find($this->courseId);

        if (!$this->courses || !$this->courses->exams->first()) {
            $this->passcodeError = 'No active exam found for this course.';
            return;
        }

        $exam = $this->courses->exams->first();
        if ($this->passcode === $exam->passcode) {
            $this->passcodeVerified = true;
            $this->passcodeError = null;
            $this->examId = $exam->id;
            $this->quizzes = collect($exam->quizzes)->shuffle()->take(10);
            
            // Initialize answers array with null for each quiz
            $this->answers = array_fill_keys($this->quizzes->pluck('id')->toArray(), null);
            $this->currentAnswer = $this->answers[$this->quizzes[$this->currentQuestion]->id] ?? null;
            
            $this->dispatch('passcode-verified');
        } else {
            $this->passcodeError = 'Incorrect passcode. Please try again.';
        }
    }

    public function startExam()
    {
        $this->dispatch('loading');
        $this->isFullscreen = true;
        $this->dispatch('enterFullscreen');
        $this->startTimer();
    }

    public function goToQuestion($index)
    {
        $this->dispatch('loading');
        if (!$this->courseId) {
            return redirect()->route('student.takeExam');
        }

        if ($index >= 0 && $index < ($this->quizzes ? $this->quizzes->count() : 0)) {
            // Save the current answer before moving
            if ($this->quizzes && isset($this->quizzes[$this->currentQuestion])) {
                $this->answers[$this->quizzes[$this->currentQuestion]->id] = $this->currentAnswer;
            }
            $this->currentQuestion = $index;
            $this->currentAnswer = $this->answers[$this->quizzes[$this->currentQuestion]->id] ?? null;
        }
    }

    public function nextQuestion()
    {
        $this->dispatch('loading');
        if ($this->currentQuestion < $this->quizzes->count() - 1) {
            // Save the current answer before moving
            $this->answers[$this->quizzes[$this->currentQuestion]->id] = $this->currentAnswer;
            $this->currentQuestion++;
            $this->currentAnswer = $this->answers[$this->quizzes[$this->currentQuestion]->id] ?? null;
        }
    }

    public function previousQuestion()
    {
        $this->dispatch('loading');
        if ($this->currentQuestion > 0) {
            // Save the current answer before moving
            $this->answers[$this->quizzes[$this->currentQuestion]->id] = $this->currentAnswer;
            $this->currentQuestion--;
            $this->currentAnswer = $this->answers[$this->quizzes[$this->currentQuestion]->id] ?? null;
        }
    }

    public function updatedCurrentAnswer($value)
    {
        // Update the answers array for the current question
        $this->answers[$this->quizzes[$this->currentQuestion]->id] = $value;
    }

    public function startTimer()
    {
        $timeLeft = 45 * 60; // 45 minutes
        $this->timer = now()->addSeconds($timeLeft);
        
        $this->dispatch('timer', [
            'timeLeft' => $timeLeft
        ]);
    }

    public function submitExam()
{
    $this->dispatch('loading');
    if (!$this->courseId || !$this->examId) {
        return redirect()->route('student.takeExam');
    }

    // Save the current answer before submitting
    $this->answers[$this->quizzes[$this->currentQuestion]->id] = $this->currentAnswer;

    $examUser = ExamUser::firstOrNew([
        'user_id' => Auth::id(),
        'exam_id' => $this->examId
    ]);

    if ($examUser->attempts >= 1) {
        return redirect()->route('v2.student.quiz', ['courseId' => $this->courseId])
            ->with('error', 'Maximum attempts reached');
    }

    $examUser->attempts = ($examUser->attempts ?? 0) + 1;
    $totalMarks = 0;

    // Loop through all quizzes, not just the answered ones
    foreach ($this->quizzes as $quiz) {
        $quizId = $quiz->id;
        $selectedOption = $this->answers[$quizId] ?? null; // Null if no answer provided
        
        $isCorrect = $selectedOption === $quiz->correct_answer;
        $marks = $isCorrect ? $quiz->marks : 0;
        $totalMarks += $marks;

        Answer::create([
            'user_id' => Auth::id(),
            'quiz_id' => $quizId,
            'exam_id' => $this->examId,
            'selected_option' => $selectedOption, // Will be null for unanswered questions
            'obtained_marks' => $marks,
            'attempt' => $examUser->attempts,
        ]);
    }

    $examUser->total_marks = $totalMarks;
    $examUser->save();

    $this->submitted = true;
    $this->dispatch('exitFullscreen');
    return redirect()->route('v2.student.examResult', ['examId' => $this->examId])
        ->with('success', 'Exam submitted successfully!');
}

    #[On('fullscreenChanged')]
    public function handleFullscreenChange($value)
    {
        $this->isFullscreen = $value;
        if (!$value && !$this->submitted) {
            $this->submitExam();
        }
    }

  

    public function render()
    {
        return view('livewire.student.dashboard.takeexam.show-quiz', [
            'courses' => $this->courses,
            'quizzes' => $this->quizzes ?? collect(),
            'passcodeVerified' => $this->passcodeVerified,
            'passcodeError' => $this->passcodeError,
        ]);
    }
}