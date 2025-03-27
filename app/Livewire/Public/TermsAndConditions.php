<?php

namespace App\Livewire\Public;

use Livewire\Component;

class TermsAndConditions extends Component
{
    public function render()
    {
        return view('livewire.public.terms-and-conditions')
            ->layout('components.layouts.app', [
                'title' => 'Terms & Conditions'
            ]);
    }
}