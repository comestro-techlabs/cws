<?php

namespace App\Livewire\Admin\Portfolio;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
#[Layout('components.layouts.admin')]
#[Title('Edit Portfolio')]
class EditPortfolio extends Component
{
    use WithFileUploads; 
    public function render()
    {
        return view('livewire.admin.portfolio.edit-portfolio');
    }
}
