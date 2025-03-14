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
    public $todayStatus = 'Not Recorded'; // Default status
    public $student;

    public function mount()
    {
        $this->studentId = Auth::id();
        $this->student = User::find($this->studentId);
        if(!$this->student){ 
            session()->flash('error', 'Student not found.');
        }
        $this->loadAttendance();
    }

    public function loadAttendance()
    {
        // Define date range
        $joinDate = Carbon::parse($this->student->created_at)->startOfday();
        $today = Carbon::today();
        $startDate = $joinDate->gt(Carbon::today()->startOfMonth())? $joinDate : Carbon::now()->startOfMonth(); 
        $endDate = Carbon::now();

        // Fetch attendance records for the current month
        $this->attendances = Attendance::where('user_id', $this->studentId)
            ->whereBetween('check_in', [$startDate, $endDate])
            ->orderBy('check_in', 'asc')
            ->get();

        // Reset counts and events
        $this->presentCount = 0;
        $this->absentCount = 0;
        $this->events = [];

        // Add present days
        foreach ($this->attendances as $record) {
            $checkInDate = Carbon::parse($record->check_in)->startOfDay();
            $this->events[] = [
                'title' => 'Present',
                'start' => $checkInDate->toDateString(),
                'backgroundColor' => '#10B981',
                'borderColor' => '#10B981',
            ];
            if (!$checkInDate->isWeekend()) {
                $this->presentCount++;
            }
            // Set today’s status if this is today
            if ($checkInDate->eq($today)) {
                $this->todayStatus = 'Present';
            }
        }

        // Check each weekday for absences, up to today
        for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
            if ($date->isWeekend()) {
                continue; // Skip weekends
            }

            if ($date->gt($today)) {
                continue; // Skip future dates
            }

            $currentDate = $date->copy()->startOfDay();

            // Check if present on this date
            $isPresent = $this->attendances->contains(function ($record) use ($currentDate) {
                $recordDate = Carbon::parse($record->check_in)->startOfDay();
                return $recordDate->eq($currentDate);
            });

            // If not present, mark as absent
            if (!$isPresent) {
                $this->events[] = [
                    'title' => 'Absent',
                    'start' => $currentDate->toDateString(),
                    'backgroundColor' => '#EF4444',
                    'borderColor' => '#EF4444',
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
        return view('livewire.student.my-attendance', [
            'events' => $this->events,
            'presentCount' => $this->presentCount,
            'absentCount' => $this->absentCount,
            'todayStatus' => $this->todayStatus,
        ]);
    }
}