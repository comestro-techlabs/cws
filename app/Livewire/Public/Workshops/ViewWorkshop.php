<?php

namespace App\Livewire\Public\Workshops;

use App\Models\Workshop;
use Livewire\Component;

class ViewWorkshop extends Component
{
    public $workshop;
    
    public function mount($id)
    {
        $this->workshop = Workshop::findOrFail($id);
        
        // Debug the description
        \Log::info('Workshop Description:', [
            'description' => $this->workshop->description,
            'type' => gettype($this->workshop->description)
        ]);
    }

    public function render()
    {
        return view('livewire.public.workshops.view-workshop');
    }
}