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
    public $showCourseSelection = false;
    public $studentCourses = [];
    public $studentBatches = [];
    public $selectedStudentCourse;
    public $selectedStudentBatch;
    public $pendingStudent;
    
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
        // Fix the query to use proper relationships
        $query = User::query()
            ->whereHas('courses', function($q) {
                if ($this->selectedCourse) {
                    $q->where('courses.id', $this->selectedCourse);
                }
            })
            ->when($this->selectedBatch, function($q) {
                $q->whereHas('batches', function($batchQuery) {
                    $batchQuery->where('batches.id', $this->selectedBatch);
                });
            });

        $total = $query->count();
        $present = Attendance::whereDate('created_at', today())
            ->whereIn('user_id', $query->pluck('users.id'))
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
        return Attendance::with(['user.courses', 'user.batches'])
            ->whereDate('created_at', today())
            ->when($this->selectedCourse || $this->selectedBatch, function($query) {
                $query->whereHas('user', function($q) {
                    if ($this->selectedCourse) {
                        $q->whereHas('courses', function($cq) {
                            $cq->where('courses.id', $this->selectedCourse);
                        });
                    }
                    if ($this->selectedBatch) {
                        $q->whereHas('batches', function($bq) {
                            $bq->where('batches.id', $this->selectedBatch);
                        });
                    }
                });
            })
            ->latest()
            ->get();
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

        $this->pendingStudent = User::where('barcode', $this->barcode)
            ->with(['courses', 'batches'])
            ->first();

        if (!$this->pendingStudent) {
            $this->message = 'Student not found';
            return;
        }

        // Check if student has courses
        if ($this->pendingStudent->courses->isEmpty()) {
            $this->message = 'Student is not enrolled in any course';
            return;
        }

        // Check for existing attendance
        $existingAttendance = Attendance::where('user_id', $this->pendingStudent->id)
            ->whereDate('check_in', today())
            ->exists();

        if ($existingAttendance) {
            $this->message = 'Attendance already marked for today';
            return;
        }

        $this->studentCourses = $this->pendingStudent->courses;
        $this->showCourseSelection = true;
        $this->message = 'Please select course and batch';
    }

    public function selectCourseAndBatch()
    {
        try {
            $this->validate([
                'selectedStudentCourse' => 'required',
                'selectedStudentBatch' => 'required'
            ]);

            // Check for existing attendance
            $existingAttendance = Attendance::where('user_id', $this->pendingStudent->id)
                ->whereDate('check_in', Carbon::today())
                ->exists();

            if ($existingAttendance) {
                $this->message = 'Attendance already marked for today';
                $this->resetSelections();
                return;
            }

            // Create new attendance record
            $attendance = new Attendance();
            $attendance->user_id = $this->pendingStudent->id;
            $attendance->course_id = $this->selectedStudentCourse;
            $attendance->batch_id = $this->selectedStudentBatch;
            $attendance->check_in = now();
            $attendance->save();

            // Update display
            $this->student = User::with(['courses', 'batches'])->find($this->pendingStudent->id);
            $this->message = 'Attendance marked successfully';
            
            // Reset and refresh
            $this->resetSelections();
            $this->refreshAttendance();

        } catch (\Exception $e) {
            \Log::error('Attendance Error: ' . $e->getMessage());
            $this->message = 'Failed to mark attendance. Please try again.';
        }
    }

    public function cancelSelection()
    {
        $this->resetSelections();
    }

    private function resetSelections()
    {
        $this->showCourseSelection = false;
        $this->pendingStudent = null;
        $this->studentCourses = collect();
        $this->studentBatches = collect();
        $this->selectedStudentCourse = null;
        $this->selectedStudentBatch = null;
        $this->barcode = '';
    }

    private function markAttendance($student, $courseId, $batchId)
    {
        // Create attendance record
        Attendance::create([
            'user_id' => $student->id,
            'check_in' => now(),
            'course_id' => $courseId,
            'batch_id' => $batchId
        ]);

        $this->student = $student;
        $this->message = 'Attendance marked successfully';
        $this->barcode = '';
        $this->refreshAttendance();
    }

    public function updatedSelectedStudentCourse($courseId)
    {
        if (!$courseId || !$this->pendingStudent) {
            $this->studentBatches = collect();
            $this->selectedStudentBatch = '';
            return;
        }

        // Get batches for selected course where student is enrolled
        $this->studentBatches = Batch::whereHas('course', function($query) use ($courseId) {
            $query->where('id', $courseId);
        })->whereHas('users', function($query) {
            $query->where('users.id', $this->pendingStudent->id);
        })->get();

        $this->selectedStudentBatch = '';
    }
}
