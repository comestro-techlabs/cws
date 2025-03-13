<?php

namespace App\Livewire\Student\Dashboard\Product;

use App\Models\ProductCategories;
use App\Models\Products;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Razorpay\Api\Product;

class OurProducts extends Component
{
    public $categories;
    public $products;
    public $selectedCategory='';
    public $totalAvailableGems=1000;
    public function mount(){
        $this->categories = ProductCategories::pluck('name', 'id');
        // dd($this->categories);
         $this->products = Products::all();  
        // dd($this->products);
    }
    public function updatedSelectedCategory($categoryId)
    {
        // dd($categoryId);

        if ($categoryId == '') {
            $this->products = Products::all(); 
        } else {
            $this->products = Products::where('product_category_id', $categoryId)->get();
        }
    }
  


    #[Layout('components.layouts.student')]
    public function render()
    {
        return view('livewire.student.dashboard.product.our-products');
    }
}
