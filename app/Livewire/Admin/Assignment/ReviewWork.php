<?php

namespace App\Livewire\Admin\Assignment;

use Livewire\Component;
use App\Models\Assignment_upload;
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

    public function mount($id)
    {
        $this->assignmentId = $id;
        $this->assignment = Assignments::findOrFail($id);
        
        // Load students with their submissions
        $this->loadStudents();
        
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
        if ($this->hasNextStudent) {
            $this->currentStudentIndex++;
            $this->loadCurrentStudent();
        }
    }

    public function previousStudent()
    {
        if ($this->hasPreviousStudent) {
            $this->currentStudentIndex--;
            $this->loadCurrentStudent();
        }
    }

    public function insertGrade($studentId)
    {
        $this->validate([
            "grade.$studentId" => 'required|numeric|min:0|max:100'
        ]);

        $upload = Assignment_upload::where('assignment_id', $this->assignmentId)
            ->where('student_id', $studentId)
            ->latest()
            ->first();

        if ($upload) {
            $upload->update([
                'grade' => $this->grade[$studentId],
                'status' => 'graded'
            ]);

            $this->loadStudents();
            $this->loadCurrentStudent();
            
            $this->dispatch('notify', [
                'message' => 'Grade updated successfully!'
            ]);
        }
    }

    public function previewFile($fileId)
    {
        $this->selectedFileId = $fileId;
    }

    public function render()
    {
        return view('livewire.admin.assignment.review-work');
    }
}
