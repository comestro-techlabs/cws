<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Register extends Component
{
    public $name = '';
    public $email = '';
    public $contact = '';
    public $password = '';
    public $password_confirmation = '';

    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email|unique:users',
        'contact' => 'required|digits:10|unique:users',
        'password' => 'required|min:8|confirmed',
    ];

    public function register()
    {
        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'contact' => $this->contact,
            'password' => Hash::make($this->password),
        ]);

        auth()->login($user);

        return redirect()->route('student.dashboard');
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
