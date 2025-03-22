<?php

namespace App\Livewire\Admin\Store;

use App\Models\ProductCategories;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

class ManageProductCategories extends Component
{
    public $categories;
    public $isModalOpen = false;
    public $deleteModalOpen= false;
    public $editMode =false;
    public $category_id;
    public $category_name;
    public $category_description;
    public $search = '';


     // Validation Rules
     protected $rules = [
        'category_name' => 'required|min:2|max:100',
        'category_description' => 'required|max:500',
    ];

    public function mount(){
        $this->myCategories();
    }

    #[On('refreshCategory')]
    public function myCategories(){
        $this->categories = ProductCategories::all();
    }

    public function addCategory()
    {
        $this->resetInputFields();
        $this->editMode = false;
        $this->isModalOpen = true;
    }


    public function editCategory($id)
    {
        $this->resetInputFields();
        $this->editMode = true;
        $this->category_id = $id;
        
        $category = ProductCategories::findOrFail($id);
        $this->category_name = $category->name;
        $this->category_description = $category->description;
        
        $this->isModalOpen = true;
    }
    public function confirmDelete($id)
    {
        $this->category_id = $id;
        $this->deleteModalOpen = true;
    }
    public function deleteCategory(){
        $category = ProductCategories::find($this->category_id);

        if($category){
            $category->delete();
            $this->dispatch('refreshCategory')->self();
        }
        $this->closeModal();
        $this->resetInputFields();
    }
    public function saveCategory()
    {
        $this->validate();

        $categoryData = [
            'name' => $this->category_name,
            'description' => $this->category_description,    
        ];

        if ($this->editMode) {
            ProductCategories::find($this->category_id)->update($categoryData);
            $this->dispatch('refreshCategory')->self();
        } else {
            ProductCategories::create($categoryData);
            $this->dispatch('refreshCategory')->self();
        }

        $this->closeModal();
        $this->resetInputFields();
    }
    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->deleteModalOpen = false;
    }
    private function resetInputFields()
    {
        $this->category_id = null;
        $this->category_name = '';
        $this->category_description = '';

    }
    public function updatedSearch()
    {
        $this->filterProducts();
    }
    public function filterProducts()
    {
        $query = ProductCategories::query();

        if (!empty($this->search)) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        $this->categories = $query->get();
    }
    public function toggleStatus($id)
    {
        // dd($id);
        $product = ProductCategories::findOrFail($id);
        // dd( $product->status);
        if ($product->isActive) {
            $product->update(['isActive' => 0]);
        } else {
            $product->update(['isActive' => 1]);
        }
        $this->dispatch('refreshCategory')->self();
    }

    #[Layout('components.layouts.admin')]
    public function render()
    {
        return view('livewire.admin.store.manage-product-categories');
    }
}
