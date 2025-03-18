<?php

namespace App\Livewire\Admin\Store;

use App\Models\ProductCategories;
use App\Models\Products;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class ManageProducts extends Component
{
    public $products;
    public $categories;
    public $selectedCategory='';


    public function mount(){
        $this->categories = ProductCategories::pluck('name', 'id');

        $this->products = Products::all();
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
    #[Layout('components.layouts.admin')]
    #[Title('Manage Products')]
    public function render()
    {
        return view('livewire.admin.store.manage-products');
    }
}
