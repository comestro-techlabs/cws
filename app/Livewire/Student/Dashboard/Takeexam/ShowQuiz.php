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
    public $selectedOptions = []; // To store quiz answers

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

        // Set the first active exam ID (assuming one exam per quiz session)
        $attempt = ExamUser::where('user_id', $user->id)
            ->whereHas('exam', function ($query) use ($courseId) {
                $query->where('course_id', $courseId);
            })
            ->first();

        $value = $attempt ? $attempt->attempts : 0;

        // Allow a maximum of 2 attempts
        if ($value >= 2) {
            return redirect()->route('v2.student.quiz')
                             ->with('error', 'You have reached the maximum number of attempts.');
        }
        $this->quizzes = $this->courses->exams
            ->flatMap(fn($exam) => $exam->quizzes->where('status', true))
            ->shuffle()
            ->take(10)
            ->values();
    }

    public function storeAnswer()
    {
        if (!Auth::check()) {
            return redirect()->route('auth.login');
        }

        $user = Auth::user();
        $totalMarks = 0;
        $obtainedMarks = 0;

        // Find or create ExamUser record
        $examUser = ExamUser::where('user_id', $user->id)
            ->where('exam_id', $this->examId)
            ->first();

        if ($examUser) {
            if ($examUser->attempts >= 2) {
                return redirect()->route('v2.student.quiz')->with('error', 'Maximum attempts reached.');
            }
            $examUser->attempts += 1;
        } else {
            $examUser = ExamUser::create([
                'user_id' => $user->id,
                'exam_id' => $this->examId,
                'attempts' => 1,
            ]);
        }

        $currentAttempt = $examUser->attempts;

        if (!empty($this->selectedOptions)) {
            foreach ($this->selectedOptions as $quizId => $selectedOption) {
                $quiz = Quiz::find($quizId);

                if ($quiz) {
                    $totalMarks += $quiz->marks;

                    $isCorrect = $selectedOption === $quiz->correct_answer;
                    $marks = $isCorrect ? $quiz->marks : 0;
                    $obtainedMarks += $marks;

                    Answer::create([
                        'user_id' => $user->id,
                        'quiz_id' => $quizId,
                        'exam_id' => $this->examId,
                        'selected_option' => $selectedOption,
                        'obtained_marks' => $marks,
                        'attempt' => $currentAttempt,
                    ]);
                }
            }

            $examUser->total_marks = $obtainedMarks;
            $examUser->save();

            session()->flash('obtained_marks', $obtainedMarks);
            session()->flash('exam_id', $this->examId);

            return redirect()->route('student.examResult', $this->examId)->with('success', 'Answers submitted successfully!');
        }

        // If no options selected, still record the attempt
        $examUser->total_marks = 0;
        $examUser->save();

        return redirect()->route('student.examResult', $this->examId)->with('success', 'No answers submitted, attempt recorded.');
    }

    public function render()
    {
        if (!$this->courses || !$this->quizzes) {
            \Log::info('Courses or quizzes not loaded', ['courses' => $this->courses, 'quizzes' => $this->quizzes]);
        }
        return view('livewire.student.dashboard.takeexam.show-quiz', [
            'courses' => $this->courses,
            'quizzes' => $this->quizzes ?? collect(),
        ]);
    }
}