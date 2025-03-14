<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\Payment;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Carbon\Carbon;

class SubscriptionController extends Controller
{
    public function process(Request $request)
    {
        try {
            $payment = Payment::where('order_id', $request->razorpay_order_id)->firstOrFail();
            
            $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
            
            $attributes = [
                'razorpay_signature' => $request->razorpay_signature,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_order_id' => $request->razorpay_order_id
            ];
            
            $api->utility->verifyPaymentSignature($attributes);

            // Update payment record
            $payment->update([
                'payment_id' => $request->razorpay_payment_id,
                'transaction_id' => $request->razorpay_payment_id,
                'status' => 'captured',
                'payment_status' => 'completed',
                'payment_date' => now()
            ]);
            
            // Cancel any existing active subscriptions
            Subscription::where('user_id', auth()->id())
                ->where('status', 'active')
                ->update(['status' => 'cancelled']);

            // Create new subscription record
            $subscription = Subscription::create([
                'user_id' => auth()->id(),
                'plan_id' => $request->plan_type ?? 1, // Default to basic plan if not specified
                'starts_at' => now(),
                'ends_at' => now()->addDays($request->duration ?? 30), // Default to 30 days if not specified
                'status' => 'active',
                'payment_status' => 'completed',
                'payment_method' => 'razorpay',
                'transaction_id' => $request->razorpay_payment_id
            ]);

            // Update user's status
            auth()->user()->update([
                'is_active' => true,
                'is_member' => true
            ]);

            // Clear subscription cache if any
            \Cache::forget('user_subscription_' . auth()->id());

            return response()->json([
                'success' => true,
                'message' => 'Subscription activated successfully'
            ]);

        } catch (\Exception $e) {
            \Log::error('Subscription error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Payment verification failed: ' . $e->getMessage()
            ], 400);
        }
    }
}
