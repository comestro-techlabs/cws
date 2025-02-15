<?php

namespace App\Livewire\Admin\Workshops;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Workshop;

class CreateWorkshop extends Component
{
    use WithFileUploads; // Enable file uploads

    // Define properties for form fields
    public $title;
    public $date;
    public $time;
    public $image;
    public $fees;
    public $active = 1; // Default value for the dropdown

    // Validation rules
    protected $rules = [
        'title' => 'required|string|min:3',
        'date' => 'required|date',
        'time' => 'required',
        'image' => 'nullable|image|max:2048', // 2MB max
        'fees' => 'required|numeric',
        'active' => 'required|boolean',
    ];

    // Real-time validation
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);

    }

    // Handle form submission
    public function submit()
    {
        $this->validate();
        $imagePath = $this->image ? $this->image->store('workshops', 'public') : null;
        Workshop::create([
            'title' => $this->title,
            'date' => $this->date,
            'time' => $this->time,
            'image' => $imagePath,
            'fees' => $this->fees,
            'active' => $this->active,
        ]);

        $this->reset();
        // session()->flash('message', 'Workshop successfully!');
        $this->dispatch('success', ['message' => "Workshop added successfully!"]);

    }


    public function render()
    {
        return view('livewire.admin.workshops.create-workshop');
    }
}
