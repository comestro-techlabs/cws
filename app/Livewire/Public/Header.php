<?php

namespace App\Livewire\Public;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Header extends Component
{
    public $isDropdownOpen = false;

    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('auth.login');
    }

    public function toggleDropdown()
    {
        $this->isDropdownOpen = !$this->isDropdownOpen;
        $this->dispatch('dropdownToggled', ['isOpen' => $this->isDropdownOpen]);
    }

    public function render()
    {
        return view('livewire.public.header');
    }
}
