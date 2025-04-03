<?php

namespace App\Livewire\Admin\Workshops;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Models\Workshop;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
#[Layout('components.layouts.admin')] 
#[Title('Manage Workshop')]
class ManageWorkshop extends Component
{
    use WithPagination, WithFileUploads;

    #[Rule('required|min:3|max:255')]
    public $title;

    #[Rule('required|date|after_or_equal:today')]
    public $date;

    #[Rule('required')]
    public $time;

    #[Rule('nullable|image|max:1024')]
    public $image;

    public $existingImage;
    public $imagePreview;

    public $active = false;

    #[Rule('required|numeric|min:0')]
    public $fees;

    #[Rule('required|in:pending,success,failed')]
    public $status = 'pending';

    public $editing = false;
    public $workshopId;
    public $showForm = false;

    public $search = '';
    public $loading = false; 

    public function updatedImage()
    {
        $this->imagePreview = $this->image ? $this->image->temporaryUrl() : null;
    }

    public function showCreateForm()
    {
        $this->resetFields();
        $this->showForm = true;
        $this->editing = false;
    }

    public function create()
    {
        $this->loading = true; 
        $validated = $this->validate();
    
        $imagePath = null;
        if ($this->image) {
            $imagePath = $this->image->store('workshops', 'public');
        }
    
        Workshop::create([
            'title' => $validated['title'],
            'date' => $validated['date'],
            'time' => $validated['time'],
            'image' => $imagePath,
            'active' => $this->active,
            'fees' => $validated['fees'],
            'status' => $validated['status'],
        ]);
    
        $this->resetFields();
        $this->showForm = false;
        $this->dispatch('notice', type: 'info', text: 'Workshop created successfully!');
        $this->loading = false; 
    }

    public function edit($id)
    {
        $this->loading = true; // Show loading
        $workshop = Workshop::findOrFail($id);
        $this->workshopId = $id;
        $this->title = $workshop->title;
        $this->date = $workshop->date->toDateString();
        $this->time = $workshop->time;
        $this->existingImage = $workshop->image;
        $this->image = null;
        $this->imagePreview = null;
        $this->active = $workshop->active;
        $this->fees = $workshop->fees;
        $this->status = $workshop->status;
        $this->editing = true;
        $this->showForm = true;
        $this->loading = false; // Hide loading
    }

    public function update()
    {
        $this->loading = true; // Show loading
        $validated = $this->validate();

        $workshop = Workshop::findOrFail($this->workshopId);
        
        $data = [
            'title' => $validated['title'],
            'date' => $validated['date'],
            'time' => $validated['time'],
            'active' => $this->active,
            'fees' => $validated['fees'],
            'status' => $validated['status'],
        ];

        if ($this->image) {
            $data['image'] = $this->image->store('workshops', 'public');
        } else {
            $data['image'] = $this->existingImage;
        }

        $workshop->update($data);

        $this->resetFields();
        $this->showForm = false;
        $this->dispatch('notice', type: 'info', text: 'Workshop updated successfully!');
        $this->loading = false; // Hide loading
    }

    public function delete($id)
    {
        $this->loading = true; // Show loading
        Workshop::findOrFail($id)->delete();
        $this->dispatch('notice', type: 'info', text: 'Workshop deleted successfully!');
        $this->loading = false; // Hide loading
    }

    public function cancel()
    {
        $this->resetFields();
        $this->showForm = false;
    }

    private function resetFields()
    {
        $this->title = '';
        $this->date = '';
        $this->time = '';
        $this->image = null;
        $this->existingImage = null;
        $this->imagePreview = null;
        $this->active = false;
        $this->fees = '';
        $this->status = 'pending';
        $this->editing = false;
        $this->workshopId = null;
        $this->resetValidation();
    }

    public function render()
    {
        $workshops = Workshop::where('title', 'like', '%' . $this->search . '%') // Add search filter
            ->latest()
            ->paginate(10);
        return view('livewire.admin.workshops.manage-workshop',compact('workshops'));
    }
}
