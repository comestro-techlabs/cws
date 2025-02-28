<?php

namespace App\Livewire\Student;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



class EditProfile extends Component
{
    public $name, $contact, $education_qualification, $dob, $gender, $student;

    protected $rules = [
        'name' => 'required|string|max:255',
        'contact' => 'nullable|string|max:15',
        'education_qualification' => 'nullable|string',
        'dob' => 'nullable|date',
        'gender' => 'required|in:male,female,other',
    ];

    public function mount()
    {
        $this->student = Auth::user();
        $this->name = $this->student->name;
        $this->contact = $this->student->contact;
        $this->education_qualification = $this->student->education_qualification;
        $this->dob = $this->student->dob;
        $this->gender = $this->student->gender;
    }

    public function updateProfile()
    {
        $this->validate();

        $this->student->update([
            'name' => $this->name,
            'contact' => $this->contact,
            'education_qualification' => $this->education_qualification,
            'dob' => $this->dob,
            'gender' => $this->gender,
        ]);

        session()->flash('success', 'Profile updated successfully!');
    }
    public function render()
    {
        return view('livewire.student.edit-profile');
    }
}
