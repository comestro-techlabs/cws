<?php

namespace App\Livewire\Admin\Assignment;

use App\Models\Assignments;
use App\Models\Batch;
use App\Models\Course;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Layout;
use Livewire\Component;

class CreateAssignment extends Component
{
    public $assignment;
    public $course_id = '';
    public $batch_id = '';
    public $title = '';
    public $description = '';
    public $status = false;
    public $batches = [];

    #[Layout('components.layouts.admin')]
    public function render()
    {
        return view('livewire.admin.assignment.create-assignment', [
            'courses' => Course::all(),
            'batches' => $this->batches,
        ]);
    }

    public function mount($assignment = null)
    {
        $this->batches = collect();

        if ($assignment) {
            $this->assignment = Assignments::find($assignment);
            if ($this->assignment) {
                $this->course_id = $this->assignment->course_id;
                $this->batch_id = $this->assignment->batch_id;
                $this->title = $this->assignment->title;
                $this->description = $this->assignment->description ?? '';                
            } else {
                
                session()->flash('error', 'Assignment not found.');
                $this->redirect(route('admin.assignment.manage'), navigate: true);
            }
        }

        $this->updateBatches();
    }

    public function save()
    {
        try {
            $validated = $this->validate([
                'course_id' => 'required|exists:courses,id',
                'batch_id' => 'required|exists:batches,id',
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'status' => 'boolean',
            ]);

            $validated['description'] = strip_tags($this->description);

            if ($this->assignment) {
                $this->assignment->update($validated);
                session()->flash('success', 'Assignment updated successfully!');
                $this->redirect(route('admin.assignment.manage'), navigate: true);
            } else {
                $assignment = Assignments::create($validated);
                if ($assignment->status) {
                    $this->notifyStudents($assignment);
                }
                session()->flash('success', 'Assignment created successfully!');
                $this->resetForm();
                $this->redirect(route('admin.assignment.manage'), navigate: true);
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to ' . ($this->assignment ? 'update' : 'create') . ' assignment: ' . $e->getMessage());
        }
    }

    public function updateBatches()
    {
        $this->batches = $this->course_id
            ? Batch::where('course_id', $this->course_id)->get()
            : collect();
        if (!$this->batches->contains('id', $this->batch_id)) {
            $this->batch_id = '';
        }
    }

    private function notifyStudents($assignment)
    {
        $students = User::whereHas(
            'courses',
            fn($query) => $query->where('course_id', $assignment->course_id)
        )->get();

        foreach ($students as $student) {
            try {
                Mail::send(
                    'emails.assignment_notification',
                    ['user' => $student, 'assignment' => $assignment],
                    function ($message) use ($student) {
                        $message->to($student->email, $student->name)
                            ->subject('New Assignment Available');
                    }
                );
            } catch (\Exception $e) {
                \Log::warning("Failed to send assignment notification to {$student->email}: {$e->getMessage()}");
            }
        }
    }

    private function resetForm()
    {
        $this->reset(['title', 'description', 'course_id', 'batch_id', 'status']);
        $this->batches = collect();
    }

    protected $messages = [
        'course_id.required' => 'Please select a course.',
        'batch_id.required' => 'Please select a batch.',
        'title.required' => 'Assignment title is required.',
    ];
}