<?php
namespace App\Livewire\Student\Dashboard\Takeexam;

use App\Models\Answer;
use App\Models\ExamUser;
use App\Models\Quiz;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
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

    public function mount($courseId)
    {
        $this->courseId = $courseId;
        $this->showquiz($courseId);
    }

    public function showquiz($courseId)
    {
        if (!Auth::check()) {
            return redirect()->route('auth.login');
        }

        $user = Auth::user();

        $this->courses = $user->courses()
            ->where('courses.id', $courseId)
            ->with([
                'exams' => fn($query) => $query->where('status', true),
                'exams.quizzes' => fn($query) => $query->where('status', true),
            ])
            ->first();

        if (!$this->courses || $this->courses->exams->isEmpty()) {
            return redirect()->route('v2.student.quiz')->with('error', 'Course not found or no active exams available.');
        }

        $this->examId = $this->courses->exams->first()->id;

        $attempt = ExamUser::where('user_id', $user->id)
            ->whereHas('exam', function ($query) use ($courseId) {
                $query->where('course_id', $courseId);
            })
            ->first();

        $value = $attempt ? $attempt->attempts : 0;

        if ($value >= 2) {
            return redirect()->route('v2.student.quiz')->with('error', 'You have reached the maximum number of attempts.');
        }

        $this->quizzes = $this->courses->exams
            ->flatMap(fn($exam) => $exam->quizzes->where('status', true))
            ->shuffle()
            ->take(10)
            ->values();

        $this->totalMarks = $this->quizzes->sum('marks');
    }

    public function storeAnswer()
    {
        if (!Auth::check()) {
            return redirect()->route('auth.login')->with('error', 'You must be logged in to access this page');
        }

        $this->totalMarks = 0; // Maximum possible marks
        $this->obtainedMarks = 0; // User's score

        $examUser = ExamUser::where('user_id', Auth::id())
            ->where('exam_id', $this->examId)
            ->first();

        if ($examUser) {
            $examUser->attempts += 1;
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

            $examUser->total_marks = $this->obtainedMarks; // Store user's score
            $examUser->save();

            session()->flash('obtained_marks', $this->obtainedMarks);
            session()->flash('exam_id', $this->examId);

            return redirect()->route('v2.student.examResult', $this->examId)->with([
                'success' => 'Answer submitted successfully!',
                'exam_id' => $this->examId,
            ]);
        }

        // If no answers are submitted, still save the attempt
        $examUser->total_marks = 0;
        $examUser->save();

        return redirect()->route('v2.student.examResult', $this->examId)->with([
            'success' => 'Answer submitted successfully!',
            'exam_id' => $this->examId,
        ]);
    }

    public function render()
    {
        if (!$this->courses || !$this->quizzes) {
            \Log::info('Courses or quizzes not loaded', ['courses' => $this->courses, 'quizzes' => $this->quizzes]);
        }
        return view('livewire.student.dashboard.takeexam.show-quiz', [
            'courses' => $this->courses,
            'quizzes' => $this->quizzes ?? collect(),
            'totalMarks' => $this->totalMarks,
        ]);
    }
}