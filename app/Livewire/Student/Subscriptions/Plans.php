<?php

namespace App\Livewire\Student\Subscriptions;
use Livewire\Component;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.student')]
class Plans extends Component
{
    public function subscribe($plan)
    {
        try {
            $plans = [
                'basic' => ['price' => 699, 'duration' => 30],
                'pro' => ['price' => 1499, 'duration' => 90],
                'premium' => ['price' => 4999, 'duration' => 365],
            ];

            // Create payment record first
            $payment = \App\Models\Payment::create([
                'student_id' => auth()->id(),
                'amount' => $plans[$plan]['price'],
                'status' => 'pending',
                'payment_status' => 'initiated',
                'month' => now()->month,
                'year' => now()->year,
            ]);

            $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
            
            $order = $api->order->create([
                'amount' => $plans[$plan]['price'] * 100,
                'currency' => 'INR',
                'receipt' => 'sub_' . time(),
                'payment_capture' => 1,
            ]);

            // Update payment with order ID
            $payment->update(['order_id' => $order->id]);

            return response()->json([
                'success' => true,
                'key' => config('services.razorpay.key'),
                'amount' => $plans[$plan]['price'] * 100,
                'order_id' => $order->id,
                'payment_id' => $payment->id,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function render()
    {
        return view('livewire.student.subscriptions.plans');
    }
}
