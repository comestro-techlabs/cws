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
        $today = Carbon::today();

        $course = $this->student->courses()->first();
        if (!$course) {
            session()->flash('error', 'No course found for this student.');
            return;
        }

        $courseStudent = $this->student->courses()->where('courses.id', $course->id)->first();
        $joinDate = $courseStudent->pivot->created_at ?? Carbon::now()->startOfMonth(); // Fallback to start of month

        $startDate = $joinDate->gt(Carbon::today()->startOfMonth()) ? $joinDate : Carbon::today()->startOfMonth();
        $endDate = Carbon::today(); // Use today as endDate to avoid processing future dates

        $this->attendances = Attendance::where('user_id', $this->studentId)
            ->whereBetween('check_in', [$startDate, $endDate->copy()->endOfDay()])
            ->orderBy('check_in', 'asc')
            ->get();

        $this->presentCount = 0;
        $this->absentCount = 0;
        $this->events = [];
        $this->todayStatus = 'Not Recorded'; // Default status for today

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

        // Process absent days, excluding today unless explicitly marked
        for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
            if ($date->isWeekend()) {
                continue; // Skip weekends
            }

            $currentDate = $date->copy()->startOfDay();
            $currentDateString = $currentDate->toDateString();

            // Skip today unless it has an explicit attendance record
            if ($currentDate->eq($today)) {
                continue;
            }

            $isPresent = in_array($currentDateString, $presentDays);

            if (!$isPresent) {
                $this->events[] = [
                    'title' => 'Absent',
                    'start' => $currentDateString,
                    'backgroundColor' => '#EF4444',
                    'borderColor' => '#EF4444',
                ];
                $this->absentCount++;
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