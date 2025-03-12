<?php
namespace App\Livewire\Admin\Student;

use App\Models\Attendance;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
#[Title('Attendance Students')]
class AttendanceCalendar extends Component
{
    public $studentId;
    public $events = [];
    public $presentCount = 0;
    public $absentCount = 0;
    public $todayStatus = null; // Explicitly track today's status

    public function mount($studentId)
    {
        $this->studentId = $studentId;
        $this->loadAttendance();
    }

    public function loadAttendance()
    {
        $student = User::find($this->studentId);
        if (!$student) {
            return; // Exit if student not found
        }

        // Define date range
        $startDate = Carbon::now()->startOfMonth();
        $today = Carbon::today(); // Consistent date-only for today
        $endDate = Carbon::now(); // Up to today

        // Fetch attendance records
        $attendance = Attendance::where('user_id', $student->id)
            ->whereBetween('check_in', [$startDate, $endDate])
            ->orderBy('check_in', 'asc')
            ->get();

        // Reset counts and events
        $this->presentCount = 0;
        $this->absentCount = 0;
        $this->events = [];

        // Add present days
        foreach ($attendance as $record) {
            $checkInDate = Carbon::parse($record->check_in)->startOfDay();
            $this->events[] = [
                'title' => 'Present',
                'start' => $checkInDate->toDateString(),
                'color' => '#10B981', // Green for present
            ];
            if (!$checkInDate->isWeekend()) {
                $this->presentCount++;
            }

            // Set today’s status if this is today
            if ($checkInDate->eq($today)) {
                $this->todayStatus = 'Present';
            }
        }

        // Check weekdays for absences, up to today
        for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
            if ($date->isWeekend()) {
                continue; // Skip weekends
            }

            $currentDate = $date->copy()->startOfDay();

            // Check if present on this date
            $isPresent = $attendance->contains(function ($record) use ($currentDate) {
                return Carbon::parse($record->check_in)->startOfDay()->eq($currentDate);
            });

            // If not present, mark as absent
            if (!$isPresent) {
                $this->events[] = [
                    'title' => 'Absent',
                    'start' => $currentDate->toDateString(),
                    'color' => '#EF4444', // Red for absent
                ];
                $this->absentCount++;

                // Set today’s status if this is today
                if ($currentDate->eq($today)) {
                    $this->todayStatus = 'Absent';
                }
            }
        }
    }

    public function render()
    {
        return view('livewire.admin.student.attendance-calendar', [
            'events' => $this->events,
            'presentCount' => $this->presentCount,
            'absentCount' => $this->absentCount,
            'todayStatus' => $this->todayStatus,
        ]);
    }
}