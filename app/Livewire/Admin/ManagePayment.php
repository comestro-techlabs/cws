<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\Payment;
use Livewire\WithPagination;

class ManagePayment extends Component
{
    use WithPagination;

    public $search = '';

    public function updatedSearch()
    {
        $this->resetPage(); // Reset pagination when search changes
    }

    #[Layout('components.layouts.admin')]
    public function render()
    {
        $query = Payment::with(['student', 'course'])
            ->where('status', 'captured');

        if (!empty($this->search)) {
            $query->whereHas('student', function ($studentQuery) {
                $studentQuery->where('name', 'LIKE', "%{$this->search}%");
            });
        }

        $payments = $query->latest('payment_date')->paginate(10);

        return view('livewire.admin.manage-payment', [
            'payments' => $payments
        ]);
    }
}