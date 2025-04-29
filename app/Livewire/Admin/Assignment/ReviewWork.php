<?php

namespace App\Livewire\Admin\Assignment;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use App\Models\Assignment_upload;
use App\Models\User;
use App\Models\Assignments;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.admin')]
#[Title('Review Assignment')]
class ReviewWork extends Component
{
    public $assignmentId;
    public $grade = [];
    public $selectedFileId = null;
    public $students = [];
    public $currentStudent = null;
    public $currentStudentIndex = 0;
    public $hasPreviousStudent = false;
    public $hasNextStudent = false;
    public $assignment;
    public $activeTab = 'review'; // 'review' or 'all-submissions'
    public $allStudents = [];

    public function mount($id)
    {
        $this->assignmentId = $id;
        $this->assignment = Assignments::with(['course', 'batch'])->findOrFail($id);
        
        // Load students with their submissions
        $this->loadStudents();
        $this->loadAllStudents();
        
        // Set initial student if we have submissions
        if (!empty($this->students)) {
            $this->loadCurrentStudent();
        }
    }

    private function loadStudents()
    {
        $uploads = Assignment_upload::where('assignment_id', $this->assignmentId)
            ->with('user')
            ->get()
            ->groupBy('student_id');

        $this->students = $uploads->map(function ($studentUploads) {
            $latestUpload = $studentUploads->first();
            return [
                'id' => $latestUpload->student_id,
                'name' => $latestUpload->user->name,
                'submitted_at' => $latestUpload->submitted_at,
                'uploads' => $studentUploads,
                'grade' => $latestUpload->grade
            ];
        })->toArray();
    }

    private function loadAllStudents()
    {
        // Get all students from the course/batch
        $courseStudents = User::whereHas('courses', function($query) {
            $query->where('course_id', $this->assignment->course_id)
                  ->where('batch_id', $this->assignment->batch_id);
        })->get();

        $this->allStudents = $courseStudents->map(function($student) {
            $submission = Assignment_upload::where('assignment_id', $this->assignmentId)
                ->where('student_id', $student->id)
                ->latest()
                ->first();

            return [
                'id' => $student->id,
                'name' => $student->name,
                'submitted' => $submission ? true : false,
                'submitted_at' => $submission?->submitted_at,
                'grade' => $submission?->grade,
                'status' => $submission ? $this->getSubmissionStatus($submission) : 'not_submitted'
            ];
        })->toArray();
    }

    public function loadCurrentStudent()
    {
        $studentIds = array_keys($this->students);
        if (isset($studentIds[$this->currentStudentIndex])) {
            $this->currentStudent = $this->students[$studentIds[$this->currentStudentIndex]];
            $this->hasPreviousStudent = $this->currentStudentIndex > 0;
            $this->hasNextStudent = $this->currentStudentIndex < (count($this->students) - 1);
            
            // Pre-fill grade if exists
            if (isset($this->currentStudent['grade'])) {
                $this->grade[$this->currentStudent['id']] = $this->currentStudent['grade'];
            }
        }
    }

    public function nextStudent()
    {
        $this->dispatch('loading');
        if ($this->hasNextStudent) {
            $this->currentStudentIndex++;
            $this->loadCurrentStudent();
        }
    }

    public function previousStudent()
    {
        $this->dispatch('loading');
        if ($this->hasPreviousStudent) {
            $this->currentStudentIndex--;
            $this->loadCurrentStudent();
        }
    }

    private function calculateGrade($submittedAt, $grade)
    {
        if ($this->assignment->due_date && $submittedAt > $this->assignment->due_date) {
            return max(0, $grade - 10); // Apply 10 marks penalty but don't go below 0
        }
        return $grade;
    }

    public function insertGrade($studentId)
    {
        $this->dispatch('loading'); // Show loader
        $this->validate([
            "grade.$studentId" => 'required|numeric|min:0|max:100'
        ]);

        $upload = Assignment_upload::where('assignment_id', $this->assignmentId)
            ->where('student_id', $studentId)
            ->latest()
            ->first();

        if ($upload) {
            $finalGrade = $this->calculateGrade($upload->submitted_at, $this->grade[$studentId]);
            $upload->update([
                'grade' => $finalGrade,
                'status' => 'graded'
            ]);

            if ($finalGrade < $this->grade[$studentId]) {
                $this->dispatch('notify', [
                    'message' => 'Grade saved with late submission penalty (-10 marks)',
                    'type' => 'warning'
                ]);
            } else {
                $this->dispatch('notify', [
                    'message' => 'Grade saved successfully!'
                ]);
            }

            // Auto advance to next student if available
            if ($this->hasNextStudent) {
                $this->nextStudent();
            } else {
                return redirect()->route('admin.assignment.manage');
            }
        }
    }
    public function previewFile($filePath)
    {
        $this->dispatch('loading'); // Show loader
        $this->selectedFileId = $filePath ? Storage::disk('s3')->url($filePath) : null;
    }
    public function closePreview()
    {
        $this->selectedFileId = null;
    }

    public function switchTab($tab)
    {
        $this->activeTab = $tab;
    }

    private function getSubmissionStatus($submission)
    {
        if (!$submission->submitted_at) {
            return 'not_submitted';
        }

        if ($this->assignment->due_date && $submission->submitted_at > $this->assignment->due_date) {
            return 'late';
        }

        if ($submission->grade) {
            return 'graded';
        }

        return 'submitted';
    }

    public function render()
    {
        return view('livewire.admin.assignment.review-work',[
            'selectedFileUrl' => $this->selectedFileId,
        ]);
    }
}
