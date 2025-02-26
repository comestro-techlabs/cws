<?php

namespace App\Livewire\Student\Dashboard;

use App\Models\Course;
use App\Models\Exam;
use App\Models\Message;
use App\Models\User;
use App\Models\Answer;
use App\Models\Payment;
use App\Models\Assignment;
use App\Models\Assignment_upload;
use App\Models\Assignments;
use App\Models\ExamUser;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

class StudentDashboard extends Component
{
    public $courses;
    public $messages;
    public $exams;
    public $payments;
    public $assignments;
    public $firstAttempts;
    public $secondAttempts;
    public $hasCompleted;

    public function mount()
    {
        if (!Auth::check()) {
            return redirect()->route('auth.login')->with('error', 'You must be logged in to access this page');
        }

        $studentId = Auth::id();
        $user = User::findOrFail($studentId);

        $this->hasCompleted = $this->hasCompletedExamOrAssignment($studentId);

        // Fetch attempts
        $this->firstAttempts = Answer::where('user_id', $studentId)
            ->where('attempt', 1)
            ->with('exam')
            ->get()
            ->groupBy('exam_id')
            ->map(fn ($answers) => [
                'exam_name' => $answers->first()->exam->exam_name,
                'total_marks' => $answers->sum('obtained_marks'),
            ]);

        $this->secondAttempts = Answer::where('user_id', $studentId)
            ->where('attempt', 2)
            ->with('exam')
            ->get()
            ->groupBy('exam_id')
            ->map(fn ($answers) => [
                'exam_name' => $answers->first()->exam->exam_name,
                'total_marks' => $answers->sum('obtained_marks'),
            ]);

        // Fetch user-related data
        $this->courses = $user->courses()->take(2)->get();
        $this->payments = Payment::where('student_id', $studentId)->whereNotNull('course_id')->orderBy('created_at', 'ASC')->with('course')->get();
        $this->assignments = Assignments::whereIn('course_id', $user->courses->pluck('id'))->latest()->take(4)->get();
        $this->exams = ExamUser::whereIn('exam_id', $user->courses->pluck('id'))->take(4)->get();

        // Calculate progress for each payment
        foreach ($this->payments as $payment) {
            $payment->progress = $payment->course_progress;
        }

        $readMessages = session('read_messages', []);
        $this->messages = Message::whereJsonContains('recipients', $studentId)
            ->whereNotIn('id', $readMessages) // Only unread messages
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();
    }
    public function hasCompletedExamOrAssignment($userId)
    {
        $hasExam = ExamUser::where('user_id', $userId)->exists();
        $hasAssignment = Assignment_upload::where('student_id', $userId)->exists();
        return $hasExam || $hasAssignment;
    }

    #[Layout('components.layouts.student')]
    public function render()
    {
        return view('livewire.student.dashboard.student-dashboard');
    }
}
