<?php

namespace App\Livewire\Public;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Header extends Component
{

    public function logout()
    {
        Auth::logout();
        return redirect()->route('v2.auth.login')->with('success', 'You have been logged out.');
    }
    //here logout and logic will be placed
    public function render()
    {
        return view('livewire.public.header');
    }
}
