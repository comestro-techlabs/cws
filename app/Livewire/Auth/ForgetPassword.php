<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Password;
use Livewire\Component;

class ForgetPassword extends Component
{
    public $email = '';

    protected $rules = [
        'email' => 'required|email',
    ];

    public function sendResetLink()
    {
        $this->validate();

        $status = Password::sendResetLink(['email' => $this->email]);

        if ($status === Password::RESET_LINK_SENT) {
            session()->flash('success', 'We have emailed your password reset link. Please check your inbox.');
            $this->email = '';
        } else {
            session()->flash('error', 'Unable to send reset link. Please try again later.');
        }

    }
    public function render()
    {
        return view('livewire.auth.forget-password');
    }
}
