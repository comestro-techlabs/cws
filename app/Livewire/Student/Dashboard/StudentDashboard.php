<?php

namespace App\Livewire\Student\Dashboard;

use App\Models\Attendance;
use App\Models\Course;
use App\Models\Exam;
use App\Models\Message;
use App\Models\User;
use App\Models\Answer;
use App\Models\Payment;
use App\Models\Assignment_upload;
use App\Models\Assignments;
use App\Models\ExamUser;
use App\Models\CourseUser;
use App\Models\Assignment;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Livewire\Student\Messages;
use Illuminate\Support\Facades\DB;

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
    public $studentBatches;
    public $gems = 0;
    public $points = 0;
    public $attendance = 0;
    public $completedTasks = 0;
    public $totalTasks = 0;
    public $nextMilestone = 100;
    public $weekDays;
    public $studentId;

    public function mount()
    {
        if (!Auth::check()) {
            return redirect()->route('auth.login')->with('error', 'You must be logged in to access this page');
        }

        $studentId = Auth::id();
        $this->studentId = $studentId;
        $user = User::findOrFail($studentId);
        $this->loadAttendance();

        // Initialize student stats
        $this->gems = $user->gems ?? 0;
        $this->points = $user->points ?? 0;
        $this->completedTasks = Assignment_upload::where('student_id', $studentId)->where('status', 'submitted')->count();
        $this->totalTasks = Assignments::whereIn('course_id', $user->courses->pluck('id'))->count();

        // Calculate attendance percentage
        $totalClasses = $user->courses->sum('total_classes') ?? 0;
        $attendedClasses = $user->courses->sum('attended_classes') ?? 0;
        $this->attendance = $totalClasses > 0 ? round(($attendedClasses / $totalClasses) * 100) : 0;

        // Generate weekly attendance data

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

        // $this->assignments = Assignments::whereIn('course_id', $courseIds)
        //     ->whereHas('batch', function ($query) use ($batchIds) {
        //         $query->whereIn('id', $batchIds);
        //     })
        //     ->whereHas('assignmentUploads', function ($query) use ($studentId) {
        //         $query->where('student_id', $studentId);
        //     })
        //     ->latest()
        //     ->take(4)
        //     ->get();
        $this->assignments = Assignments::whereIn('course_id', $courseIds)
            ->whereHas('batch', function ($query) use ($batchIds) {
                $query->whereIn('id', $batchIds);
            })
            ->when($studentId != 1, function ($query) use ($studentId) {
                $query->whereHas('assignmentUploads', function ($subQuery) use ($studentId) {
                    $subQuery->where('student_id', $studentId);
                });
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
    public function loadAttendance()
    {
        $attendanceRecords = Attendance::where('user_id', $this->studentId)
            ->whereBetween('check_in', [
                now()->subWeek()->startOfWeek(),
                now()
            ])
            ->orderBy('check_in', 'asc')
            ->get()
            ->keyBy(function ($item) {
                return date('Y-m-d', strtotime($item->check_in));
            });

        $start = now()->subWeek()->startOfWeek();
        $today = now();
        $allWeekDays = collect();

        for ($i = 0; $start->copy()->addDays($i)->lte($today); $i++) {
            $date = $start->copy()->addDays($i);

            if ($date->isWeekend()) {
                continue;
            }

            $dateKey = $date->format('Y-m-d');
            $isPresent = isset($attendanceRecords[$dateKey]);

            $allWeekDays->push([
                'present' => $isPresent,
                'name' => $date->format('l'),
                'date' => $dateKey
            ]);
        }

        // Take the last 5 weekdays
        $this->weekDays = $allWeekDays->take(-5);
    }
    public function hasCompletedExamOrAssignment($userId)
    {
        return ExamUser::where('user_id', $userId)->exists()
            || Assignment_upload::where('student_id', $userId)->exists();
    }

    #[Layout('components.layouts.student')]
    public function render()
    {
        return view('livewire.student.dashboard.student-dashboard', [
            'courses' => $this->courses,
            'assignments' => $this->assignments,
            'gems' => $this->gems,
            'points' => $this->points,
            'attendance' => $this->attendance,
            'completedTasks' => $this->completedTasks,
            'totalTasks' => $this->totalTasks,
            'nextMilestone' => $this->nextMilestone,
            'messages' => $this->messages,
            'exams' => $this->exams
        ]);
    }
}