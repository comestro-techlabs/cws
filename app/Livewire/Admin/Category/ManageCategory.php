<?php

namespace App\Livewire\Admin\Category;

use Livewire\Component;
use App\Models\Category as CategoryModel;
use Livewire\Attributes\Validate;
use Livewire\WithPagination;
use Illuminate\Database\UniqueConstraintViolationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Illuminate\Validation\Rule; 

#[Layout('components.layouts.admin')]
#[Title('Single View Assignment')]   
class ManageCategory extends Component
{
    use WithPagination;

    public $cat_title = '';
    public $cat_description = '';
    public $isModalOpen = false;
    public $editingCategoryId = null;
    public $perPage = 10;
    public $search = ''; 

    protected $paginationTheme = 'tailwind';


protected function rules()
{
    return [
        'cat_title' => [
            'required', 
            'string', 
            Rule::unique('categories', 'cat_title')->ignore($this->editingCategoryId)
        ],
        'cat_description' => 'required|string',
    ];
}

    public function storeOrUpdate()
    {        
        $this->validate();
    
        if ($this->editingCategoryId) {
            // Update existing category
            $category = CategoryModel::find($this->editingCategoryId);
            if ($category) {
                $category->update([
                    'cat_title' => $this->cat_title,
                    'cat_description' => $this->cat_description,
                ]);
                $this->dispatch('notice', type: 'info', text: 'Category updated successfully!');
            }
        } else {
            // Create new category
            CategoryModel::create([
                'cat_title' => $this->cat_title,
                'cat_description' => $this->cat_description,
            ]);                    
            $this->dispatch('notice', type: 'info', text: 'Category added successfully!');
        }
    
        $this->resetForm();
    }
    public function edit($id)
{
    $category = CategoryModel::find($id);
    
    if ($category) {
        $this->editingCategoryId = $category->id;
        $this->cat_title = $category->cat_title;
        $this->cat_description = $category->cat_description;
        $this->isModalOpen = true;
    }
}

    public function destroy($id)
    {
        $category = CategoryModel::find($id);
        if ($category) {
            $category->delete();
            $this->dispatch('notice', type: 'info', text: 'Category deleted successfully!');
        }
    }

    public function openModal()
    {
        $this->resetForm();
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->reset(['cat_title', 'cat_description', 'editingCategoryId', 'isModalOpen']);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $categories = CategoryModel::where('cat_title', 'like', '%' . $this->search . '%')
            ->orWhere('cat_description', 'like', '%' . $this->search . '%')
            ->paginate($this->perPage);

        return view('livewire.admin.category.manage-category', compact('categories'));
    }

    
}