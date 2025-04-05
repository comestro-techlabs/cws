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

            $payment = Payment::create([
                'student_id' => auth()->id(),
                'workshop_id' => $workshopId,
                'receipt_no' => $receipt,
                'total_amount' => $workshop->fees,
                'status' => 'pending',
                'payment_status' => 'initiated',
                'order_id' => $order->id
            ]);

            Log::info('Payment created with ID: ' . $payment->id);

            return $this->dispatch('initWorkshopPayment', [ // Changed event name for clarity
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

    public function handlePaymentSuccess($response)
    {
        Log::info('handlePaymentSuccess called with response:', $response);

        try {
            $payment = Payment::where('order_id', $response['razorpay_order_id'])->first();
            if (!$payment) {
                Log::error('Payment not found for order_id: ' . $response['razorpay_order_id']);
                return $this->dispatch('showError', message: 'Payment record not found.');
            }

            $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
            $attributes = [
                'razorpay_signature' => $response['razorpay_signature'],
                'razorpay_payment_id' => $response['razorpay_payment_id'],
                'razorpay_order_id' => $response['razorpay_order_id']
            ];

            $api->utility->verifyPaymentSignature($attributes);
            Log::info('Payment signature verified successfully');

            $updated = $payment->update([
                'status' => 'captured',
                'payment_status' => 'completed',
                'razorpay_payment_id' => $response['razorpay_payment_id'],
                'razorpay_order_id' => $response['razorpay_order_id'],
                'razorpay_signature' => $response['razorpay_signature'],
                'payment_date' => now()
            ]);

            if ($updated) {
                Log::info('Payment updated successfully:', $payment->fresh()->toArray());
            } else {
                Log::error('Failed to update payment for order_id: ' . $response['razorpay_order_id']);
                return $this->dispatch('showError', message: 'Failed to update payment status.');
            }

            $this->userPayments = Payment::where("student_id", $this->user_id)
                ->where("status", "captured")
                ->pluck('workshop_id')
                ->toArray();
            Log::info('Updated userPayments:', $this->userPayments);

            session()->flash('message', 'Payment successful! You are now enrolled in the workshop.');
            $this->dispatch('paymentCompleted');
        } catch (\Exception $e) {
            Log::error('Payment handling error: ' . $e->getMessage());
            $this->dispatch('showError', message: 'Failed to process payment: ' . $e->getMessage());
        }
    }
    #[On('redirectToDashboard')]
    public function redirectToDashboard()
    {
        return redirect()->route('public.index')->with('success', 'You have successfully enrolled in the Workshop.');
    }
    public function share($workshopId)
    {
        $workshop = ModelsWorkshop::find($workshopId);

        if ($workshop) {
            $shareUrl = route('workshops.view', $workshop->id); 
            $imageUrl = asset('storage/' . $workshop->image);
            $title = $workshop->title ?? 'Untitled Workshop';
            
            $data = [
                'url' => $shareUrl,
                'title' => $title,
                'image' => $imageUrl,
                
            ];

            Log::info('Dispatching shareWorkshop event', $data);

            $this->dispatch('shareWorkshop', $data); // Changed event name to 'shareWorkshop'
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