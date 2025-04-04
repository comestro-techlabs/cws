<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\SubscriptionPlan;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Razorpay\Api\Api;

class SubscriptionController extends Controller
{
    public function process(Request $request)
    {
        try {
            $payment = Payment::findOrFail($request->payment_id);
            
            // Find the plan by slug
            $plan = SubscriptionPlan::where('slug', $request->plan_type)->firstOrFail();
            
            // Verify payment signature
            $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
            $attributes = [
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature' => $request->razorpay_signature
            ];
            $api->utility->verifyPaymentSignature($attributes);

            // Update payment record
            $payment->update([
                'status' => 'captured',
                'payment_status' => 'completed',
                'payment_id' => $request->razorpay_payment_id,
                'transaction_id' => $request->razorpay_payment_id,
                'payment_date' => now()
            ]);

            // Create subscription
            $startDate = now();
            $endDate = $startDate->copy()->addDays($plan->duration_in_days);

            Subscription::create([
                'user_id' => auth()->id(),
                'plan_id' => $plan->id, // Use plan ID instead of slug
                'starts_at' => $startDate,
                'ends_at' => $endDate,
                'status' => 'active',
                'payment_status' => 'completed',
                'payment_method' => 'razorpay',
                'transaction_id' => $request->razorpay_payment_id
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Payment processed successfully'
            ]);

        } catch (\Exception $e) {
            \Log::error('Payment processing error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Payment processing failed: ' . $e->getMessage()
            ]);
        }
    }
}
