<?php
namespace App\Livewire\Student\Dashboard\Takeexam;

use App\Models\Answer;
use App\Models\ExamUser;
use App\Models\Quiz;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\Course;  // Add this import

#[Layout('components.layouts.exam')] // Change layout to exam
class ShowQuiz extends Component
{
    public $courses = null;
    public $quizzes = null;
    public $courseId = null;
    public $examId = null;
    public $selectedOptions = [];
    public $obtainedMarks = null;
    public $totalMarks = null;
    public $submitted = false;
    public $passcode = '';
    public $passcodeVerified = false;
    public $passcodeError = null;
    public $currentQuestion = 0;
    public $answers = [];
    public $isFullscreen = false;
    public $timeRemaining = '45:00';
    protected $timer;

    protected $listeners = [
        'startTimer' => 'startTimer',
        'fullscreenChanged' => 'handleFullscreenChange'
    ];

    public function mount($courseId)
    {
        $this->courseId = $courseId;
    }

    public function verifyPasscode()
    {
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
            $this->examId = $exam->id; // Save the exam ID
            $this->quizzes = collect($exam->quizzes)->shuffle()->take(10);
            
            // Initialize answers array with null values for each quiz
            $this->answers = array_fill_keys($this->quizzes->pluck('id')->toArray(), null);
            
            $this->dispatch('passcode-verified');
        } else {
            $this->passcodeError = 'Incorrect passcode. Please try again.';
        }
    }

    public function showquiz($courseId)
    {
        if (!Auth::check()) {
            return redirect()->route('auth.login');
        }

        $user = Auth::user();

        $attempt = ExamUser::where('user_id', $user->id)
            ->whereHas('exam', function ($query) use ($courseId) {
                $query->where('course_id', $courseId);
            })
            ->first();

        $value = $attempt ? $attempt->attempts : 0;

        if ($value >= 1) {
            return redirect()->route('v2.student.quiz')->with('error', 'You have reached the maximum number of attempts.');
        }   

        $this->quizzes = $this->courses->exams
            ->flatMap(fn($exam) => $exam->quizzes->where('status', true))
            ->shuffle()
            ->take(10)
            ->values();

        $this->totalMarks = $this->quizzes->sum('marks');
    }

    #[On('submitQuiz')]
    public function storeAnswer()
    {
        if (!Auth::check()) {
            return redirect()->route('auth.login')->with('error', 'You must be logged in to access this page');
        }

        if (!$this->passcodeVerified) {
            return redirect()->route('v2.student.quiz')->with('error', 'Passcode not verified.');
        }

        $this->totalMarks = 0;
        $this->obtainedMarks = 0;

        $examUser = ExamUser::where('user_id', Auth::id())
            ->where('exam_id', $this->examId)
            ->first();

        if ($examUser) {
            if ($examUser->attempts >= 1) {
                return redirect()->route('v2.student.quiz')->with('error', 'You have reached the maximum number of attempts.');
            }
            
        } else {
            $examUser = ExamUser::create([
                'user_id' => Auth::id(),
                'exam_id' => $this->examId,
                'attempts' => 1,
            ]);
        }

        $currentAttempt = $examUser->attempts;

        if (!empty($this->selectedOptions)) {
            foreach ($this->selectedOptions as $quizId => $selectedOption) {
                $quiz = Quiz::find($quizId);

                if ($quiz) {
                    $this->totalMarks += $quiz->marks;

                    if ($selectedOption == $quiz->correct_answer) {
                        $this->obtainedMarks += $quiz->marks;
                    }

                    Answer::create([
                        'user_id' => Auth::id(),
                        'quiz_id' => $quizId,
                        'exam_id' => $this->examId,
                        'selected_option' => $selectedOption,
                        'obtained_marks' => ($selectedOption == $quiz->correct_answer) ? $quiz->marks : 0,
                        'attempt' => $currentAttempt,
                    ]);
                }
            }

            $examUser->total_marks = $this->obtainedMarks;
            $examUser->save();

            session()->flash('obtained_marks', $this->obtainedMarks);
            session()->flash('exam_id', $this->examId);
        } else {
            $examUser->total_marks = 0;
            $examUser->save();
        }

        $this->submitted = true;

        return redirect()->route('v2.student.examResult', $this->examId)->with([
            'success' => 'Answer submitted successfully!',
            'exam_id' => $this->examId,
        ]);
    }

    public function startExam()
    {
        $this->dispatch('loading');
        $this->isFullscreen = true;
        $this->dispatch('enterFullscreen');
        $this->startTimer();
    }

    public function exitExam()
    {
        $this->isFullscreen = false;
        $this->submitExam();
    }

    public function goToQuestion($index)
    {
        $this->dispatch('loading');
        if (!$this->courseId) {
            return redirect()->route('student.takeExam');
        }

        if ($index >= 0 && $index < ($this->quizzes ? $this->quizzes->count() : 0)) {
            $this->currentQuestion = $index;
        }
    }

    public function nextQuestion()
    {
        $this->dispatch('loading');
        if ($this->currentQuestion < $this->quizzes->count() - 1) {
            $this->currentQuestion++;
        }
    }

    public function previousQuestion()
    {
        $this->dispatch('loading');
        if ($this->currentQuestion > 0) {
            $this->currentQuestion--;
        }
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

        // Store answers and update total marks
        $examUser = ExamUser::firstOrNew([
            'user_id' => Auth::id(),
            'exam_id' => $this->examId
        ]);

        if ($examUser->attempts >= 2) {
            return redirect()->route('v2.student.quiz', ['courseId' => $this->courseId])
                ->with('error', 'Maximum attempts reached');
        }

        $examUser->attempts = ($examUser->attempts ?? 0) + 1;
        $totalMarks = 0;

        foreach ($this->answers as $quizId => $answer) {
            $quiz = Quiz::find($quizId);
            if ($quiz && $answer === $quiz->correct_answer) {
                $totalMarks += $quiz->marks;
            }
        }

        $examUser->total_marks = $totalMarks;
        $examUser->save();

        $this->dispatch('exitFullscreen');
        return redirect()->route('v2.student.examResult', ['exam_id' => $this->examId]);
    }

    public function handleFullscreenChange($isFullscreen)
    {
        $this->isFullscreen = $isFullscreen;
        if (!$isFullscreen && !$this->submitted) {
            $this->submitExam();
        }
    }

    public function render()
    {
        return view('livewire.student.dashboard.takeexam.show-quiz', [
            'courses' => $this->courses,
            'quizzes' => $this->quizzes ?? collect(),
            'totalMarks' => $this->totalMarks,
            'passcodeVerified' => $this->passcodeVerified,
            'passcodeError' => $this->passcodeError,
        ]);
    }
}