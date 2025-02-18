<?php

namespace App\Livewire\Admin\Category;

use Livewire\Component;
use App\Models\Category as CategoryModel;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Title('Manage Students')]
class ManageCategory extends Component
{

    public $cat_title;
    public $cat_slug;
    public $cat_description;

    public function rules(){
        return [
            'cat_title' => 'required|string',
            'cat_description' => 'required|string',
        ];

    } 

    public function store()
    {        
        $this->validate();
        // dd("testing");
        

        $cat = CategoryModel::create([
            'cat_title' => $this->cat_title,
            'cat_description' => $this->cat_description,
        ]);
        
        $this->reset(['cat_title', 'cat_description']);
        
        $this->dispatch('success', ['message' => "Category added successfully!"]);


    }
    
    #[Layout('components.layouts.admin')] 
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
