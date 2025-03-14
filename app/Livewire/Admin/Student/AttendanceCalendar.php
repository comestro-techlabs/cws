<?php
namespace App\Livewire\Admin\Student;

use App\Models\Attendance;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Illuminate\Support\Facades\Mail;

#[Layout('components.layouts.admin')]
#[Title('Attendance Students')]
class AttendanceCalendar extends Component
{
    public $studentId;
    public $events = [];
    public $presentCount = 0;
    public $absentCount = 0;
    public $todayStatus = null;
    public $student;

    public function mount($studentId)
    {
        $this->studentId = $studentId;
        $this->student = User::find($this->studentId);
        if (!$this->student) {
            session()->flash('error', 'Student not found.');
            return;
        }
        $this->loadAttendance();
    }

    public function loadAttendance()
    {
        $joinDate = Carbon::parse($this->student->created_at)->startOfDay();
        $today = Carbon::today();
        $startDate = $joinDate->gt(Carbon::now()->startOfMonth()) ? $joinDate : Carbon::now()->startOfMonth();
        $endDate = Carbon::now();

        $attendance = Attendance::where('user_id', $this->student->id)
            ->whereBetween('check_in', [$startDate, $endDate])
            ->orderBy('check_in', 'asc')
            ->get();

        $this->presentCount = 0;
        $this->absentCount = 0;
        $this->events = [];

        foreach ($attendance as $record) {
            $checkInDate = Carbon::parse($record->check_in)->startOfDay();
            $this->events[] = [
                'title' => 'Present',
                'start' => $checkInDate->toDateString(),
                'color' => '#10B981',
            ];
            if (!$checkInDate->isWeekend()) {
                $this->presentCount++;
            }

            if ($checkInDate->eq($today)) {
                $this->todayStatus = 'Present';
            }
        }

        for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
            if ($date->isWeekend()) {
                continue;
            }
            $currentDate = $date->copy()->startOfDay();

            $isPresent = $attendance->contains(function ($record) use ($currentDate) {
                return Carbon::parse($record->check_in)->startOfDay()->eq($currentDate);
            });

            if (!$isPresent) {
                $this->events[] = [
                    'title' => 'Absent',
                    'start' => $currentDate->toDateString(),
                    'color' => '#EF4444',
                ];
                $this->absentCount++;

                if ($currentDate->eq($today)) {
                    $this->todayStatus = 'Absent';
                }
            }
        }
    }

    public function sendEmail($date, $message)
    {
        if (!$this->student || !$this->student->email) {
            session()->flash('error', 'Student not found or no email available.');
            return;
        }

        try {
            Mail::html($message, function ($mail) use ($date) { // Use Mail::html for rich text
                $mail->to($this->student->email)
                     ->subject("Attendance Message for $date")
                     ->from('admin@yourdomain.com', 'Admin');
            });
            session()->flash('message', "Email sent successfully to {$this->student->email} for $date.");
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to send email: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.student.attendance-calendar', [
            'events' => $this->events,
            'presentCount' => $this->presentCount,
            'absentCount' => $this->absentCount,
            'todayStatus' => $this->todayStatus,
            'student' => $this->student,
        ]);
    }
}