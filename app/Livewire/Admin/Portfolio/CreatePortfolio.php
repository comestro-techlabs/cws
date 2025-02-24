<?php
namespace App\Livewire\Admin\Portfolio;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Portfolio;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
#[Layout('components.layouts.admin')]
#[Title('Insert Portfolio')]

class CreatePortfolio extends Component
{  use WithFileUploads; 
    public $title, $image, $url, $description;
   
    protected $rules = [
        'title' => 'required|string|max:255',
        'image' => 'nullable|image|max:2048', 
        'url' => 'nullable|url',
        'description' => 'nullable|string',
    ];
    public function save()
    {
        $this->validate();

        $imagePath = $this->image ? $this->image->store('portfolio', 'public') : null;

        Portfolio::create([
            'title' => $this->title,
            'image' => $imagePath,
            'url' => $this->url,
            'description' => $this->description,
        ]);

        session()->flash('success', 'Portfolio created successfully.');

        $this->reset(); 
    }
    public function render() {
        return view('livewire.admin.portfolio.create-portfolio');
    }
}
