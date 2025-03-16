<?php

namespace App\Livewire\Admin\Assignment;

use App\Jobs\SendNewAssignmentNotification;
use Livewire\Component;
use App\Models\Assignments;
use App\Models\Assignment_upload;  // Add this import
use App\Models\Batch;
use App\Models\Course;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.admin')]
#[Title('Manage Assignments')]
class ManageAssignment extends Component
{
    public $course_id = '';
    public $search = '';
    public $perPage = 10;
    
    // New properties for assignment creation/editing
    public $showModal = false;
    public $title;
    public $description;
    public $batch_id;
    public $due_date;
    public $status = false;
    public $editingAssignment = null;
    public $batches = [];
    public $viewMode = 'list'; // list, create, review
    public $selectedAssignment = null;
    public $submissions = [];
    public $grade = [];
    public $selectedFileId = null;
    public $viewSubmissions = false;
    public $currentAssignment;
    public $studentSubmissions = [];

    protected $paginationTheme = 'tailwind';
    public function render()
    {
        $assignments = Assignments::when($this->course_id, fn ($query) => 
            $query->where('course_id', $this->course_id)
        )->when($this->search, fn ($query) => 
            $query->where('title', 'like', '%' . $this->search . '%')
        )->with(['course', 'batch', 'uploads.user'])->paginate($this->perPage);

        return view('livewire.admin.assignment.manage-assignment', [
            'assignments' => $assignments,
            'courses' => Course::all(),
            'batches' => $this->batches,
        ]);
    }

    public function toggleStatus($assignmentId)
    {
        $assignment = Assignments::findOrFail($assignmentId);        
        $assignment->update(['status' => !$assignment->status]);

        if ($assignment->status) {
            // dd('shaiquw');
            $this->notifyStudents($assignment);
            // $this->notifyStudents();

        }

        session()->flash('success', 'Assignment status updated successfully!');
    }

    public function delete($assignmentId)
    {
        try {
            Assignments::destroy($assignmentId);
            session()->flash('success', 'Assignment deleted successfully!');
        }
        catch (\Exception $e) {
            session()->flash('error', 'Failed to delete assignment!');
        }
    }

    public function clearFilter()
    {
        $this->course_id = '';
        $this->search = '';
    }

    private function notifyStudents(Assignments $assignment)
    {
    //    dd($assignment);
        $students = User::whereHas('courses', fn ($query) => 
            $query->where('course_id', $assignment->course_id)
        )->get();
        // dd($students);

        foreach ($students as $student) {
            try {
                // Mail::send('emails.assignment_notification', 
                //     ['user' => $student, 'assignment' => $assignment],
                //     function ($message) use ($student) {
                //         $message->to($student->email, $student->name)
                //                ->subject('New Assignment Available');
                //     }
                // );

                // will add $assignment below as well when it will get the data
                dispatch(new SendNewAssignmentNotification($student,$assignment));

            } catch (\Exception $e) {
                \Log::warning("Failed to send notification to {$student->email}: {$e->getMessage()}");
            }
        }
    }

    protected function rules()
    {
        return [
            'course_id' => 'required|exists:courses,id',
            'batch_id' => 'required|exists:batches,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date|after:now',
            'status' => 'boolean'
        ];
    }

    public function updatedCourseId($value)
    {
        if ($value) {
            $this->batches = Batch::where('course_id', $value)->get();
        } else {
            $this->batches = collect();
        }
        $this->batch_id = '';
    }

    public function create()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function edit($assignmentId)
    {
        $this->editingAssignment = Assignments::find($assignmentId);
        if ($this->editingAssignment) {
            $this->course_id = $this->editingAssignment->course_id;
            $this->batch_id = $this->editingAssignment->batch_id;
            $this->title = $this->editingAssignment->title;
            $this->description = $this->editingAssignment->description;
            $this->due_date = $this->editingAssignment->due_date;
            $this->status = $this->editingAssignment->status;
            $this->updatedCourseId($this->course_id);
            $this->showModal = true;
        }
    }

    public function save()
    {
        $this->validate();

        try {
            $data = [
                'course_id' => $this->course_id,
                'batch_id' => $this->batch_id,
                'title' => $this->title,
                'description' => strip_tags($this->description),
                'due_date' => $this->due_date,
                'status' => $this->status,
            ];

            if ($this->editingAssignment) {
                $this->editingAssignment->update($data);
                session()->flash('success', 'Assignment updated successfully!');
            } else {
                $assignment = Assignments::create($data);
                if ($assignment->status) {
                    $this->notifyStudents($assignment);
                }
                session()->flash('success', 'Assignment created successfully!');
            }

            $this->closeModal();
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to save assignment: ' . $e->getMessage());
        }
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->editingAssignment = null;
        $this->title = '';
        $this->description = '';
        $this->batch_id = '';
        $this->due_date = '';
        $this->status = false;
        if ($this->course_id) {
            $this->updatedCourseId($this->course_id);
        }
    }

    public function viewSubmissions($assignmentId)
    {
        $this->selectedAssignment = Assignments::with(['uploads.user'])->find($assignmentId);
        $this->submissions = $this->selectedAssignment->uploads()
            ->with('user')
            ->get()
            ->groupBy('student_id')
            ->map(function ($uploads) {
                return [
                    'name' => $uploads->first()->user->name,
                    'uploads' => $uploads,
                    'submitted_at' => $uploads->first()->submitted_at->format('Y-m-d H:i'),
                    'grade' => $uploads->first()->grade,
                ];
            });
        $this->viewMode = 'review';
    }

    public function gradeSubmission($studentId)
    {
        $this->validate([
            "grade.$studentId" => 'required|numeric|min:0|max:100',
        ]);

        $upload = Assignment_upload::where('assignment_id', $this->selectedAssignment->id)
            ->where('student_id', $studentId)
            ->latest()
            ->first();

        if ($upload) {
            $upload->update([
                'grade' => $this->grade[$studentId],
                'status' => 'graded'
            ]);
            session()->flash('success', 'Grade updated successfully!');
            $this->viewAssignmentSubmissions($this->selectedAssignment->id); // Refresh submissions
        }
    }

    public function previewFile($fileId)
    {
        $this->selectedFileId = $fileId;
    }

    public function closePreview()
    {
        $this->selectedFileId = null;
    }

    public function backToList()
    {
        $this->viewMode = 'list';
        $this->selectedAssignment = null;
        $this->submissions = [];
        $this->grade = [];
        $this->selectedFileId = null;
    }

    public function viewAssignmentSubmissions($assignmentId)
    {
        $this->currentAssignment = Assignments::with(['uploads' => function($query) {
            $query->with('user')->orderBy('submitted_at', 'desc');
        }])->findOrFail($assignmentId);

        $this->studentSubmissions = $this->currentAssignment->uploads
            ->groupBy('student_id')
            ->map(function($uploads) {
                $latestUpload = $uploads->first();
                return [
                    'student_name' => $latestUpload->user->name,
                    'student_id' => $latestUpload->student_id,
                    'submitted_at' => $latestUpload->submitted_at->format('M d, Y H:i'),
                    'status' => $this->getSubmissionStatus($latestUpload),
                    'grade' => $latestUpload->grade,
                    'files' => $uploads->map(function($upload) {
                        return [
                            'id' => $upload->id,
                            'file_path' => $upload->file_path,
                            'submitted_at' => $upload->submitted_at->format('M d, Y H:i')
                        ];
                    })
                ];
            });

        $this->viewSubmissions = true;
    }

    private function getSubmissionStatus($upload)
    {
        if (!$upload->submitted_at) {
            return 'pending';
        }

        if ($this->currentAssignment->due_date && $upload->submitted_at > $this->currentAssignment->due_date) {
            return 'overdue';
        }

        return 'submitted';
    }

    public function updateGrade($studentId, $grade)
    {
        $this->validate([
            'grade' => 'required|numeric|min:0|max:100'
        ]);

        $upload = Assignment_upload::where('assignment_id', $this->currentAssignment->id)
            ->where('student_id', $studentId)
            ->latest()
            ->first();

        if ($upload) {
            $upload->update([
                'grade' => $grade,
                'status' => 'graded'
            ]);
            
            $this->dispatch('notify', [
                'message' => 'Grade updated successfully!'
            ]);
            $this->viewAssignmentSubmissions($this->currentAssignment->id); // Refresh submissions
        }
    }

    public function closeSubmissions()
    {
        $this->viewSubmissions = false;
        $this->currentAssignment = null;
        $this->studentSubmissions = [];
        $this->selectedFileId = null;
    }
}