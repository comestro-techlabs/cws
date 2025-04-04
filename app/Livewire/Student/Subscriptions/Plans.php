<?php

namespace App\Livewire\Student\Subscriptions;
use Livewire\Component;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Auth;
use App\Models\SubscriptionPlan;
use App\Models\Payment;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Log;

#[Layout('components.layouts.student')]
class Plans extends Component
{
    public $plans;

    public function mount()
    {
        $this->plans = SubscriptionPlan::where('is_active', true)->get();
    }

    public function subscribe($planSlug)
    {
        try {
            Log::info('Subscribe method called with plan: ' . $planSlug); // Add logging

            $plan = SubscriptionPlan::where('slug', $planSlug)
                ->where('is_active', true)
                ->firstOrFail();

            Log::info('Plan found:', $plan->toArray()); // Log plan details

            $receipt = 'SUB_' . time();
            // dd($plan->price);
            // Create payment record
            $payment = Payment::create([
                'student_id' => auth()->id(),
                'amount' => $plan->price,
                'total_amount' => $plan->price,
                'transaction_fee' => 0,
                'status' => 'pending',
                'payment_status' => 'initiated',
                'payment_type' => 'subscription',
                'receipt_no' => $receipt,
                'month' => now()->month,
                'year' => now()->year,
            ]);

            Log::info('Payment record created:', $payment->toArray()); // Log payment details

            $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
            
            $orderData = [
                'amount' => $plan->price * 100,
                'currency' => 'INR',
                'receipt' => $receipt,
                'payment_capture' => 1
            ];

            Log::info('Creating Razorpay order with data:', $orderData); // Log order data

            $razorpayOrder = $api->order->create($orderData);
            Log::info('Razorpay order created:', (array)$razorpayOrder); // Log Razorpay response

            // Update payment with order ID
            $payment->update(['order_id' => $razorpayOrder->id]);

            $eventData = [
                'key' => config('services.razorpay.key'),
                'amount' => $plan->price * 100,
                'order_id' => $razorpayOrder->id,
                'payment_id' => $payment->id,
                'plan_type' => $plan->slug,
                'duration' => $plan->duration_in_days,
                'name' => auth()->user()->name,
                'email' => auth()->user()->email,
                'description' => "Subscription - {$plan->name}"
            ];

            Log::info('Dispatching event with data:', $eventData); // Log event data
            return $this->dispatch('initSubscriptionPayment', [
                'key' => config('services.razorpay.key'),
                'amount' => $plan->price * 100,
                'order_id' => $razorpayOrder->id,
                'payment_id' => $payment->id,
                'plan_type' => $plan->slug,
                'duration' => $plan->duration_in_days,
                'name' => auth()->user()->name,
                'email' => auth()->user()->email
            ]);

        } catch (\Exception $e) {
            Log::error('Subscription error: ' . $e->getMessage()); // Log any errors
            return $this->dispatch('showError', ['message' => 'Failed to create subscription: ' . $e->getMessage()]);
        }
    }

    public function render()
    {
        return view('livewire.student.subscriptions.plans', [
            'subscriptionPlans' => $this->plans
        ]);
    }
}
