<?php

namespace App\Livewire\Public\Workshops;

use App\Models\Payment;
use App\Models\Workshop as ModelsWorkshop;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\Log;
use Razorpay\Api\Api;

class Workshop extends Component
{
    public $workshops, $user_id, $userPayments;

    public function mount()
    {
        $this->workshops = ModelsWorkshop::get();
        $this->user_id = Auth::id();
        $this->userPayments = Payment::where("student_id", $this->user_id)
            ->where("status", "captured")
            ->pluck('workshop_id')
            ->toArray();
    }

    public function enrollWorkshop($workshopId)
    {
        try {
            $workshop = ModelsWorkshop::findOrFail($workshopId);
            $receipt_no = 'WS_' . time();

            $payment = Payment::create([
                'student_id' => auth()->id(),
                'workshop_id' => $workshopId,
                'receipt_no' => $receipt_no,
                'total_amount' => $workshop->fees,
                'status' => 'pending',
                'payment_status' => 'initiated',
                'ip_address' => request()->ip(),
            ]);

            return $this->dispatch('initiateWorkshopPayment', [
                'workshop_id' => $workshopId,
                'amount' => $workshop->fees,
                'payment_id' => $payment->id,
                'receipt_no' => $receipt_no
            ]);
        } catch (\Exception $e) {
            Log::error('Workshop enrollment error: ' . $e->getMessage());
            session()->flash('error', 'Failed to initiate enrollment');
        }
    }

    public function initiatePayment($workshopId)
    {
        try {
            $workshop = ModelsWorkshop::findOrFail($workshopId);
            $receipt = 'WS_' . time();

            $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
            
            $order = $api->order->create([
                'amount' => $workshop->fees * 100,
                'currency' => 'INR',
                'receipt' => $receipt,
                'payment_capture' => 1
            ]);

            // Create initial payment record
            $payment = Payment::create([
                'student_id' => auth()->id(),
                'workshop_id' => $workshopId,
                'receipt_no' => $receipt,
                'total_amount' => $workshop->fees,
                'status' => 'pending',
                'payment_status' => 'initiated',
                'order_id' => $order->id
            ]);

            return $this->dispatch('initializePayment', [
                'key' => config('services.razorpay.key'),
                'amount' => $workshop->fees * 100,
                'order_id' => $order->id,
                'payment_id' => $payment->id,
                'workshop_title' => $workshop->title
            ]);

        } catch (\Exception $e) {
            return $this->dispatch('showError', message: 'Payment initialization failed: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.public.workshops.workshop');
    }
}
