<?php

namespace App\Livewire\Student\Dashboard\Product;

use Livewire\Attributes\Layout;
use Livewire\Component;

class OurProducts extends Component
{

    #[Layout('components.layouts.student')]
    public function render()
    {
        return view('livewire.student.dashboard.product.our-products');
    }
}
