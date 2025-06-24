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

    public function downloadInvoice()
    {
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('livewire.student.billing.show-billing-pdf', ['payment' => $this->payment]);
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'Invoice_' . ($this->payment->order_id ?? $this->payment->id) . '.pdf');
    }

    public function render()
    {
        return view('livewire.student.billing.show-billing');
    }
}
