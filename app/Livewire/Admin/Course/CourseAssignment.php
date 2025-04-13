<?php

namespace App\Livewire\Admin\Course;

use App\Models\Assignments;
use App\Models\Course;
use App\Models\Batch;
use Livewire\Component;
use Livewire\WithPagination;

class CourseAssignment extends Component
{
    use WithPagination;

    public $course_id;
    public $course_title;
    public $search = '';
    public $perPage = 10;
    public $showModal = false;
    public $title;
    public $description;
    public $batch_id;
    public $due_date;
    public $status = false;
    public $editingAssignment = null;
    public $batches = [];

    protected $paginationTheme = 'tailwind';

    public function mount($course_id)
    {
        $this->course_id = $course_id;
        $course = Course::find($course_id);
        if (!$course) {
            session()->flash('error', 'Course not found.');
            return redirect()->route('courses.index'); // Adjust redirect as needed
        }
        $this->course_title = $course->title;
        $this->loadBatches();
    }

    public function loadBatches()
    {
        $this->batches = Batch::where('course_id', $this->course_id)->get();
    }

    public function getAssignments()
    {
        return Assignments::where('course_id', $this->course_id)
            ->when($this->search, fn($query) => $query->where('title', 'like', '%' . $this->search . '%'))
            ->latest()
            ->paginate($this->perPage);
    }

    public function saveAssignment()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'batch_id' => 'required|exists:batches,id',
            'due_date' => 'required|date|after_or_equal:today',
        ], [
            'title.required' => 'The title is required.',
            'description.required' => 'The description is required.',
            'batch_id.required' => 'Please select a batch.',
            'due_date.required' => 'The due date is required.',
            'due_date.after_or_equal' => 'The due date must be today or later.',
        ]);

        try {
            $dueDate = \Carbon\Carbon::parse($this->due_date)->toDateTimeString();

            if ($this->editingAssignment) {
                $assignment = Assignments::findOrFail($this->editingAssignment);
                $assignment->update([
                    'course_id' => $this->course_id, // Ensure course_id is unchanged
                    'title' => $this->title,
                    'description' => $this->description,
                    'batch_id' => $this->batch_id,
                    'due_date' => $dueDate,
                    'status' => $this->status,
                ]);
                session()->flash('message', 'Assignment updated successfully.');
            } else {
                Assignments::create([
                    'course_id' => $this->course_id,
                    'title' => $this->title,
                    'description' => $this->description,
                    'batch_id' => $this->batch_id,
                    'due_date' => $dueDate,
                    'status' => $this->status,
                ]);
                session()->flash('message', 'Assignment created successfully.');
            }
            $this->closeModal();
        } catch (\Exception $e) {
            session()->flash('error', 'Error saving assignment: ' . $e->getMessage());
        }
    }

    public function editAssignment($assignmentId)
    {
        $assignment = Assignments::find($assignmentId);
        if ($assignment) {
            $this->editingAssignment = $assignmentId;
            $this->title = $assignment->title;
            $this->description = $assignment->description;
            $this->batch_id = $assignment->batch_id;
            $this->due_date = $assignment->due_date ? \Carbon\Carbon::parse($assignment->due_date)->format('Y-m-d\TH:i') : null;
            $this->status = $assignment->status;
            $this->showModal = true;
        } else {
            session()->flash('error', 'Assignment not found.');
        }
    }

    public function deleteAssignment($assignmentId)
    {
        $assignment = Assignments::find($assignmentId);
        if ($assignment) {
            $assignment->delete();
            session()->flash('message', 'Assignment deleted successfully.');
        } else {
            session()->flash('error', 'Assignment not found.');
        }
    }

    public function toggleStatus($assignmentId)
    {
        $assignment = Assignments::find($assignmentId);
        if ($assignment) {
            $assignment->status = !$assignment->status;
            $assignment->save();
            session()->flash('message', 'Assignment status updated.');
        } else {
            session()->flash('error', 'Assignment not found.');
        }
    }

    public function openModal()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->resetForm();
        $this->showModal = false;
    }

    public function resetForm()
    {
        $this->reset(['title', 'description', 'batch_id', 'due_date', 'status', 'editingAssignment']);
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.admin.course.course-assignment', [
            'assignments' => $this->getAssignments(),
            'batches' => $this->batches,
        ]);
    }
}