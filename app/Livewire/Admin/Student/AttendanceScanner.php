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
    public $showViewModal = false;
    public $viewCourse;
    public $viewBatch;
    public $viewStudents = [];
    public $availableBatches = [];

    public function mount()
    {
        $this->refreshAttendance();
    }

    public function render()
    {
        return view('livewire.admin.student.attendance-scanner', [
            'courses' => Course::where('course_type', 'offline')->get(),
            'batches' => $this->getBatches(),
            'todayStats' => $this->getTodayStats(),
            'todayAttendance' => $this->getTodayAttendance(),
            'undoAttendance' => $this->getTodayAttendance(),
        ]);
    }

    public function view()
    {
        $this->showViewModal = true;
        $this->viewCourse = '';
        $this->viewBatch = '';
        $this->viewStudents = [];
        $this->availableBatches = [];
        $this->message = null;
    }

    public function updatedViewCourse($courseId)
    {
        $this->viewBatch = '';
        $this->viewStudents = [];
        if ($courseId) {
            $this->availableBatches = Batch::where('course_id', $courseId)
                ->where(function ($q) {
                    $q->whereNull('end_date')
                      ->orWhere('end_date', '>=', Carbon::today());
                })
                ->get();
            
            if ($this->availableBatches->isEmpty()) {
                $this->message = 'No active batches found for the selected course.';
            } else {
                $this->message = null;
            }
        } else {
            $this->availableBatches = [];
            $this->message = 'Please select a course.';
        }
    }

    public function loadStudents()
    {
        $this->validate([
            'viewCourse' => 'required',
            'viewBatch' => 'required',
        ]);

        $batch = Batch::where('id', $this->viewBatch)
            ->where('course_id', $this->viewCourse)
            ->where(function ($q) {
                $q->whereNull('end_date')
                  ->orWhere('end_date', '>=', Carbon::today());
            })->first();

        if (!$batch) {
            $this->message = 'Selected batch not found or has ended.';
            $this->viewStudents = [];
            return;
        }

        $this->viewStudents = User::whereHas('batches', function ($query) {
            $query->where('batches.id', $this->viewBatch);
        })->whereHas('courses', function ($query) {
            $query->where('courses.id', $this->viewCourse);
        })->where('barcode','!=','')->get();

        if ($this->viewStudents->isEmpty()) {
            $this->message = 'No students found for this course and batch.';
        } else {
            $this->message = null;
        }

        $this->showViewModal = false;
    }

    public function deleteAttendance($studentId)
    {
        $this->validate([
            'viewCourse' => 'required',
            'viewBatch' => 'required',
        ]);
    
        $batch = Batch::where('id', $this->viewBatch)
            ->where('course_id', $this->viewCourse)
            ->where(function ($q) {
                $q->whereNull('end_date')
                  ->orWhere('end_date', '>=', Carbon::today());
            })->first();
    
        if (!$batch) {
            $this->message = 'Selected batch not found or has ended.';
            return;
        }
    
        // Delete attendance for the specific student
        Attendance::where('course_id', $this->viewCourse)
            ->where('batch_id', $this->viewBatch)
            ->where('user_id', $studentId)
            ->whereDate('check_in', Carbon::today())
            ->delete();
    
        $this->message = 'Attendance for the student has been undone successfully.';
    }
    public function markAttendanceByBarcode($studentId)
    {
        try {
            // Find the student
            $student = User::where('id', $studentId)
                ->whereHas('courses', function ($query) {
                    $query->where('courses.id', $this->viewCourse);
                })
                ->whereHas('batches', function ($query) {
                    $query->where('batches.id', $this->viewBatch);
                })
                ->first();

            if (!$student) {
                $this->message = 'Student not found or not enrolled in this course/batch.';
                return;
            }

            // Check if attendance is already marked for today
            $existingAttendance = Attendance::where('user_id', $student->id)
                ->whereDate('check_in', Carbon::today())
                ->where('course_id', $this->viewCourse)
                ->where('batch_id', $this->viewBatch)
                ->exists();

            if ($existingAttendance) {
                $this->message = 'Attendance already marked for ' . $student->name . ' today.';
                return;
            }

            // Verify the course is offline
            $course = Course::find($this->viewCourse);
            if (!$course || $course->course_type !== 'offline') {
                $this->message = 'Attendance can only be marked for offline courses.';
                return;
            }

            // Mark attendance
            Attendance::create([
                'user_id' => $student->id,
                'course_id' => $this->viewCourse,
                'batch_id' => $this->viewBatch,
                'check_in' => now(),
                
            ]);

            $this->message = 'Attendance marked successfully for ' . $student->name . '.';
            $this->student = $student; // Display student details
            $this->refreshAttendance();

        } catch (\Exception $e) {
            \Log::error('Attendance Error: ' . $e->getMessage());
            $this->message = 'Failed to mark attendance. Please try again.';
        }
    }

    public function getBatches()
    {
        if ($this->selectedCourse) {
            return Batch::where('course_id', $this->selectedCourse)
                        ->where(function ($q) {
                            $q->whereNull('end_date')
                              ->orWhere('end_date', '>=', Carbon::today());
                        })->get();
        }
        return Batch::where(function ($q) {
            $q->whereNull('end_date')
              ->orWhere('end_date', '>=', Carbon::today());
        })->get();
    }

    public function getTodayStats()
    {
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
            ->with(['courses' => function($q) {
                $q->where('course_type', 'offline');
            }, 'batches'])
            ->first();

        if (!$this->pendingStudent) {
            $this->message = 'Student not found';
            return;
        }

        if ($this->pendingStudent->courses->isEmpty()) {
            $this->message = 'Student is not enrolled in any offline course';
            return;
        }

        $this->studentCourses = $this->pendingStudent->courses;

        // If there's only one course, auto-select it
        if ($this->studentCourses->count() === 1) {
            $this->selectedStudentCourse = $this->studentCourses->first()->id;
            $this->updatedSelectedStudentCourse($this->selectedStudentCourse);
        } else {
            $this->selectedStudentCourse = '';
            $this->studentBatches = collect();
            $this->selectedStudentBatch = '';
        }

        // Check if attendance is already marked for today if both course and batch are selected
        if ($this->selectedStudentCourse && $this->selectedStudentBatch) {
            $existingAttendance = Attendance::where('user_id', $this->pendingStudent->id)
                ->whereDate('check_in', today())
                ->where('course_id', $this->selectedStudentCourse)
                ->where('batch_id', $this->selectedStudentBatch)
                ->exists();

            if ($existingAttendance) {
                $this->message = 'Attendance already marked for today';
                $this->resetSelections();
                return;
            }
        }

        $this->showCourseSelection = true;
        $this->message = $this->selectedStudentCourse && $this->selectedStudentBatch 
            ? 'Ready to mark attendance'
            : 'Please select course and batch';
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
                ->where('course_id', $this->selectedStudentCourse)
                ->where('batch_id', $this->selectedStudentBatch)
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

    public function updatedSelectedStudentCourse($courseId)
    {
        if (!$courseId || !$this->pendingStudent) {
            $this->studentBatches = collect();
            $this->selectedStudentBatch = '';
            return;
        }

        $this->studentBatches = Batch::whereHas('course', function($query) use ($courseId) {
            $query->where('id', $courseId);
        })->whereHas('users', function($query) {
            $query->where('users.id', $this->pendingStudent->id);
        })->where(function ($q) {
            $q->whereNull('end_date')
              ->orWhere('end_date', '>=', Carbon::today());
        })->get();

        // Auto-select if only one batch
        if ($this->studentBatches->count() === 1) {
            $this->selectedStudentBatch = $this->studentBatches->first()->id;
            $this->message = 'Batch auto-selected';
        } else {
            $this->selectedStudentBatch = '';
            $this->message = 'Please select a batch';
        }
    }
}