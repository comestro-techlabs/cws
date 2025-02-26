<?php

namespace App\Livewire\Admin\Workshops;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Models\Workshop;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
#[Layout('components.layouts.admin')] 
#[Title('Manage Workshop')]
class ManageWorkshop extends Component
{
    use WithFileUploads;
    public $workshops;
    public $isEditing = false;
    public $editingId;
    public $title;
    public $date;
    public $time;
    public $fees;
    public $active;
    public $image;
    public $existingImage;

    public function mount()
    {
        $this->loadWorkshops();
    }

    public function loadWorkshops()
    {
        $this->workshops = Workshop::with('payment')->get();
    }

    public function toggleStatus($workshopId)
    {
        $workshop = Workshop::find($workshopId);
        $workshop->active = !$workshop->active;
        $workshop->save();
        $this->loadWorkshops();
    }

    public function edit($workshopId)
    {
        $workshop = Workshop::findOrFail($workshopId);
        $this->editingId = $workshopId;
        $this->isEditing = true;
        $this->title = $workshop->title;
        $this->date = $workshop->date;
        $this->time = $workshop->time;
        $this->fees = $workshop->fees;
        $this->active = $workshop->active;
        $this->existingImage = $workshop->image;
        $this->image = null;
    }
    
    public function save()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required',
            'fees' => 'required|numeric',
            'active' => 'boolean',
            'image' => 'nullable|image|max:2048', 
        ]);

        $workshop = Workshop::find($this->editingId);

        $data = [
            'title' => $this->title,
            'date' => $this->date,
            'time' => $this->time,
            'fees' => $this->fees,
            'active' => $this->active,
        ];

        if ($this->image) {
            $imagePath = $this->image->store('workshops', 'public');
            $data['image'] = $imagePath;
        }

        $workshop->update($data);

        $this->resetForm();
        $this->loadWorkshops();
        session()->flash('message', 'Workshop updated successfully!');
    }
    public function delete($workshopId)
    {
        $workshop = Workshop::findOrFail($workshopId);
        if ($workshop->image) {
            Storage::disk('public')->delete($workshop->image);
        }
        
        $workshop->delete();
        
        $this->loadWorkshops();
        session()->flash('message', 'Workshop deleted successfully!');
    }
    public function resetForm()
    {
        $this->isEditing = false;
        $this->editingId = null;
        $this->title = '';
        $this->date = '';
        $this->time = '';
        $this->fees = '';
        $this->active = false;
        $this->image = null;
        $this->existingImage = null;
    }
    public function render()
    {
        return view('livewire.admin.workshops.manage-workshop');
    }
}
