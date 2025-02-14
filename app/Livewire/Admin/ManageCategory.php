<?php

namespace App\Livewire\Admin;

use App\Models\Category as CategoryModel;
use Livewire\Component;
use Illuminate\Support\Str;

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
        // session()->flash('message', 'Category created successfully.');
        $this->dispatch("showToast", "Category successfully updated!");

    }
    
    public function render()
    {
        $categories = CategoryModel::paginate(4);
        return view('livewire.admin.manage-category', compact('categories'));
    }

    public function destroy($id)
    {
        $category = CategoryModel::find($id);
        $category->delete();
        // session()->flash('message', 'Category deleted successfully.');
        $this->dispatch("showToast", "Category successfully updated!");
    }
}
