<?php

namespace App\Livewire\Admin\Assignment;

use Livewire\Component;
use App\Models\Assignment_upload;
use App\Models\Assignments;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Exception;

#[Layout('components.layouts.admin')]
#[Title('Manage Assignments')]
class ReviewWork extends Component
{
    public $assignmentId;
    public $grade = [];
    public $selectedFileId = null; // For previewing
    public $previewMimeType = null; // Store MIME type

    public function mount($id)
    {
        $this->assignmentId = $id;
    }

    public function insertGrade($studentId)
    {
        $this->validate([
            "grade.$studentId" => 'required|numeric|min:0|max:100',
        ]);

        $upload = Assignment_upload::where('assignment_id', $this->assignmentId)
            ->where('student_id', $studentId)
            ->first();

        if ($upload) {
            $upload->update([
                'grade' => $this->grade[$studentId],
                'status' => 'graded'
            ]);
        } else {
            Assignment_upload::create([
                'assignment_id' => $this->assignmentId,
                'student_id' => $studentId,
                'grade' => $this->grade[$studentId],
                'status' => 'graded',
                'submitted_at' => now(),
            ]);
        }
        $this->dispatch('notice', type: 'info', text: 'Added Grade successfully!');
    }

    public function previewFile($fileId)
    {
        $this->selectedFileId = $fileId;
    }

    public function closePreview()
    {
        $this->selectedFileId = null;
    }

    public function render()
    {
        $assignment = Assignments::with('uploads')->findOrFail($this->assignmentId);
        $students = Assignment_upload::where('assignment_id', $this->assignmentId)
            ->with('user')
            ->get()
            ->groupBy('student_id')
            ->map(function ($uploads) {
                return [
                    'name' => $uploads->first()->user->name,
                    'uploads' => $uploads,
                    'submitted_at' => $uploads->first()->submitted_at,
                    'file_ids' => $uploads->pluck('file_path')->toArray(),
                    'grade' => $uploads->first()->grade,
                ];
            });

        return view('livewire.admin.assignment.review-work', [
            'assignment' => $assignment,
            'students' => $students,
        ]);
    }
}
