<?php

namespace App\Livewire\Admin\Workshops;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Workshop;


class ManageWorkshop extends Component
{
    use WithPagination; // Enable pagination

    public $search = '';

    public function render()
    {
        $workshops = Workshop::query()
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10); // Adjust pagination as needed

        return view('livewire.admin.workshops.manage-workshop', [
            'workshops' => $workshops,
        ]);
    }

    // Toggle workshop status
    public function toggleStatus($workshopId)
    {
        $workshop = Workshop::findOrFail($workshopId);
        $workshop->active = !$workshop->active;
        $workshop->save();

        session()->flash('message', 'Workshop status updated successfully!');
    }

    // Delete a workshop
    public function deleteWorkshop($workshopId)
    {
        $workshop = Workshop::findOrFail($workshopId);
        $workshop->delete();

        session()->flash('message', 'Workshop deleted successfully!');
    }

}
