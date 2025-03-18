<?php
namespace App\Livewire\Student\Dashboard\Takeexam;

use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\Answer;
use App\Models\Quiz;

#[Layout('components.layouts.student')]
class ShowAllAttempt extends Component
{
    public $course;
    public $attempts_data;
    public $selected_attempt = null;
    public $detailed_answers = [];

    public function mount($course_id)
    {
        $this->course = Course::with('exams')->find($course_id);

        if (!$this->course) {
            abort(404, 'Course not found');
        }

        abort_if(!Auth::check(), 403, 'You must be logged in to access this page');

        $this->loadAttempts();
    }

    public function loadAttempts()
    {
        $user_id = Auth::id();
        $exam_ids = $this->course->exams->pluck('id');

        $attempts = Answer::where('user_id', $user_id)
            ->whereIn('exam_id', $exam_ids)
            ->orderBy('attempt')
            ->get()
            ->groupBy('attempt');

        $this->attempts_data = $attempts->map(function ($answers, $attempt) {
            return [
                'attempt' => $attempt,
                'questions' => $answers->count(),
                'total_marks' => $answers->sum('obtained_marks'),
            ];
        })->values();
    }

    public function showDetails($attempt)
    {
        $user_id = Auth::id();
        $exam_ids = $this->course->exams->pluck('id');

        // Fetch all quizzes for the exams in this course
        $quizzes = Quiz::whereIn('exam_id', $exam_ids)->get();

        // Fetch user's answers for this attempt
        $answers = Answer::where('user_id', $user_id)
            ->whereIn('exam_id', $exam_ids)
            ->where('attempt', $attempt)
            ->with('quiz')
            ->get()
            ->keyBy('quiz_id');

        // Prepare detailed answers, including unanswered questions
        $this->detailed_answers = $quizzes->map(function ($quiz) use ($answers) {
            $answer = $answers->get($quiz->id);

            return [
                'question' => $quiz->question,
                'options' => [
                    'option1' => $quiz->option1,
                    'option2' => $quiz->option2,
                    'option3' => $quiz->option3,
                    'option4' => $quiz->option4,
                ],
                'selected_option' => $answer ? $answer->selected_option : null,
                'correct_option' => $quiz->correct_answer,
                'obtained_marks' => $answer ? $answer->obtained_marks : 0,
            ];
        })->values();

        $this->selected_attempt = $attempt;
    }

    public function closeDetails()
    {
        $this->selected_attempt = null;
        $this->detailed_answers = [];
    }

    public function render()
    {
        return view('livewire.student.dashboard.takeexam.show-all-attempt');
    }
}