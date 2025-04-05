<?php

namespace App\Livewire\Public\Workshops;

use App\Models\Payment;
use App\Models\Workshop as ModelsWorkshop;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Support\Facades\Log;
use Razorpay\Api\Api;
use Str;

class Workshop extends Component
{
    public $workshops, $user_id, $userPayments, $shareMessage;

    public function mount()
    {
        $this->workshops = ModelsWorkshop::get();
        $this->user_id = Auth::id();
        $this->userPayments = Payment::where("student_id", $this->user_id)
            ->where("status", "captured")
            ->pluck('workshop_id')
            ->toArray();

        // Check for pending payments and initiate on load
        $pendingPayment = Payment::where('student_id', $this->user_id)
            ->where('status', 'pending')
            ->where('payment_status', 'initiated')
            ->first();

        if ($pendingPayment) {
            $this->initiatePayment($pendingPayment->workshop_id);
        }
    }

    public function initiatePayment($workshopId)
    {
        try {
            if (in_array($workshopId, $this->userPayments)) {
                return $this->dispatch('showError', message: 'You have already enrolled in this workshop.');
            }

            $workshop = ModelsWorkshop::findOrFail($workshopId);
            $receipt = 'WS_' . time();

            $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

            $order = $api->order->create([
                'amount' => $workshop->fees * 100,
                'currency' => 'INR',
                'receipt' => $receipt,
                'payment_capture' => 1
            ]);

            $payment = Payment::updateOrCreate(
                ['order_id' => $order->id],
                [
                    'student_id' => auth()->id(),
                    'workshop_id' => $workshopId,
                    'receipt_no' => $receipt,
                    'total_amount' => $workshop->fees,
                    'status' => 'pending',
                    'payment_status' => 'initiated',
                ]
            );

            Log::info('Payment created/updated with ID: ' . $payment->id);

            return $this->dispatch('initWorkshopPayment', [
                'key' => config('services.razorpay.key'),
                'amount' => (int)($workshop->fees * 100),
                'order_id' => $order->id,
                'payment_id' => $payment->id,
                'workshop_title' => $workshop->title,
                'prefill' => [
                    'name' => Auth::user()->name,
                    'email' => Auth::user()->email
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('Initiate payment error: ' . $e->getMessage());
            return $this->dispatch('showError', message: 'Payment initialization failed: ' . $e->getMessage());
        }
    }

    #[On('handlePaymentSuccess')]
    public function handlePaymentSuccess($response)
    {
        try {
            $payment = Payment::where('order_id', $response['razorpay_order_id'])->firstOrFail();
            $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
            $api->utility->verifyPaymentSignature([
                'razorpay_signature' => $response['razorpay_signature'],
                'razorpay_payment_id' => $response['razorpay_payment_id'],
                'razorpay_order_id' => $response['razorpay_order_id']
            ]);

            $payment->update([
                'status' => 'captured',
                'payment_status' => 'completed',
                'razorpay_payment_id' => $response['razorpay_payment_id'],
                'razorpay_order_id' => $response['razorpay_order_id'],
                'razorpay_signature' => $response['razorpay_signature'],
                'payment_date' => now()
            ]);

            $this->userPayments = Payment::where("student_id", $this->user_id)
                ->where("status", "captured")
                ->pluck('workshop_id')
                ->toArray();

            session()->flash('message', 'Payment successful! You are now enrolled in the workshop.');
            $this->dispatch('paymentCompleted');
            $this->dispatch('redirectToDashboard');
        } catch (\Exception $e) {
            Log::error('Payment handling error: ' . $e->getMessage());
            $this->dispatch('showError', message: 'Failed to process payment: ' . $e->getMessage());
        }
    }

    #[On('handlePaymentFailed')]
    public function handlePaymentFailed($data)
    {
        try {
            $payment = Payment::where('order_id', $data['order_id'])->firstOrFail();
            $payment->update([
                'status' => 'failed',
                'payment_status' => 'failed',
                'error_description' => $data['error']['description'] ?? 'Payment failed'
            ]);

            $this->dispatch('paymentStatusUpdate', ['status' => 'Failed']);
        } catch (\Exception $e) {
            Log::error('Handle payment failed error: ' . $e->getMessage());
            $this->dispatch('showError', message: 'Error updating failed payment: ' . $e->getMessage());
        }
    }

    #[On('redirectToDashboard')]
    public function redirectToDashboard()
    {
        return redirect()->route('student.dashboard')->with('success', 'You have successfully enrolled in the Workshop.');
    }

    public function share($workshopId)
    {
        $workshop = ModelsWorkshop::find($workshopId);
        if ($workshop) {
            $shareUrl = route('workshops.view', $workshop->id);
            $imageUrl = asset('storage/' . $workshop->image);
            $title = $workshop->title ?? 'Untitled Workshop';

            $this->dispatch('shareWorkshop', [
                'url' => $shareUrl,
                'title' => $title,
                'image' => $imageUrl,
            ]);
            $this->shareMessage = "Link for '{$title}' ready to share!";
        } else {
            $this->shareMessage = 'Workshop not found.';
        }
    }

    public function render()
    {
        return view('livewire.public.workshops.workshop');
    }
}