<?php

namespace App\Livewire\Admin\PlacedStudent;

use Livewire\Component;
use App\Models\PlacedStudent;
use Livewire\WithPagination;


class CallingPlacedStudent extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;

    // Toggle status
    public function toggleStatus($id)
    {
        try {
            $student = PlacedStudent::findOrFail($id);
            $student->status = !$student->status;
            $student->save();

            session()->flash('success', 'Status updated successfully.');
        } catch (\Exception $e) {
            session()->flash('error', 'Student not found.');
        }
    }

    // Delete student
    public function deleteStudent($id)
    {
        try {
            $student = PlacedStudent::findOrFail($id);
            $student->delete();

            session()->flash('success', 'Student deleted successfully.');
        } catch (\Exception $e) {
            session()->flash('error', 'Student not found.');
        }
    }

    public function render()
    {
        $placedStudents = PlacedStudent::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('position', 'like', '%' . $this->search . '%');
            })
            ->paginate($this->perPage);

        return view('livewire.admin.placed-student.calling-placed-student', [
            'placedStudents' => $placedStudents,
        ]);
    }
}
