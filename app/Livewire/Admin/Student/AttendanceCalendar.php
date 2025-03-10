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


    public function mount($studentId)
    {
        $this->studentId = $studentId;
        $this->loadAttendance();
    }

    public function loadAttendance()
    {
        $student = User::find($this->studentId);
        if ($student) {
            $attendance = Attendance::where('user_id', $student->id)
                ->orderBy('check_in', 'asc')
                ->get();

            // Add present days
            foreach ($attendance as $record) {
                $this->events[] = [
                    'title' => 'Present',
                    'start' => $record->check_in->toDateString(), // Format: YYYY-MM-DD
                    'color' => '#10B981', // Green for present
                ];
                $this->presentCount++;
            }

            $startDate = Carbon::now()->startOfMonth();
            $endDate = Carbon::now();
            for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
                if ($date->isWeekend()) {
                    continue;
                }

                // Check if the student was present on this date
                $isPresent = $attendance->contains(function ($record) use ($date) {
                    return $record->check_in->isSameDay($date);
                });

                // If not present, mark as absent
                if (!$isPresent) {
                    $this->events[] = [
                        'title' => 'Absent',
                        'start' => $date->toDateString(), // Format: YYYY-MM-DD
                        'color' => '#EF4444', // Red for absent
                    ];
                    $this->absentCount++;                    
                }
            }
        }
    }

    public function render()
    {
        return view('livewire.admin.student.attendance-calendar');
    }
}