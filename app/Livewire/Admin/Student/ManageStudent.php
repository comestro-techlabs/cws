<?php

namespace App\Livewire\Admin\Student;
use Livewire\WithPagination;
use Livewire\Component;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;


#[Layout('components.layouts.admin')]
#[Title('Manage Students')]
class ManageStudent extends Component
{
    use WithPagination;

    public $filter = '';
    public $search = '';
    public $perPage = 10;
    public $barcode;
    public $showBarcodeModal = false;
    protected $paginationTheme = 'tailwind';
    protected $queryString = ['filter', 'search'];

    public function updatingFilter()
    {
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function generateBarcode($studentId)
    {
        $student = User::find($studentId);
        $this->barcode = 'STU' . str_pad($studentId, 8, '0', STR_PAD_LEFT);
        $student->barcode = $this->barcode;
        $student->save();
        $this->showBarcodeModal = true;
    }

    public function closeBarcodeModal()
    {
        $this->showBarcodeModal = false;
        $this->barcode = null;
    }

    public function render()
    {
        $query = User::where('isAdmin', false);

        if ($this->filter == 'member') {
            $query->where('is_member', 1);
        } elseif ($this->filter == 'user') {
            $query->where('is_member', 0);
        } elseif ($this->filter == 'status_active') {
            $query->where('is_active', 1);
        } elseif ($this->filter == 'status_inactive') {
            $query->where('is_active', 0);
        }

            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('contact', 'like', '%' . $this->search . '%')
                  ->orWhere('email', 'like', '%' . $this->search . '%');
            });

        $students = $query->paginate($this->perPage);
        return view('livewire.admin.student.manage-student')->with(compact('students'));
    }
}
