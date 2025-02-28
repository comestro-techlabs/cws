<?php

namespace App\Livewire\Admin\Portfolio;

use Livewire\Component;
use App\Models\Portfolio;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Storage;

#[Layout('components.layouts.admin')]
#[Title('Manage Portfolio')]

class ManagePortfolio extends Component
{
    use WithFileUploads;

    public $portfolios;
    public $portfolioId;
    public $title;
    public $url;
    public $image;
    public $existingImage;
    public $description;
    public $isEditing = false;

    #[Layout('components.layouts.admin')]
    public function mount()
    {
        $this->portfolios = Portfolio::all();
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->portfolioId = null;
        $this->title = '';
        $this->url = '';
        $this->image = null;
        $this->existingImage = null;
        $this->description = '';
        $this->isEditing = false;
    }

    public function edit($id)
    {
        $portfolio = Portfolio::find($id);
        if ($portfolio) {
            $this->portfolioId = $portfolio->id;
            $this->title = $portfolio->title;
            $this->url = $portfolio->url;
            $this->existingImage = $portfolio->image;
            $this->description = $portfolio->description;
            $this->isEditing = true;
        }
    }

    public function save()
    {
        $this->validate([
            'title' => 'required',
            'url' => 'required|url',
            'description' => 'required',
            'image' => !$this->isEditing ? 'required|image|max:2048' : 'nullable|image|max:2048',
        ]);

        $data = [
            'title' => $this->title,
            'url' => $this->url,
            'description' => $this->description,
        ];

        if ($this->image) {
            if ($this->isEditing && $this->existingImage) {
                Storage::disk('public')->delete($this->existingImage); 
            }
            $data['image'] = $this->image->store('portfolio', 'public'); 
        } elseif ($this->isEditing && $this->existingImage) {
            $data['image'] = $this->existingImage; 
        }

        if ($this->isEditing) {
            Portfolio::find($this->portfolioId)->update($data);
            session()->flash('message', 'Portfolio updated successfully');
        } else {
            Portfolio::create($data);
            session()->flash('message', 'Portfolio created successfully');
        }

        $this->portfolios = Portfolio::all();
        $this->resetForm();
    }

    public function delete($id)
    {
        $portfolio = Portfolio::find($id);
        if ($portfolio && $portfolio->image) {
            Storage::disk('public')->delete($portfolio->image);
        }
        $portfolio?->delete();
        $this->portfolios = Portfolio::all();
    }

    public function render()
    {
        return view('livewire.admin.portfolio.manage-portfolio');
    }
}