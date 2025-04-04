<?php
namespace App\Livewire\Student;

use App\Models\Attendance;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

#[Layout('components.layouts.student')]
class MyAttendance extends Component
{
    public $attendances;
    public $studentId;
    public $events = [];
    public $presentCount = 0;
    public $absentCount = 0;
    public $todayStatus = 'Not Recorded';
    public $student;

    public function mount()
    {
        $this->studentId = Auth::id();
        $this->student = User::find($this->studentId);
        if (!$this->student) {
            session()->flash('error', 'Student not found.');
            return;
        }
        $this->loadAttendance();
    }

    public function loadAttendance()
    {
        $today = Carbon::today();

        $course = $this->student->courses()->first();
        if (!$course) {
            session()->flash('error', 'No course found for this student.');
            return;
        }

        $courseStudent = $this->student->courses()->where('courses.id', $course->id)->first();
        $joinDate = $courseStudent->pivot->created_at ?? Carbon::now()->startOfMonth(); // Fallback to start of month

        $startDate = $joinDate->gt(Carbon::today()->startOfMonth()) ? $joinDate : Carbon::today()->startOfMonth();
        $endDate = Carbon::now();

        $this->attendances = Attendance::where('user_id', $this->studentId)
            ->whereBetween('check_in', [$startDate, $endDate])
            ->orderBy('check_in', 'asc')
            ->get();

        $this->presentCount = 0;
        $this->absentCount = 0;
        $this->events = [];

        $presentDays = [];
        foreach ($this->attendances as $record) {
            $checkInDate = Carbon::parse($record->check_in)->startOfDay()->toDateString();
            if (!in_array($checkInDate, $presentDays)) {
                $presentDays[] = $checkInDate;
                $this->events[] = [
                    'title' => 'Present',
                    'start' => $checkInDate,
                    'backgroundColor' => '#10B981',
                    'borderColor' => '#10B981',
                ];
                if (!Carbon::parse($checkInDate)->isWeekend()) {
                    $this->presentCount++;
                }
                if (Carbon::parse($checkInDate)->eq($today)) {
                    $this->todayStatus = 'Present';
                }
            }
        }

        for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
            if ($date->isWeekend()) {
                continue; 
            }

            if ($date->gt($today)) {
                continue; // Skip future dates
            }

            $currentDate = $date->copy()->startOfDay();
            $currentDateString = $currentDate->toDateString();

            $isPresent = in_array($currentDateString, $presentDays);

            if (!$isPresent) {
                $this->events[] = [
                    'title' => 'Absent',
                    'start' => $currentDateString,
                    'backgroundColor' => '#EF4444',
                    'borderColor' => '#EF4444',
                ];
                $this->absentCount++;
                if ($currentDate->eq($today)) {
                    $this->todayStatus = 'Absent';
                }
            }
        }
    }

    public function render()
    {
        return view('livewire.student.my-attendance', [
            'events' => $this->events,
            'presentCount' => $this->presentCount,
            'absentCount' => $this->absentCount,
            'todayStatus' => $this->todayStatus,
        ]);
    }
}