<?php

namespace App\Livewire\Admin\Category;

use Livewire\Component;
use App\Models\Category as CategoryModel;
use Livewire\Attributes\Validate;
use Livewire\WithPagination;
use Illuminate\Database\UniqueConstraintViolationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
#[Layout('components.layouts.admin')]
#[Title('Single View Assignment')]   
class ManageCategory extends Component
{
    use WithPagination;

    #[Validate('required|string')]
    public $cat_title = '';

    #[Validate('required|string')]
    public $cat_description = '';
    public $isModalOpen = false;

    public $perPage = 10 ;
    protected $paginationTheme = 'tailwind';
    public function store()
    {        
        $data = $this->validate();
        try {
        CategoryModel::create([
            'cat_title' => $this->cat_title,
            'cat_description' => $this->cat_description,
        ]);                    
        $this->reset(['cat_title', 'cat_description']);
        $this->isModalOpen = false;
        $this->dispatch('notice', type: 'info', text: 'Category added successfully!');
    } catch (UniqueConstraintViolationException $e) {
        $this->dispatch('notice', type: 'error', text: 'A category with this title already exists!');
    }


    }
    public function openModal()
    {
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->reset(['cat_title', 'cat_description']);
    }
    
    public function render()
    {
        $categories = CategoryModel::paginate($this->perPage);
        return view('livewire.admin.category.manage-category')->with(compact('categories'));
    }

    public function destroy($id)
    {
        $category = CategoryModel::find($id);
        if ($category) {
            $category->delete();
            $this->dispatch('notice', type: 'info', text: 'Category deleted successfully!');
        }
        
    }
    
}
