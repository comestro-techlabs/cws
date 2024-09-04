<?php

namespace App\Livewire;

use Livewire\Component;

class ServiceCard extends Component
{
    public $title, $description, $link, $iconClass;
    public function render()
    {
        return view('livewire.service-card');
    }
}
