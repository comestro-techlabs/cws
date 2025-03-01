<?php

namespace App\Livewire\Admin\Category;

use Livewire\Component;
use App\Models\Category as CategoryModel;

use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
#[Layout('components.layouts.admin')]
#[Title('Manage Category')]   
class ManageCategory extends Component
{
    use WithPagination;

    public $cat_title;
    public $cat_slug;
    public $cat_description;


    public function store()
    {        
        $data = $this->validate(['cat_title' => 'required|string', 'cat_description' => 'required|string']);
        CategoryModel::create($data);                    
        $this->reset(['cat_title', 'cat_description']);
        $this->dispatch('notice', type: 'info', text: 'Category added successfully!');
    }
    
    
    public function render()
    {
        $categories = CategoryModel::paginate(4);
        return view('livewire.admin.category.manage-category')->with(compact('categories'));
    }

    public function destroy($id)
    {
        $category = CategoryModel::find($id);
        if ($category) {
            $category->delete();
            
            // Dispatch event with message
            $this->dispatch('success', ['message' => "Category deleted successfully!"]);
        }
        
    }
    
}
