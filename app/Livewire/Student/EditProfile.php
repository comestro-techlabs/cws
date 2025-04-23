<?php

namespace App\Livewire\Student;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

class EditProfile extends Component
{
    public $name;
    public $contact;
    public $education_qualification;
    public $dob;
    public $gender;
    public $student;

    protected function rules()
    {
        $minAgeDate = Carbon::now()->subYears(12)->format('Y-m-d');
        
        return [
            'name' => 'required|string|max:255|min:3',
            'contact' => 'nullable|string|max:15|regex:/^[0-9\+\- ]+$/',
            'education_qualification' => 'nullable|string|max:255',
            'dob' => [
                'nullable',
                'date',
                'before_or_equal:today',
                function ($attribute, $value, $fail) use ($minAgeDate) {
                    if ($value && $value > $minAgeDate) {
                        $fail('You must be at least 12 years old.');
                    }
                },
            ],
            'gender' => ['required', Rule::in(['male', 'female', 'other'])],
        ];
    }

    protected $messages = [
        'name.required' => 'The name field is required.',
        'name.min' => 'The name must be at least 3 characters.',
        'contact.regex' => 'Please enter a valid phone number.',
        'dob.before_or_equal' => 'Date of birth must be today or earlier.',
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
        $this->validate($this->rules());
            $this->student->update([
                'name' => $this->name,
                'contact' => $this->contact,
                'education_qualification' => $this->education_qualification,
                'dob' => $this->dob,
                'gender' => $this->gender,
            ]);

            return redirect()->route('student.v2edit.profile',)
            ->with('success', 'Profile updated successfully');
       
    }

    #[Layout('components.layouts.student')]
    public function render()
    {
        return view('livewire.student.edit-profile');
    }
}