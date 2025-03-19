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

        //jo v students us particular course k assignment me enrolled hoga unsbko mail jaiga
        $students = User::whereHas('courses', fn ($query) => 
            $query->where('course_id', $assignment->course_id)
        )->get();

        

        foreach ($students as $student) {
            try {
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
}