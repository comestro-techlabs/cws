<?php

namespace App\Livewire\Admin\Course;

use App\Models\Course;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.admin')]
#[Title('Manage Course')]
class ManageCourse extends Component
{
    use WithPagination;
    public $search = '';
    public $confirmingDelete = false;
    public $courseToDelete;
    protected $listeners = ['deleteConfirmed' => 'deleteCourse'];
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function confirmDelete($courseId)
    {
        $this->confirmingDelete = true;
        $this->courseToDelete = Course::findOrFail($courseId);
    }

    public function deleteCourse()
    {
        if ($this->courseToDelete) {
            $this->courseToDelete->delete();
            $this->dispatch('alert', 'Course deleted successfully.');
        }

        $this->reset(['confirmingDelete', 'courseToDelete']);
    }
    public function render()
    {
        return view('livewire.admin.course.manage-course', [
            'courses' => Course::where('title', 'like', "%{$this->search}%")
                ->orderByDesc('created_at')
                ->paginate(10)
        ]);
    }
}
