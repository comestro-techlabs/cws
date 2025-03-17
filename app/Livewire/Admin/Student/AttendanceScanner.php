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

        $student = User::where('barcode', $this->barcode)
            ->with(['courses.batches'])
            ->first();

        if (!$student) {
            $this->message = 'Student not found';
            return;
        }

        // Check if student has any courses
        if ($student->courses->isEmpty()) {
            $this->message = 'This student is not enrolled in any course';
            return;
        }

        // If student has multiple courses, show course selection
        if ($student->courses->count() > 1) {
            $this->pendingStudent = $student;
            $this->studentCourses = $student->courses;
            $this->showCourseSelection = true;
            $this->message = 'Please select course and batch';
            return;
        }

        // Get first course
        $firstCourse = $student->courses->first();

        // Check if course has any batches
        if (!$firstCourse->batches || $firstCourse->batches->isEmpty()) {
            $this->message = 'No batch assigned to this student. Please assign a batch first.';
            return;
        }

        // If student has only one course and batch
        $this->markAttendance($student, $firstCourse->id, $firstCourse->batches->first()->id);
    }

    public function selectCourseAndBatch()
    {
        $this->validate([
            'selectedStudentCourse' => 'required',
            'selectedStudentBatch' => 'required'
        ]);

        $this->markAttendance(
            $this->pendingStudent, 
            $this->selectedStudentCourse, 
            $this->selectedStudentBatch
        );

        $this->resetCourseSelection();
    }

    public function cancelSelection()
    {
        $this->resetCourseSelection();
    }

    private function resetCourseSelection()
    {
        $this->showCourseSelection = false;
        $this->pendingStudent = null;
        $this->studentCourses = [];
        $this->studentBatches = [];
        $this->selectedStudentCourse = null;
        $this->selectedStudentBatch = null;
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
        if ($courseId && $this->pendingStudent) {
            $course = $this->pendingStudent->courses->find($courseId);
            $this->studentBatches = $course ? $course->batches : collect();
            $this->selectedStudentBatch = null;
        }
    }
}
