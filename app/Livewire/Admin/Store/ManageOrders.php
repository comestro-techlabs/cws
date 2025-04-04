<?php

namespace App\Livewire\Admin\Store;

use Livewire\Component;
use App\Models\Order;
use App\Models\Orders;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;

class ManageOrders extends Component
{
    public $activeTab = 'pending';
    public $showModal = false;
    public $selectedOrder = null;
    public $pendingOrders;
    public $confirmedOrders;
    
    #[On('refreshOrders')]
    public function mount(){
        $this->pendingOrders = Orders::with('product','user', 'shippingDetail')->where('status', 'pending')->get();
        // dd( $this->pendingOrders);
        $this->confirmedOrders = Orders::with('product', 'user', 'shippingDetail')->where('status', 'completed')->get();
    }
    public function changeTab($tab)
    {
        $this->activeTab = $tab;
    }
    public function selectOrder($orderId)
    {
        $this->selectedOrder = Orders::with('product')->find($orderId);
        $this->showModal = true;
    }
    
    public function fulfillOrder()
    {
        if ($this->selectedOrder && $this->selectedOrder->status === 'pending') {
            $this->selectedOrder->status = 'completed';
            $this->selectedOrder->save();
            $this->showModal = false;
            $this->selectedOrder = null;
            // session()->flash('message', 'Order fulfilled successfully!');
            $this->dispatch('refreshOrders')->self();
        }
    }
    
    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedOrder = null;
    }
    #[Layout('components.layouts.admin')]
    #[Title('Manage Orders')]
    public function render()
    {
        return view('livewire.admin.store.manage-orders');
    }
}

