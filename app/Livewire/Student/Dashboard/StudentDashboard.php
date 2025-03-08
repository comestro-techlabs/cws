<?php

namespace App\Livewire\Student\Dashboard;

use App\Models\Course;
use App\Models\Exam;
use App\Models\Message;
use App\Models\User;
use App\Models\Answer;
use App\Models\Payment;
use App\Models\Assignment_upload;
use App\Models\Assignments;
use App\Models\ExamUser;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Livewire\Student\Messages;


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

        try {
            $this->firstAttempts = Answer::where('user_id', $studentId)
                ->where('attempt', 1)
                ->with('exam')
                ->get()
                ->groupBy('exam_id')
                ->map(function ($answers) {
                    $firstAnswer = $answers->first();
                    return [
                        'exam_name' => $firstAnswer->exam?->exam_name ?? 'Unknown Exam',
                        'total_marks' => $answers->sum('obtained_marks') ?? 0,
                    ];
                })->all();

            $this->secondAttempts = Answer::where('user_id', $studentId)
                ->where('attempt', 2)
                ->with('exam')
                ->get()
                ->groupBy('exam_id')
                ->map(function ($answers) {
                    $firstAnswer = $answers->first();
                    return [
                        'exam_name' => $firstAnswer->exam?->exam_name ?? 'Unknown Exam',
                        'total_marks' => $answers->sum('obtained_marks') ?? 0,
                    ];
                })->all();
        } catch (\Exception $e) {
            $this->firstAttempts = [];
            $this->secondAttempts = [];
        }

        // Fetch only the logged-in student's courses
        $this->courses = Course::whereHas('students', function ($query) use ($studentId) {
            $query->where('user_id', $studentId);
        })->take(2)->get();

        $this->payments = Payment::where('student_id', $studentId)
            ->whereNotNull('course_id')
            ->orderBy('created_at', 'ASC')
            ->with('course')
            ->get();

        $courseIds = $this->courses->pluck('id')->toArray();
        $batchIds = $user->courses()->pluck('course_user.batch_id')->toArray();
        
        // Fetch assignments only for the logged-in student's courses and batches
        $this->assignments = Assignments::whereIn('course_id', $courseIds)
            ->whereHas('batch', function ($query) use ($batchIds) {
                $query->whereIn('id', $batchIds);
            })
            ->latest()
            ->take(4)
            ->get();

        // Fetch only exams for logged-in student's courses
        $this->exams = ExamUser::where('user_id', $studentId)
            ->whereHas('exam', function ($query) use ($courseIds) {
                $query->whereIn('course_id', $courseIds);
            })
            ->take(4)
            ->get();

        foreach ($this->payments as $payment) {
            $payment->progress = $payment->course_progress ?? 0;
        }

        //$readMessages = session('read_messages', []);
        // $this->messages = Message::whereJsonContains('recipients', (string)$studentId)
        //     ->whereNotIn('id', $readMessages)
        //     ->orderBy('created_at', 'desc')
        //     ->take(3)
        //     ->get();
        $messageComponent = new Messages();
        $messageComponent->mount();
        $this->messages = $messageComponent->sortmessages->take(3);
        $this->unreadCount = $messageComponent->unreadCount;
            
    }

    public function hasCompletedExamOrAssignment($userId)
    {
        return ExamUser::where('user_id', $userId)->exists() 
            || Assignment_upload::where('student_id', $userId)->exists();
    }

    #[Layout('components.layouts.student')]
    public function render()
    {
        return view('livewire.student.dashboard.student-dashboard');
    }
}
