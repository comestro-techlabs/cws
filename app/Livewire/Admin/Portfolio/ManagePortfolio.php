<?php

namespace App\Livewire\Admin\Portfolio;

use Livewire\Component;
use App\Models\Portfolio; 
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
#[Layout('components.layouts.admin')]
#[Title('Manage Portfolio')]

class ManagePortfolio extends Component
{
    public $portfolios;

    public function mount()
    {
        $this->portfolios = Portfolio::all();
    }

    public function delete($id)
    {
        Portfolio::find($id)->delete();
        $this->portfolios = Portfolio::all(); 
    }

 public function render()
    {
         return view('livewire.admin.portfolio.manage-portfolio');
     }
}