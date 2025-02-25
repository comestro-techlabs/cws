<?php

namespace App\Livewire\Admin\Assignment;

use App\Models\Assignments;
use Livewire\Component;

class SingleViewAssignment extends Component
{
    public Assignments $assignment;

    public function render()
    {
        return view('livewire.admin.assignment.single-view-assignment');
    }
}