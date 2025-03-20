<?php

namespace App\Livewire\Admin\Store;

use App\Models\ProductCategories;
use App\Models\Products;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;


class ManageProducts extends Component
{
    use WithFileUploads;
    public $products;
    public $categories;
    public $productId;
    public $isModalOpen = false;
    public $selectedCategory = '';
    public $product_name;
    public $product_description;
    public $product_category_id;
    public $product_stock;
    public $product_gems;
    public $category_id;
    public $deleteModalOpen = false;
    public $isEditing = false;
    public $editing_products = null;
    public $search = '';
    public $product_image; 
    public $existing_image;
    public $imageUrl;



    public function mount()
    {
        $this->categories = ProductCategories::pluck('name', 'id');

        $this->products = Products::all();
    }
    #[On('refreshProducts')]
    public function updatedSelectedCategory($categoryId)
    {
        // dd($categoryId);
        $this->category_id = $categoryId;
        if ($categoryId == '') {
            $this->products = Products::all();
        } else {
            $this->products = Products::where('product_category_id', $categoryId)->get();
        }
    }
    public function toggleStatus($id)
    {
        // dd($id);
        $product = Products::findOrFail($id);
        // dd( $product->status);
        if ($product->status === 'active') {
            $product->update(['status' => 'inactive']);
        } else {
            $product->update(['status' => 'active']);
        }
        $this->dispatch('refreshProducts', categoryId: $this->category_id)->self();
    }
    public function editProduct($id)
    {
        // dd($id);
        $this->productId = $id;
        // $this->isModalOpen = true;
        $this->isEditing = true;

        $this->editing_products = Products::find($this->productId);
        if ($this->editing_products) {
            $this->product_name = $this->editing_products->name;
            $this->product_description = $this->editing_products->description;
            $this->product_category_id = $this->editing_products->product_category_id;
            $this->product_gems = $this->editing_products->points;
            $this->product_stock = $this->editing_products->availableQuantity;
            $this->product_image = $this->editing_products->imageUrl;
            // dd($this->product_image);
        }
        $this->isModalOpen = true;
    }
    public function saveProduct()
    {

        //validation to be applied here,which is left 
        if ($this->isEditing) { 
            $product = Products::findOrFail($this->productId);
        } else {
            $product = new Products();
        }
        if ($this->product_image) {
            // Delete old image if exists (only during editing)
            if ($this->isEditing && $this->product_image) {
                Storage::delete('storage/' . $this->product_image);
            }

            // Store new image
            $imagePath = $this->product_image->store('products', 'public');
            $product->imageUrl = $imagePath; 
        }

        $product->name = $this->product_name;
        $product->description = $this->product_description;
        $product->points = $this->product_gems;
        $product->product_category_id = $this->product_category_id;
        $product->availableQuantity = $this->product_stock;
        $product->slug = Str::slug($this->product_name);
        $product->save();

        $this->dispatch('refreshProducts', categoryId: $this->category_id)->self();

        $this->isModalOpen = false;
    }

    public function closeModalBtn()
    {
        $this->isModalOpen = false;
        $this->deleteModalOpen = false;
    }
    public function confirmDelete($id)
    {
        $this->deleteModalOpen = true;
        $this->productId = $id;
    }
    public function deleteProduct()
    {
        $product = Products::findOrFail($this->productId);
        if ($product) {
            $product->delete();
        }
        $this->dispatch('refreshProducts', categoryId: $this->category_id)->self();
        $this->deleteModalOpen = false;
    }
    public function addNewProduct()
    {
        $this->reset([
            'product_name',
            'product_description',
            'product_category_id',
            'product_stock',
            'product_gems',
            'productId',
            'isEditing',
            'product_image',
        ]);

        $this->isModalOpen = true;
    }

    //for the searching functionality
    public function updatedSearch()
    {
        $this->filterProducts();
    }

    public function filterProducts()
    {
        $query = Products::query();

        if (!empty($this->search)) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        $this->products = $query->get();
    }

    #[Layout('components.layouts.admin')]
    #[Title('Manage Products')]
    public function render()
    {
        return view('livewire.admin.store.manage-products');
    }
}
