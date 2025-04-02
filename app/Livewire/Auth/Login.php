<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
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

    public function mount(){
        if (Cookie::has('remembered_email')) {
            $this->email = Cookie::get('remembered_email');
            $this->remember = true; // Pre-check the "Remember Me" checkbox
        }
    }
    public function login()
    {
        $this->validate();

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {

            // dd($this->email);
            if ($this->remember) {
                Cookie::queue(
                    'remembered_email',
                    $this->email,
                    60 * 24 * 30
                );
            } 
            else {
                Cookie::queue(Cookie::forget('remembered_email'));
            }
            return redirect()->intended(Auth::user()->isAdmin ? '/v2/admin/dashboard' : '/');
        }

        session()->flash('error', 'Invalid credentials. Please try again.');
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
