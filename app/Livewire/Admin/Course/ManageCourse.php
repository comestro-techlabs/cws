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
    public $typeFilter = '';
    public $statusFilter = '';
    public $priceRangeFilter = '';
    public $sortBy = 'created_at';
    public $sortDirection = 'desc';
    protected $listeners = ['deleteConfirmed' => 'deleteCourse'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->search = '';
        $this->typeFilter = '';
        $this->statusFilter = '';
        $this->priceRangeFilter = '';
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
        $query = Course::query()
            ->when($this->search, function($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('instructor', 'like', '%' . $this->search . '%');
            })
            ->when($this->typeFilter, function($q) {
                $q->where('course_type', $this->typeFilter);
            })
            ->when($this->statusFilter, function($q) {
                $q->where('published', $this->statusFilter === 'published');
            })
            ->when($this->priceRangeFilter, function($q) {
                switch($this->priceRangeFilter) {
                    case 'free':
                        $q->where('discounted_fees', 0);
                        break;
                    case 'paid':
                        $q->where('discounted_fees', '>', 0);
                        break;
                    case 'low':
                        $q->whereBetween('discounted_fees', [1, 10000]);
                        break;
                    case 'mid':
                        $q->whereBetween('discounted_fees', [10001, 25000]);
                        break;
                    case 'high':
                        $q->where('discounted_fees', '>', 25000);
                        break;
                }
            })
            ->orderBy($this->sortBy, $this->sortDirection);

        return view('livewire.admin.course.manage-course', [
            'courses' => $query->paginate(10)
        ]);
    }
}
