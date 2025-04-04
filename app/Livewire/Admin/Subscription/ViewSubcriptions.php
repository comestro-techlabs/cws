<?php

namespace App\Livewire\Admin\Subscription;

use App\Models\Subscription;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
#[Title('View Subscription Plans')]
class ViewSubcriptions extends Component
{
    public $subscriptions;
    public $search = '';
    public function mount(){
        $this->subscriptions = Subscription::all();
    }
 

    public function render()
    {

        return view('livewire.admin.subscription.view-subcriptions');
    }
}
