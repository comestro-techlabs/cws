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
    public $onlineThursdayAttendance = null; // 'present', 'absent', or null
    public $offlineThursdayAttendance = null;

    public function mount()
    {
        if (!Auth::check()) {
            return redirect()->route('auth.login')->with('error', 'You must be logged in to access this page');
        }

        $studentId = Auth::id();
        $this->studentId = $studentId;
        $user = User::findOrFail($studentId);

        $hasAccess = $user->hasAccess();
        $accessStatus = $user->getAccessStatus();

        if (!$hasAccess) {
            $this->courses = collect();
            $this->exams = collect();
            $this->payments = collect();
            $this->assignments = collect();
            $this->gems = 0;
            $this->points = 0;
            $this->attendance = 0;
            $this->completedTasks = 0;
            $this->totalTasks = 0;
            $this->firstAttempts = [];
            $this->secondAttempts = [];
            $this->weekDays = collect();
            $this->attendancePercentage = 0;

            $restrictionMessage = 'Your access to the dashboard is restricted: ';
            $reasons = $accessStatus['reasons'];
            if (
                in_array('No active batches for non-subscription courses', $reasons) ||
                in_array('No active batches for subscription-based courses', $reasons)
            ) {
                $restrictionMessage .= 'Your batch has ended already.';
            } else {
                $restrictionMessage .= implode(', ', $reasons);
            }
            session()->flash('error', $restrictionMessage);
            return;
        }
        $onlineCourse = Course::whereHas('students', function ($query) {
            $query->where('user_id', $this->studentId);
        })->where('course_type', 'online')->with('batches')->first();

        if ($onlineCourse) {
            $today = Carbon::today();
            $courseStudent = $user->courses()->where('courses.id', $onlineCourse->id)->first();
            $batchId = $courseStudent->pivot->batch_id ?? null;
            $batch = $batchId ? $onlineCourse->batches->find($batchId) : $onlineCourse->batches->first();

            if ($batch && $today->lte(Carbon::parse($batch->end_date))) {
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

        // Load attendance data
        $attendanceData = $this->loadAttendance();
        $this->onlineWeekDays = $attendanceData['onlineWeekDays'];
        $this->offlineWeekDays = $attendanceData['offlineWeekDays'];
        $this->onlineAttendancePercentage = $attendanceData['onlineAttendancePercentage'];
        $this->offlineAttendancePercentage = $attendanceData['offlineAttendancePercentage'];
        $this->onlineThursdayAttendance = $attendanceData['onlineThursdayAttendance'];
        $this->offlineThursdayAttendance = $attendanceData['offlineThursdayAttendance'];

        // Calculate combined attendance percentage
        $totalWeekdays = $attendanceData['onlineTotalWeekdays'] + $attendanceData['offlineTotalWeekdays'];
        $totalPresentDays = $attendanceData['onlinePresentDays'] + $attendanceData['offlinePresentDays'];
        $this->attendancePercentage = $totalWeekdays > 0 ?
            round(($totalPresentDays / $totalWeekdays) * 100) : 0;
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
                'onlineWeekDays' => collect(),
                'offlineWeekDays' => collect(),
                'onlineAttendancePercentage' => 0,
                'offlineAttendancePercentage' => 0,
                'onlineThursdayAttendance' => null,
                'offlineThursdayAttendance' => null,
                'showPercentage' => false
            ];
        }

        $courses = $student->courses()->with('batches')->get();

        if ($courses->isEmpty()) {
            return [
                'onlineWeekDays' => collect(),
                'offlineWeekDays' => collect(),
                'onlineAttendancePercentage' => 0,
                'offlineAttendancePercentage' => 0,
                'onlineThursdayAttendance' => null,
                'offlineThursdayAttendance' => null,
                'showPercentage' => false
            ];
        }

        $onlineWeekDays = collect();
        $offlineWeekDays = collect();
        $onlineTotalWeekdays = 0;
        $onlinePresentDays = 0;
        $offlineTotalWeekdays = 0;
        $offlinePresentDays = 0;
        $today = Carbon::today();
        $onlineThursdayAttendance = null;
        $offlineThursdayAttendance = null;

        foreach ($courses as $course) {
            $courseStudent = $student->courses()->where('courses.id', $course->id)->first();
            $batchId = $courseStudent->pivot->batch_id ?? null;
            $batch = $batchId ? $course->batches->find($batchId) : $course->batches->first();

            if (!$batch)
                continue;

            $startDate = Carbon::parse($courseStudent->pivot->created_at ?? $batch->start_date)->startOfDay();
            $endDate = Carbon::parse($batch->end_date)->startOfDay();
            $effectiveEnd = $today->gt($endDate) ? $endDate : $today;

            $attendanceRecords = Attendance::where('user_id', $this->studentId)
                ->where('course_id', $course->id)
                ->where('batch_id', $batch->id)
                ->whereBetween('check_in', [$startDate, $today->endOfDay()])
                ->orderBy('check_in', 'asc')
                ->get()
                ->keyBy(function ($item) {
                    return Carbon::parse($item->check_in)->format('Y-m-d');
                });

            $tempDate = $startDate->copy();
            if ($course->course_type === 'online') {
                while ($tempDate->lte($effectiveEnd)) {
                    if (!$tempDate->isSaturday() && !$tempDate->isSunday()) {
                        $onlineTotalWeekdays++;
                    }
                    $tempDate->addDay();
                }
            } else {
                while ($tempDate->lte($effectiveEnd)) {
                    if (!$tempDate->isSaturday() && !$tempDate->isSunday()) {
                        $offlineTotalWeekdays++;
                    }
                    $tempDate->addDay();
                }
            }

            $displayStart = $startDate->gt(Carbon::now()->startOfWeek()) ? $startDate : Carbon::now()->startOfWeek();
            for ($i = 0; $displayStart->copy()->addDays($i)->lte($effectiveEnd); $i++) {
                $date = $displayStart->copy()->addDays($i);
                if ($date->isSaturday() || $date->isSunday())
                    continue;

                $dateKey = $date->format('Y-m-d');
                $isPresent = isset($attendanceRecords[$dateKey]);

                if ($course->course_type === 'online' && $date->gte($startDate) && $date->lte($endDate)) {
                    $dayData = [
                        'present' => $isPresent,
                        'name' => $date->format('l'),
                        'date' => $dateKey,
                        'course_type' => 'online'
                    ];
                    $onlineWeekDays->push($dayData);
                    if ($isPresent)
                        $onlinePresentDays++;
                    if ($date->isThursday()) {
                        $onlineThursdayAttendance = $isPresent ? 'present' : 'absent';
                    }
                } elseif ($course->course_type !== 'online') {
                    $dayData = [
                        'present' => $isPresent,
                        'name' => $date->format('l'),
                        'date' => $dateKey,
                        'course_type' => 'offline'
                    ];
                    $offlineWeekDays->push($dayData);
                    if ($isPresent)
                        $offlinePresentDays++;
                    if ($date->isThursday()) {
                        $offlineThursdayAttendance = $isPresent ? 'present' : 'absent';
                    }
                }
            }
        }

        $onlineWeekDays = $onlineWeekDays->sortBy('date')->take(-5);
        $offlineWeekDays = $offlineWeekDays->sortBy('date')->take(-5);
        $showPercentage = ($onlineTotalWeekdays >= 7 || $offlineTotalWeekdays >= 7);

        $onlineAttendancePercentage = $onlineTotalWeekdays > 0 ?
            round(($onlinePresentDays / $onlineTotalWeekdays) * 100) : 0;
        $offlineAttendancePercentage = $offlineTotalWeekdays > 0 ?
            round(($offlinePresentDays / $offlineTotalWeekdays) * 100) : 0;

            return [
                'onlineWeekDays' => $onlineWeekDays,
                'offlineWeekDays' => $offlineWeekDays,
                'onlineAttendancePercentage' => $onlineAttendancePercentage,
                'offlineAttendancePercentage' => $offlineAttendancePercentage,
                'onlineThursdayAttendance' => $onlineThursdayAttendance,
                'offlineThursdayAttendance' => $offlineThursdayAttendance,
                'onlineTotalWeekdays' => $onlineTotalWeekdays, // Add these for combined calc
                'offlineTotalWeekdays' => $offlineTotalWeekdays,
                'onlinePresentDays' => $onlinePresentDays,
                'offlinePresentDays' => $offlinePresentDays,
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
            'onlineWeekDays' => $this->onlineWeekDays,
            'offlineWeekDays' => $this->offlineWeekDays,
            'onlineAttendancePercentage' => $this->onlineAttendancePercentage,
            'offlineAttendancePercentage' => $this->offlineAttendancePercentage,
            'onlineThursdayAttendance' => $this->onlineThursdayAttendance,
            'offlineThursdayAttendance' => $this->offlineThursdayAttendance,
            'showPercentage' => $this->loadAttendance()['showPercentage']
        ]);
    }
}