<?php

namespace App\Livewire\Student\Dashboard\Product;

use App\Models\Orders;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

class MyOrders extends Component
{   public $orders;
    public $user_id;

    public function mount(){
        $this->user_id = Auth::id();
        $this->orders = Orders::with('shippingDetail')->where('user_id',$this->user_id)->get();
        // dd($this->orders);
    }
    #[Layout('components.layouts.student')]
    public function render()
    {
        return view('livewire.student.dashboard.product.my-orders');
    }
} 
