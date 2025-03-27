<?php

namespace App\Livewire\Public;

use Livewire\Component;

class PrivacyPolicy extends Component
{
    public function render()
    {
        return view('livewire.public.privacy-policy')
            ->layout('components.layouts.app', [
                'title' => 'Privacy Policy'
            ]);
    }
}
