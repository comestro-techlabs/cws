<?php

namespace App\Livewire\Admin\Assignment;

use App\Jobs\SendNewAssignmentNotification;
use Livewire\Component;
use App\Models\Assignments;
use App\Models\Assignment_upload;
use App\Models\Batch;
use App\Models\Course;
use App\Models\User;
use Carbon\Carbon;
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
    public $activeTab = 'latest';
    public $groupBy = 'course'; // 'course' or 'batch'

    protected $paginationTheme = 'tailwind';

    public function mount()
    {
        if (request()->has('editId')) {
            $this->edit(request()->editId);
        }
    }
    public function render()
    {
        $query = Assignments::query()
            ->when(
                $this->course_id,
                fn($query) =>
                $query->where('course_id', $this->course_id)
            )
            ->when(
                $this->search,
                fn($query) =>
                $query->where('title', 'like', '%' . $this->search . '%')
            );

        // Apply tab filters
        $query = $this->applyTabFilters($query);

        // Get assignments with relationships
        $assignments = $query->with(['course', 'batch', 'uploads.user'])->get();

        // Group assignments
        $groupedAssignments = $assignments->groupBy($this->groupBy === 'course' ? 'course.title' : 'batch.batch_name');

        return view('livewire.admin.assignment.manage-assignment', [
            'groupedAssignments' => $groupedAssignments,
            'courses' => Course::all(),
            'batches' => $this->batches,
        ]);
    }

    private function applyTabFilters($query)
    {
        return $query->when(
            $this->activeTab === 'latest',
            fn($query) =>
            $query->where('due_date', '>=', now())
                ->orderBy('due_date', 'asc')
        )
            ->when(
                $this->activeTab === 'graded',
                fn($query) =>
                $query
                    ->whereRaw('(
                SELECT COUNT(*) FROM assignment_uploads 
                WHERE assignment_uploads.assignment_id = assignments.id
            ) > 0') 
                    ->whereRaw('(
                SELECT COUNT(*) FROM assignment_uploads 
                WHERE assignment_uploads.assignment_id = assignments.id
            ) = (
                SELECT COUNT(*) FROM assignment_uploads 
                WHERE assignment_uploads.assignment_id = assignments.id 
                AND assignment_uploads.status = "graded"
            )') 
                    ->whereRaw('(
                SELECT COUNT(*) FROM assignment_uploads 
                WHERE assignment_uploads.assignment_id = assignments.id
            ) = (
                SELECT COUNT(*) FROM course_student 
                WHERE course_student.batch_id = assignments.batch_id
            )') 
                    ->orderBy('due_date', 'desc')
            )
            ->when(
                $this->activeTab === 'all',
                fn($query) =>
                $query->orderBy('status', 'desc')
                    ->orderBy(function ($query) {
                        $query->selectRaw('CASE 
                    WHEN due_date >= NOW() THEN 1 
                    WHEN due_date < NOW() THEN 2 
                    ELSE 3 END');
                    })
                    ->orderBy('due_date', 'desc')
            );
    }

    public function delete($assignmentId)
    {
        try {
            Assignments::destroy($assignmentId);
            session()->flash('success', 'Assignment deleted successfully!');
        } catch (\Exception $e) {
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
        $students = User::whereHas(
            'courses',
            fn($query) =>
            $query->where('course_id', $assignment->course_id)
        )->get();



        foreach ($students as $student) {
            try {
                dispatch(new SendNewAssignmentNotification($student, $assignment));
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
            // Only reset batch_id if we're not editing
            if (!$this->editingAssignment) {
                $this->batch_id = '';
            }
        } else {
            $this->batches = collect();
            $this->batch_id = '';
        }
    }

    public function create()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function edit($assignmentId)
    {
        try {
            $this->editingAssignment = Assignments::find($assignmentId);
            if ($this->editingAssignment) {
                $this->course_id = $this->editingAssignment->course_id;
                $this->updatedCourseId($this->course_id);

                $this->batch_id = $this->editingAssignment->batch_id;
                $this->title = $this->editingAssignment->title;
                $this->description = $this->editingAssignment->description;

                // Format the date for datetime-local input if it exists
                if ($this->editingAssignment->due_date) {
                    $this->due_date = Carbon::parse($this->editingAssignment->due_date)->format('Y-m-d\TH:i');
                }

                $this->status = (bool) $this->editingAssignment->status;
                $this->showModal = true;
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to load assignment: ' . $e->getMessage());
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
    public function assignmentdelete($assignmentId)
    {
        try {
            $assignment = Assignments::findOrFail($assignmentId);
            $assignment->delete();
            session()->flash('success', 'Assignment deleted successfully!');
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to delete assignment: ' . $e->getMessage());
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