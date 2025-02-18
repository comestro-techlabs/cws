<?php

namespace App\Livewire\Admin\Workshops;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Workshop;

class CreateWorkshop extends Component
{
    use WithFileUploads;

    public $title, $date, $time, $fees, $active = 1, $image;
    public $workshopId; // Used for editing

    protected $rules = [
        'title' => 'required|string|min:3',
        'date' => 'required|date',
        'time' => 'required',
        'fees' => 'required|numeric',
        'active' => 'required|boolean',
        'image' => 'nullable|image|max:2048', // Optional image upload
    ];

    public function mount($workshop = null)
    {
        if ($workshop) {
            $this->workshopId = $workshop->id;
            $this->title = $workshop->title;
            $this->date = $workshop->date;
            $this->time = $workshop->time;
            $this->fees = $workshop->fees;
            $this->active = $workshop->active;
        }
    }

    public function save()
    {
        $this->validate();

        if ($this->workshopId) {
            $workshop = Workshop::findOrFail($this->workshopId);
            $workshop->update([
                'title' => $this->title,
                'date' => $this->date,
                'time' => $this->time,
                'fees' => $this->fees,
                'active' => $this->active,
                'image' => $this->image ? $this->image->store('workshops', 'public') : $workshop->image,
            ]);

            session()->flash('message', 'Workshop updated successfully!');
        } else {
            Workshop::create([
                'title' => $this->title,
                'date' => $this->date,
                'time' => $this->time,
                'fees' => $this->fees,
                'active' => $this->active,
                'image' => $this->image ? $this->image->store('workshops', 'public') : null,
            ]);

            session()->flash('message', 'Workshop created successfully!');
        }

        $this->reset(); // Clear the form after save
    }



    public function render()
    {
        return view('livewire.admin.workshops.create-workshop');
    }
}
