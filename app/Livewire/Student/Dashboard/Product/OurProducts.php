<?php

namespace App\Livewire\Student\Dashboard\Product;

use App\Models\ProductCategories;
use App\Models\Products;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Razorpay\Api\Product;

class OurProducts extends Component
{
    public $categories; 
    public $products;
    public $selectedCategory='';
    public $totalAvailableGems;
    public $user_id;
    public $showAccessModal = false;
    public $hasAccess = false;

    public function mount(){
        $this->categories = ProductCategories::pluck('name', 'id');
        $this->products = Products::all();  
        $this->user_id = auth()->id();
        $this->totalAvailableGems = User::where('id',$this->user_id)->value('gem');
        $this->hasAccess = auth()->user()->hasAccess();
        if (!$this->hasAccess) {
            $this->showAccessModal = true;
        }
    }

    public function updatedSelectedCategory($categoryId)
    {
        if ($categoryId == '') {
            $this->products = Products::all(); 
        } else {
            $this->products = Products::where('product_category_id', $categoryId)->get();
        }
    }

    public function checkAccess()
    {
        if (!$this->hasAccess) {
            $this->showAccessModal = true;
            return false;
        }
        return true;
    }

    public function navigateToCheckout($productId)
    {
        if (!$this->hasAccess) {
            $this->showAccessModal = true;
            return;
        }
        return redirect()->route('v2.student.checkout', ['productId' => $productId]);
    }

    #[Layout('components.layouts.student')]
    public function render()
    {
        return view('livewire.student.dashboard.product.our-products');
    }
}
