<?php

namespace App\Livewire\Admin\Assignment;

use App\Models\Assignments;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;


#[Layout('components.layouts.admin')]
#[Title(' View Assignment')]
class SingleViewAssignment extends Component
{
    public Assignments $assignment;

    public function render()
    {
        return view('livewire.admin.assignment.single-view-assignment');
    }
}