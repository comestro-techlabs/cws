<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Register extends Component
{
    
    #[Validate('required|string|max:255')]
    public $name="";

    #[Validate('required|string|email|unique:users,email')]
    public $email="";

    #[Validate('required|digits:10|unique:users,contact')]
    public $contact="";

    #[Validate('required|in:male,female,other')]
    public $gender="";

    #[Validate('required|string|max:255')]
    public $education_qualification="";

    #[Validate('required|date|before_or_equal:today')]
    public $dob="";

    

    



    public function register()
    {
     
        $this->validate();


        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'contact' => $this->contact,
            'dob' => $this->dob,
            'gender' => $this->gender,
            'education_qualification' => $this->education_qualification,
        ]);

        Mail::send('emails.registration', ['user' => $user], function ($message) use ($user) {
            $message->to($user->email)
                    ->subject('Registration Successful');
        });

        $this->reset();

        session()->flash('success', 'Registration successful! A confirmation email has been sent.');
        
        return redirect()->route('auth.login');
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
