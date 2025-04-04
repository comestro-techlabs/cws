<?php

namespace App\Livewire\Student\Billing;

use Livewire\Component;
use App\Models\Payment;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.student')]
class ShowBilling extends Component
{
    public $payment;

    public function mount($paymentId)
    {
        $this->payment = Payment::with(['course', 'workshop'])
            ->where('id', $paymentId)
            ->where('student_id', auth()->id())
            ->firstOrFail();
    }

    public function render()
    {
        return view('livewire.student.billing.show-billing');
    }
}
