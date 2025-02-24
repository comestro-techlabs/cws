<?php

namespace App\Livewire\Admin\PlacedStudent;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\PlacedStudent;



class InsertPlacedStudent extends Component
{
    use WithFileUploads;
    public $placedStudent;
    public $placedStudentId;
    public $name;
    public $content;
    public $position;
    public $image;

    protected $rules = [
        'name' => 'required|string|max:255',
        'content' => 'required|string',
        'position' => 'required|string|max:255',
        'image' => 'nullable|image|max:2048', // 2MB max
    ];

    public function mount(?PlacedStudent $placedStudent = null)
    {
        if ($placedStudent instanceof PlacedStudent) {
         $this->placedStudentId = $placedStudent->id;
         $this->name = $placedStudent->name;
         $this->content = $placedStudent->content;
         $this->position = $placedStudent->position;
         $this->image = $placedStudent->image;
        } 
        else 
        {
         $this->placedStudentId = null;
         $this->name = '';
         $this->content = '';
         $this->position = '';
         $this->image = null;
        }   
    }


    public function save()
    {
        $this->validate();

        if ($this->placedStudentId) {
            $placedStudent = PlacedStudent::findOrFail($this->placedStudentId);
        } else {
            $placedStudent = new PlacedStudent();
        }

        $placedStudent->name = $this->name;
        $placedStudent->content = $this->content;
        $placedStudent->position = $this->position;

        if ($this->image) {
            $imagePath = $this->image->store('placedstudent', 'public');
            $placedStudent->image = $imagePath;
        }

        $placedStudent->save();

        session()->flash('success', $this->placedStudentId ? 'Updated successfully!' : 'Created successfully!');

        return redirect()->route('admin.placedstudent.index');
    }


    public function render()
    {
        return view('livewire.admin.placed-student.insert-placed-student');
    }
}
