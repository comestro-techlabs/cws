<?php

namespace App\Livewire\Admin\Student;

use App\Models\Course;
use App\Models\Batch;
use App\Models\Attendance;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
#[Title('Attendance Students')]
class AttendanceScanner extends Component
{
    public $barcode;
    public $message;
    public $student;
    public $selectedCourse = '';
    public $selectedBatch = '';
    
    public function mount()
    {
        $this->refreshAttendance();
    }

    public function render()
    {
        return view('livewire.admin.student.attendance-scanner', [
            'courses' => Course::all(),
            'batches' => $this->getBatches(),
            'todayStats' => $this->getTodayStats(),
            'todayAttendance' => $this->getTodayAttendance()
        ]);
    }

    public function getBatches()
    {
        if ($this->selectedCourse) {
            return Batch::where('course_id', $this->selectedCourse)->get();
        }
        return Batch::all();
    }

    public function getTodayStats()
    {
        $query = User::query();
        if ($this->selectedCourse) {
            $query->where('course_id', $this->selectedCourse);
        }
        if ($this->selectedBatch) {
            $query->where('batch_id', $this->selectedBatch);
        }

        $total = $query->count();
        $present = Attendance::whereDate('created_at', today())
            ->whereIn('user_id', $query->pluck('id'))
            ->distinct('user_id')
            ->count();

        return [
            'total' => $total,
            'present' => $present,
            'absent' => $total - $present
        ];
    }

    public function getTodayAttendance()
    {
        $query = Attendance::with(['student.course', 'student.batch'])
            ->whereDate('created_at', today());

        if ($this->selectedCourse || $this->selectedBatch) {
            $query->whereHas('student', function ($q) {
                if ($this->selectedCourse) {
                    $q->where('course_id', $this->selectedCourse);
                }
                if ($this->selectedBatch) {
                    $q->where('batch_id', $this->selectedBatch);
                }
            });
        }

        return $query->latest()->get();
    }

    public function refreshAttendance()
    {
        $this->dispatch('refresh');
    }

    public function scanBarcode()
    {
        if (empty($this->barcode)) {
            $this->message = 'Please scan a barcode';
            return;
        }

        $student = User::where('barcode', $this->barcode)->first();

        if (!$student) {
            $this->message = 'Student not found';
            return;
        }

        // Check if student belongs to selected course/batch
        if ($this->selectedCourse && $student->course_id != $this->selectedCourse) {
            $this->message = 'Student does not belong to selected course';
            return;
        }

        if ($this->selectedBatch && $student->batch_id != $this->selectedBatch) {
            $this->message = 'Student does not belong to selected batch';
            return;
        }

        // Create attendance record
        Attendance::create([
            'user_id' => $student->id,
            'date' => today(),
            'status' => 'present'
        ]);

        $this->student = $student;
        $this->message = 'Attendance marked successfully';
        $this->barcode = '';
        $this->refreshAttendance();
    }
}
