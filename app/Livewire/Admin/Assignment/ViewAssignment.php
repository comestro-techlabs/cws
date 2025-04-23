<?php

namespace App\Livewire\Admin\Assignment;

use App\Models\Assignments;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Carbon\Carbon;

#[Layout('components.layouts.admin')]
#[Title('View Assignment')]
class ViewAssignment extends Component
{
    public $assignment;
    public $assignmentId;

    protected $listeners = ['editAssignment' => 'handleEdit'];

    public function mount($id)
    {
        $this->assignmentId = $id;
        $this->assignment = Assignments::with(['course', 'batch', 'uploads.user'])
            ->findOrFail($id);
            
        // Cast the due_date to Carbon instance if it exists
        if ($this->assignment->due_date) {
            $this->assignment->due_date = Carbon::parse($this->assignment->due_date);
        }
    }

    public function handleEdit()
    {
        return redirect()->route('admin.assignment.manage', ['editId' => $this->assignmentId]);
    }

    public function render()
    {
        return view('livewire.admin.assignment.view-assignment');
    }
}
