<?php

namespace App\Livewire\Public;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Header extends Component
{

    public function logout()
    {
        Auth::logout();
        $this->redirect(route('v2.auth.login'), navigate: true);

    }
    //here logout and logic will be placed
    public function render()
    {
        return view('livewire.public.header');
    }
}
