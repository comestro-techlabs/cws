<?php

namespace App\Livewire\Public\Portfolio;

use App\Models\Portfolio;
use Livewire\Component;

class OurPortfolio extends Component
{
    public  $portfolios;

    public function mount(){
        $this->portfolios = Portfolio::all(); 
    }
    public function render()
    {
        return view('livewire.public.portfolio.our-portfolio');
    }
}
