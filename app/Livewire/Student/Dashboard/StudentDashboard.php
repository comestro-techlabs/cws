<?php

namespace App\Livewire\Student\Dashboard;

use App\Models\Attendance;
use App\Models\Course;
use App\Models\Exam;
use App\Models\User;
use App\Models\Answer;
use App\Models\Payment;
use App\Models\Assignment_upload;
use App\Models\Assignments;
use App\Models\ExamUser;
use App\Models\CourseUser;
use App\Models\Assignment;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
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
    public $weekDays = [];
    public $studentId;
    public $attendancePercentage;

    public function mount()
    {
        if (!Auth::check()) {
            return redirect()->route('auth.login')->with('error', 'You must be logged in to access this page');
        }

        $studentId = Auth::id();
        $this->studentId = $studentId;
        $user = User::findOrFail($studentId);
        $onlineCourse = Course::whereHas('students', function ($query) {
            $query->where('user_id', $this->studentId);
        })->where('course_type', 'online')->with('batches')->first();
        
        if ($onlineCourse) {
            $today = Carbon::today();
            $courseStudent = $user->courses()->where('courses.id', $onlineCourse->id)->first();
            $batchId = $courseStudent->pivot->batch_id ?? null;
            $batch = $batchId ? $onlineCourse->batches->find($batchId) : $onlineCourse->batches->first();
        
            if ($batch) {
                $existingAttendance = Attendance::where('user_id', $this->studentId)
                    ->where('course_id', $onlineCourse->id)
                    ->where('batch_id', $batch->id)
                    ->whereDate('check_in', $today)
                    ->exists();
        
                if (!$existingAttendance) {
                    Attendance::create([
                        'user_id' => $this->studentId,
                        'check_in' => now(),
                        'course_id' => $onlineCourse->id,
                        'batch_id' => $batch->id,
                    ]);
                }
            }
        }
        $attendanceData = $this->loadAttendance();
        $this->weekDays = $attendanceData['weekDays'];
        $this->attendancePercentage = $attendanceData['attendancePercentage'];
        $this->attendance = $attendanceData['showPercentage'] ? $this->attendancePercentage : 0;

        // Initialize student stats
        $this->gems = $user->gem ?? 0;
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
        $batchIds = $user->courses()->pluck('course_student.batch_id')->toArray();

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

    }
    public function loadAttendance()
{
    $student = User::find($this->studentId);

    if (!$student) {
        return [
            'weekDays' => collect(),
            'attendancePercentage' => 0,
            'showPercentage' => false
        ];
    }

    $joinDate = Carbon::parse($student->created_at)->startOfDay();
    $today = Carbon::today();
    $weekDays = collect();

    $hasOnlineCourses = Course::whereHas('students', function ($query) {
        $query->where('user_id', $this->studentId);
    })->where('course_type', 'online')->exists();

    // Get online course IDs
    $onlineCourseIds = Course::whereHas('students', function ($query) {
        $query->where('user_id', $this->studentId);
    })->where('course_type', 'online')->pluck('id')->toArray();

    // Calculate weekdays (excluding Saturdays and Sundays) since joining
    $weekdaysSinceJoining = 0;
    $tempDate = $joinDate->copy();
    while ($tempDate->lte($today)) {
        if (!$tempDate->isSaturday() && !$tempDate->isSunday()) {
            $weekdaysSinceJoining++;
        }
        $tempDate->addDay();
    }
    
    // Subtract 1 because we don't count today yet unless attendance is recorded
    $weekdaysSinceJoining = max(0, $weekdaysSinceJoining - 1);
    $showPercentage = $weekdaysSinceJoining >= 7; // Show percentage after 7 weekdays

    if ($joinDate->isToday()) {
        $attendanceRecords = Attendance::where('user_id', $this->studentId)
            ->where(function ($query) use ($onlineCourseIds) {
                $query->whereIn('course_id', $onlineCourseIds)
                    ->orWhereNull('course_id'); 
            })
            ->whereBetween('check_in', [$joinDate, $today])
            ->get()
            ->groupBy(function ($item) {
                return date('Y-m-d', strtotime($item->check_in));
            });

        $dateKey = $today->format('Y-m-d');
        $isPresent = $hasOnlineCourses && isset($attendanceRecords[$dateKey]);

        // Only include if it's not Saturday or Sunday
        if (!$today->isSaturday() && !$today->isSunday()) {
            $weekDays->push([
                'present' => $isPresent,
                'name' => $today->format('l'),
                'date' => $dateKey
            ]);
        }

        $attendancePercentage = 0;
    } else { // Joined before today
        $startDate = $joinDate->gt(Carbon::now()->startOfWeek()) ? $joinDate : Carbon::now()->startOfWeek();
        $endDate = Carbon::now();

        $attendanceRecords = Attendance::where('user_id', $this->studentId)
            ->whereBetween('check_in', [$startDate, $endDate])
            ->orderBy('check_in', 'asc')
            ->get()
            ->keyBy(function ($item) {
                return date('Y-m-d', strtotime($item->check_in));
            });

        $start = $startDate;
        
        for ($i = 0; $start->copy()->addDays($i)->lte($today); $i++) {
            $date = $start->copy()->addDays($i);
            // Skip Saturdays and Sundays entirely
            if ($date->isSaturday() || $date->isSunday()) {
                continue;
            }

            $dateKey = $date->format('Y-m-d');
            $isPresent = isset($attendanceRecords[$dateKey]);

            $weekDays->push([
                'present' => $isPresent,
                'name' => $date->format('l'),
                'date' => $dateKey
            ]);
        }

        $weekDays = $weekDays->take(-5); // Last 5 weekdays
        $totalDays = $weekDays->count();
        $presentDays = $weekDays->where('present', true)->count();
        $attendancePercentage = $totalDays > 0 && $showPercentage ? 
            round(($presentDays / $totalDays) * 100) : 0;
    }

    return [
        'weekDays' => $weekDays,
        'attendancePercentage' => $attendancePercentage,
        'showPercentage' => $showPercentage
    ];
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
            'exams' => $this->exams,
            'attendancePercentage' => $this->attendancePercentage,
            'showPercentage' => $this->loadAttendance()['showPercentage']
        ]);
    }
}