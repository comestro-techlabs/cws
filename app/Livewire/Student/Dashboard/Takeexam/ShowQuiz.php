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
use Carbon\Carbon;
use App\Services\GemService;
use Livewire\Attributes\Title;
#[Title('Exam')]
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
    public $timeRemainingInSeconds = 30 * 60; // 30 minutes in seconds
    public $endTime;
    public $tabSwitched = false;

    protected $listeners = [
        'startTimer' => 'startTimer',
        'fullscreenChanged' => 'handleFullscreenChange',
        'tabSwitched' => 'handleTabSwitch'
    ];
    public $hasAccess = false;
    public function mount($courseId)
    {
        try {
            $user = Auth::user();
            if (!$user) {
                throw new \Exception('User not authenticated');
            }

            // Check access first and redirect if no access
            $this->hasAccess = $user->hasAccess();
            if (!$this->hasAccess) {
                session()->flash('showAccessModal', true); // Set flag for modal
                return redirect()->route('student.takeExam');
            }

            $this->courseId = $courseId;
            $examAttempt = ExamUser::where('user_id', $user->id)
                ->whereHas('exam', function ($query) use ($courseId) {
                    $query->where('course_id', $courseId);
                })
                ->first();
    
            if ($examAttempt && $examAttempt->attempts >= 1) {
                return redirect()->route('student.takeExam')
                    ->with('error', 'You have already taken this exam. Multiple attempts are not allowed.');
            }
    
            // **Reset the timer each time a new exam starts**
            $this->timeRemainingInSeconds = 1800; // 30 minutes (reset timer)
            $this->endTime = now()->addSeconds($this->timeRemainingInSeconds)->timestamp;
            session(['exam_end_time' => $this->endTime]); // Store fresh end time
    
        } catch (\Exception $e) {
            return redirect()->route('auth.login')
                ->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    
    

   // Remove these lines from functions:
// $this->dispatch('loading');

public function verifyPasscode()
{
    $this->validate([
        'passcode' => 'required|string',
    ]);

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
        $this->quizzes = collect($exam->quizzes)->shuffle()->take(50);
        
        $this->answers = array_fill_keys($this->quizzes->pluck('id')->toArray(), null);
        $this->currentAnswer = $this->answers[$this->quizzes[$this->currentQuestion]->id] ?? null;
        
        // **Removed the unnecessary event dispatch**
        // $this->dispatch('passcode-verified');
    } else {
        $this->passcodeError = 'Incorrect passcode. Please try again.';
    }
}


    // public function startExam()
    // {
    //     $this->dispatch('loading');
    //     $this->isFullscreen = true;
    //     $this->dispatch('enterFullscreen');
    // }
    public function startExam()
{
    $this->dispatch('loading');
    $this->isFullscreen = true;
    $this->dispatch('enterFullscreen');
    \Log::info('Livewire event dispatched: enterFullscreen');
}

    public function updateTimer()
{
    $this->timeRemainingInSeconds = max(0, $this->endTime - now()->timestamp);

    // **Auto-submit when time runs out**
    if ($this->timeRemainingInSeconds <= 0) {
        $this->submitExam();
    }
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
        
        // Auto advance to next question after a brief delay
        if ($this->currentQuestion < $this->quizzes->count() - 1) {
            $this->dispatch('loading');
            $this->nextQuestion();
        }
    }

    public function submitExam()
    {
        if ($this->tabSwitched) {
            $this->dispatch('exitFullscreen');
        }
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
        $correctAnswers = 0;

        try {
            // Loop through all quizzes first to count correct answers
            foreach ($this->quizzes as $quiz) {
                $quizId = $quiz->id;
                $selectedOption = $this->answers[$quizId] ?? null;
                
                $isCorrect = $selectedOption === $quiz->correct_answer;
                $marks = $isCorrect ? $quiz->marks : 0;
                $totalMarks += $marks;

                if ($isCorrect) {
                    $correctAnswers++;
                }

                Answer::create([
                    'user_id' => Auth::id(),
                    'quiz_id' => $quizId,
                    'exam_id' => $this->examId,
                    'selected_option' => $selectedOption,
                    'obtained_marks' => $marks,
                    'attempt' => $examUser->attempts,
                ]);
            }

            // Award gems based on total correct answers
            $totalGems = $correctAnswers * 10;
            if ($totalGems > 0) {
                $gemService = new GemService();
                $gemService->earnedGem($totalGems, "Earned {$totalGems} gems for correct answers in exam");
            }

            $examUser->total_marks = $totalMarks;
            $examUser->save();

            $this->submitted = true;
            $this->dispatch('exitFullscreen');

            $message = $totalGems > 0 
                ? "Exam submitted successfully! You earned {$totalGems} gems for {$correctAnswers} correct answers!" 
                : "Exam submitted successfully!";

            return redirect()->route('v2.student.examResult', ['examId' => $this->examId])
                ->with('success', $message);

        } catch (\Exception $e) {
            return redirect()->route('v2.student.examResult', ['examId' => $this->examId])
                ->with('success', 'Exam submitted successfully, but there was an error awarding gems.');
        }
    }

    #[On('fullscreenChanged')]
    public function handleFullscreenChange($value)
    {
        $this->isFullscreen = $value;
        if (!$value && !$this->submitted) {
            $this->submitExam();
        }
    }

    #[On('tabSwitched')]
    public function handleTabSwitch()
    {
        if (!$this->submitted && $this->passcodeVerified) {
            // Save current answer if any
            if (isset($this->quizzes[$this->currentQuestion])) {
                $this->answers[$this->quizzes[$this->currentQuestion]->id] = $this->currentAnswer;
            }
            $this->tabSwitched = true;
            $this->submitExam();
            session()->flash('error', 'Exam auto-submitted because you switched tabs.');
        }
    }

    #[On('timerStarted')]
    public function enableTimer()
    {
        $this->dispatch('updateTimer')->self()->everySecond();
    }
    
    
  

    public function render()
    {
        return view('livewire.student.dashboard.takeexam.show-quiz', [
            'courses' => $this->courses,
            'quizzes' => $this->quizzes ?? collect(),
            'passcodeVerified' => $this->passcodeVerified,
            'passcodeError' => $this->passcodeError,
            'tabSwitched' => $this->tabSwitched,
        ]);
    }
}