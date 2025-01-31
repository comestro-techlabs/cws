<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\User;
use App\Models\Payment;
use App\Models\Workshop;
use Carbon\Carbon;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    private function getRazorpayApi()
    {
        return new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
    }

    private function verifyRazorpaySignature($attributes)
    {
        try {
            $api = $this->getRazorpayApi();
            $api->utility->verifyPaymentSignature($attributes);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function initiatePayment(Request $request)
    {
        $workshopId = $request->workshop_id ?? null;
        $courseId = $request->course_id ?? null;
        $studentId = $request->student_id;
        $amount = $request->amount;

        $currentMonth = Carbon::now()->month;
        $year = Carbon::now()->year;

        // Check for existing pending payment
        $existingPayment = Payment::where('student_id', $studentId)
            ->where('amount', $amount)
            ->whereIn('payment_status', ['initiated', 'captured', 'pending'])
            ->first();

        if ($existingPayment) {
            return response()->json([
                'success' => false,
                'message' => 'A similar payment is already in progress.',
                'payment_id' => $existingPayment->id,
                'order_id' => $existingPayment->order_id,
            ], 400);
        }

        // Create a payment record
        $payment = Payment::create([
            'student_id' => $studentId,
            'course_id' => $courseId,
            'workshop_id' => $workshopId,
            'amount' => $amount,
            'receipt_no' => $request->receipt_no,
            'transaction_fee' => $amount, // You can change this if needed
            'transaction_date' => now()->toDateTimeString(),
            'ip_address' => $request->ip_address,
            'payment_status' => 'initiated',
            'month' => $currentMonth,
            'year' => $year,
        ]);

        // Initialize Razorpay and create the order
        try {
            $api = $this->getRazorpayApi();
            $orderData = [
                'amount' => $amount * 100, // Razorpay expects the amount in paise
                'currency' => 'INR',
                'receipt' => $payment->receipt_no,
                'payment_capture' => 1, // Auto-capture the payment
            ];

            $order = $api->order->create($orderData);

            // Update the payment with Razorpay order ID
            $payment->update([
                'order_id' => $order->id,
            ]);

            // Handle membership for non-course/non-workshop payments
            if (is_null($workshopId) && is_null($courseId)) {
                User::findOrFail($studentId)->update(['is_member' => 1]);
            }

            return response()->json([
                'success' => true,
                'order_id' => $order->id,
                'payment_id' => $payment->id,
            ]);
        } catch (\Exception $e) {
            $payment->update([
                'payment_status' => 'failed',
                'error_reason' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Error creating Razorpay order: ' . $e->getMessage(),
            ]);
        }
    }

            public function handlePaymentResponse(Request $request)
            {
                $paymentId = $request->payment_id;
                $razorpayPaymentId = $request->razorpay_payment_id;
                $razorpayOrderId = $request->razorpay_order_id;
                $razorpaySignature = $request->razorpay_signature;

                $payment = Payment::findOrFail($paymentId);

                $attributes = [
                    'razorpay_order_id' => $razorpayOrderId,
                    'razorpay_payment_id' => $razorpayPaymentId,
                    'razorpay_signature' => $razorpaySignature,
                ];

                if (!$this->verifyRazorpaySignature($attributes)) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Payment verification failed',
                    ], 400);
                }

                try {
                    $api = $this->getRazorpayApi();
                    $razorpayPayment = $api->payment->fetch($razorpayPaymentId);

                    $payment->update([
                        'payment_id' => $razorpayPaymentId,
                        'transaction_id' => $razorpayPaymentId,
                        'method' => $razorpayPayment->method,
                        'payment_status' => 'completed',
                        'status' => 'captured',
                        'payment_date' => now(),
                    ]);

                    // Handle membership and future payments for membership
                    if (is_null($payment->course_id) && is_null($payment->workshop_id)) {
                        $user = User::findOrFail($payment->student_id);
                        $user->update(['is_member' => 1]);
                        $this->createFuturePayments($payment);
                    }

                    return response()->json([
                        'success' => true,
                        'message' => 'Payment processed successfully.',
                    ]);
                } catch (\Exception $e) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Payment verification failed: ' . $e->getMessage(),
                    ], 400);
                }
            catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Payment verification failed: ' . $e->getMessage(),
            ], 400);
        }
    }

    private function createFuturePayments($payment)
{
    $currentDate = Carbon::now();

    // Generate future payments for the next 12 months
    for ($i = 1; $i <= 12; $i++) {
        $futureDate = $currentDate->copy()->addMonths($i);
        $month = $futureDate->month;
        $year = $futureDate->year;

        $existingPayment = Payment::where('student_id', $payment->student_id)
            ->where('month', $month)
            ->where('year', $year)
            ->first();

        if (!$existingPayment) {
            Payment::create([
                'student_id' => $payment->student_id,
                'amount' => $payment->amount,
                'receipt_no' => 'RCPT-' . $year . '-' . $month . '-' . $payment->student_id,
                'transaction_fee' => $payment->amount,
                'transaction_date' => Carbon::create($year, $month, 1),
                'ip_address' => request()->ip(),
                'status' => 'unpaid',
                'month' => $month,
                'year' => $year,
            ]);
        }
    }
}

    public function updatePaymentStatus(Request $request)
    {
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        $user = User::where('id', Auth::id())->first();
        // Find payment record by Razorpay order ID
        $payment = Payment::where('order_id', $request->razorpay_order_id)->first();
        if (!$payment) {
            // Create a new order if not found
            $newOrder = $api->order->create([
                'amount' => $request->amount * 100, // Convert to paise
                'currency' => 'INR',
                'receipt' => 'RCPT-' . now()->year . '-' . now()->month . '-' . now()->day,
                'payment_capture' => 1,
            ]);

            // Save the new order in the database
            $payment = Payment::create([
                'student_id' => $request->student_id,
                'amount' => $request->amount,
                'order_id' => $newOrder->id,
                'receipt_no' => $newOrder->receipt,
                'transaction_date' => now(),
                'status' => 'unpaid',
                'month' => now()->month,
                'year' => now()->year,
            ]);

            return response()->json(['success' => false, 'message' => 'New order created. Please retry payment.', 'order_id' => $newOrder->id], 400);
        }



        try {
            // Verify Razorpay signature
            $attributes = [
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature' => $request->razorpay_signature,
            ];

            $api->utility->verifyPaymentSignature($attributes);
            // dd($request->all());
            // Update payment record
            $razorpayPaymentId = $request->razorpay_payment_id;

            $razorpayPayment = $api->payment->fetch($razorpayPaymentId);

            $payment->update([
                'payment_id' => $razorpayPaymentId,
                'transaction_id' => $razorpayPaymentId,
                'method' => $razorpayPayment->method,
                'payment_status' => 'completed',
                'status' => 'captured',
                'payment_date' => now(),
            ]);
            if ($user) {
                $user->is_active = 1;
                $user->save();
            }

            return response()->json(['success' => true, 'message' => 'Payment verified and updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Payment verification failed: ' . $e->getMessage()], 400);
        }
    }


    public function createRazorpayOrder(Request $request)
    {
        try {
            // Initialize Razorpay API
            $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

            // Validate request data
            $request->validate([
                'student_id' => 'required|exists:users,id',
                'amount' => 'required|numeric|min:1',
            ]);

            // Check if an unpaid record exists for the same amount
            $payment = Payment::where('student_id', $request->student_id)
                ->where('amount', 700)
                ->whereIn('status', ['unpaid', 'due'])
                ->first();

            if (!$payment) {
                return response()->json([
                    'success' => false,
                    'message' => 'No unpaid payment record found for this student.'
                ], 400);
            }

            // Create a new Razorpay Order
            $order = $api->order->create([
                'amount' => $request->amount * 100, // Convert to paise
                'currency' => 'INR',
                'receipt' => 'RCPT-' . now()->year . '-' . now()->month . '-' . now()->day . '-' . $request->student_id,
                'payment_capture' => 1, // Auto-capture
            ]);

            // Update the payment record with the order ID
            $payment->update([
                'order_id' => $order->id,
                'receipt_no' => $order->receipt
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Razorpay order created successfully.',
                'order_id' => $order->id,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating order: ' . $e->getMessage()
            ], 500);
        }
    }




    public function refreshPaymentStatus(Request $request)
    {
        $orderId = $request->order_id;
        try {
            $response = Http::withBasicAuth(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'))
                ->get("https://api.razorpay.com/v1/orders/{$orderId}/payments");

            $paymentData = $response->json();
            if (isset($paymentData['items']) && count($paymentData['items']) > 0) {
                $payment = $paymentData['items'][0];

                $paymentRecord = Payment::where('order_id', $orderId)->first();
                if ($paymentRecord) {
                    $paymentRecord->update([
                        'status' => $payment['status'],
                        'payment_id' => $payment['id'],
                        'transaction_id' => $payment['id'],
                        'transaction_date' => now(),
                        'error_reason' => $payment['error_description'] ?? null,
                    ]);

                    // if ($payment['status'] == 'captured') {
                    // }

                    return response()->json([
                        'success' => true,
                        'message' => 'Payment record updated successfully',
                        'data' => $paymentRecord
                    ]);
                }
                return response()->json(['success' => false, 'message' => 'Payment record not found'], 404);
            }

            return response()->json(['success' => false, 'message' => 'No payments found'], 404);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error occurred: ' . $e->getMessage()], 500);
        }
    }

    // private function updateCourseAndWorkshop($paymentRecord)
    // {
    //     if ($paymentRecord->course_id) {
    //         DB::table('course_user')->insert([
    //             'course_id' => $paymentRecord->course_id,
    //             'created_at' => now(),
    //             'updated_at' => now(),
    //         ]);
    //     }

    //     if ($paymentRecord->workshop_id) {
    //         DB::table('workshop_user')->insert([
    //             'workshop_id' => $paymentRecord->workshop_id,
    //             'created_at' => now(),
    //             'updated_at' => now(),
    //         ]);
    //     }
    // }
}
