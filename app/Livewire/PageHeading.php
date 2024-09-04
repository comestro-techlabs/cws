<?php

namespace App\Livewire;

use Livewire\Component;

class PageHeading extends Component
{
    public $title, $description, $image;
    public function render()
    {
        return view('livewire.page-heading');
    }
}
