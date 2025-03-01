<?php

namespace App\Livewire\Admin;
use Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Dashboad extends Component
{
    #[Layout('components.layouts.admin')]

    public function logout()
    {
        Auth::logout();
        return redirect()->route('auth.login');
    }

    public function render()
    {
        return view('livewire.admin.dashboad');
    }
}
