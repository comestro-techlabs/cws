<?php
namespace App\Livewire\Student\Dashboard\Takeexam;

use App\Models\Answer;
use App\Models\ExamUser;
use App\Models\Quiz;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

#[Layout('components.layouts.student')]
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

    public function mount($courseId)
    {
        $this->courseId = $courseId;
    }

    public function verifyPasscode()
    {
        if (!Auth::check()) {
            return redirect()->route('auth.login');
        }

        $user = Auth::user();

        $this->courses = $user->courses()
            ->where('courses.id', $this->courseId)
            ->with([
                'exams' => fn($query) => $query->where('status', true),
                'exams.quizzes' => fn($query) => $query->where('status', true),
            ])
            ->first();

        if (!$this->courses || $this->courses->exams->isEmpty()) {
            return redirect()->route('v2.student.quiz')->with('error', 'Course not found or no active exams available.');
        }

        $exam = $this->courses->exams->first();
        $this->examId = $exam->id;

        if (!$exam->passcode) {
            return redirect()->route('v2.student.quiz')->with('error', 'No passcode set for this exam.');
        }

        if ($this->passcode === $exam->passcode) {
            $this->passcodeVerified = true;
            $this->passcodeError = null;
            $this->showquiz($this->courseId);
            $this->dispatch('passcode-verified'); // Dispatch event to trigger JS
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