<?php

namespace App\Livewire\Student\Dashboard\Takeexam;

use App\Models\ExamUser;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.student')]
class ShowQuiz extends Component
{
    public $courses = null;
    public $quizzes = null;
    public $courseId = null;

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

        $attempt = ExamUser::where('user_id', $user->id)
            ->whereIn('exam_id', $this->courses->exams->pluck('id'))
            ->orderBy('attempts', 'desc') 
            ->first();

        $attempts = $attempt ? $attempt->attempts : 0;

        if ($attempts >= 2) {
            return redirect()->route('v2.student.quiz')->with('error', 'You have reached the maximum number of attempts.');
        }

        $this->quizzes = $this->courses->exams
            ->flatMap(fn($exam) => $exam->quizzes->where('status', true))
            ->shuffle()
            ->take(10)
            ->values(); 
    }

    public function render()
    {
        return view('livewire.student.dashboard.takeexam.show-quiz', [
            'courses' => $this->courses,
            'quizzes' => $this->quizzes ?? collect(),
        ]);
    }
}