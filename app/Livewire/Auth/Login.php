<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $email = '';
    public $password = '';
    public $remember = false;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:6',
    ];

    public function login()
    {
        $this->validate();

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            return redirect()->intended(Auth::user()->isAdmin ? '/v2/admin/dashboard' : '/');
        }

        session()->flash('error', 'Invalid credentials. Please try again.');
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
