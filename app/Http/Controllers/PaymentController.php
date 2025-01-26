<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\User;
use App\Models\Payment;
use App\Models\Workshop;
use Exception;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{


//it's of no use
    public function saveWorkshopPayment(Request $request)
    {
        $input = $request->all();

        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        $payment = $api->payment->fetch($input['razorpay_payment_id']);
        if (!empty($input['razorpay_payment_id'])) {
            $response = $api->payment->fetch($input['razorpay_payment_id'])->capture([
                'amount' => $payment['amount'],
            ]);
        } else {
            throw new Exception("Payment ID is empty.");
        }

        $student = Auth::user();
        $order = time() . $student->id . $request->input('amount');

        $payment = Payment::create([
            'workshop_id' => $request->input('workshop_id'),
            'student_id' => $student->id,
            'receipt_no' => time() . $student->id,
            'order_id' => $order,
            'payment_id' => $request->razorpay_payment_id,
            'amount' => $request->input('amount'),
            'transaction_id' => time() . rand(11, 99) . date('yd'),
            'transaction_date' => now(),
            'payment_date' => now(),
            'payment_status' => $response->status,
            'payment_card_id' => $response->card_id,
            'method' => $response->method,
            'wallet' => $response->wallet,
            'payment_vpa' => $response->vpa,
            'ip_address' => $request->ip(),
            'international_payment' => $response->international,
            'error_reason' => $response->error_reason,
            'status' => 1,
        ]);

        if ($payment) {
            return redirect('/workshops')->with('success', 'Payment Successful');
        } else {
            return redirect()->back()->with('error', 'Something Went Wrong.');
        }
    }

    public function initiatePayment(Request $request)
{
    // Check if workshop_id is present, else fall back to course_id
    $workshopId = $request->workshop_id ?? null;
    $courseId = $request->course_id ?? null;

    // Ensure either workshop_id or course_id is provided
    if (!$workshopId && !$courseId) {
        return response()->json([
            'success' => false,
            'message' => 'Either course_id or workshop_id is required.'
        ]);
    }

    // Create a payment record in the payments table
    $payment = Payment::create([
        'student_id' => $request->student_id,
        'course_id' => $courseId,
        'workshop_id' => $workshopId,
        'amount' => $request->amount,
        'receipt_no' => $request->receipt_no,
        'transaction_fee' => $request->amount, // Use appropriate fee if needed
        'transaction_date' => now()->toDateTimeString(),
        'ip_address' => $request->ip_address,
        'payment_status' => 'initiated',
    ]);

    // Initialize Razorpay API
    $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

    // Prepare Razorpay order details
    $orderData = [
        'amount' => $request->amount * 100, // Razorpay expects amount in paise
        'currency' => 'INR',
        'receipt' => $payment->receipt_no,
        'payment_capture' => 1, // auto-capture the payment
    ];

    try {
        $order = $api->order->create($orderData);

        // Update the payment record with Razorpay order ID
        $payment->update([
            'order_id' => $order->id,
        ]);

        return response()->json([
            'success' => true,
            'order_id' => $order->id,
            'payment_id' => $payment->id,  // You can send the payment ID back for frontend reference
        ]);
    } catch (\Exception $e) {
        // Handle error if Razorpay order creation fails
        $payment->update([
            'payment_status' => 'failed',
            'error_reason' => $e->getMessage(),
        ]);

        return response()->json([
            'success' => false,
            'message' => 'Error creating Razorpay order: ' . $e->getMessage()
        ]);
    }
}
public function handlePaymentResponse(Request $request)
{
    // Retrieve payment details from the request
    $payment_id = $request->payment_id;
    $razorpay_payment_id = $request->razorpay_payment_id;
    $razorpay_order_id = $request->razorpay_order_id;
    $razorpay_signature = $request->razorpay_signature;

    // Retrieve the payment record using the payment ID
    $payment = Payment::findOrFail($payment_id);

    // Initialize Razorpay API
    $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

    // Verify the payment signature
    $attributes = [
        'razorpay_order_id' => $razorpay_order_id,
        'razorpay_payment_id' => $razorpay_payment_id,
        'razorpay_signature' => $razorpay_signature,
    ];

    $api->utility->verifyPaymentSignature($attributes);
    $razorpayPayment = $api->payment->fetch($razorpay_payment_id);

    // Update payment record based on payment status
    $payment->update([
        'payment_id' => $razorpay_payment_id,
        'transaction_id' => $razorpay_payment_id,
        'method' => $razorpayPayment->method,
        'payment_status' => 'completed', // Set payment status as completed
        'status' => 'captured', // Set the status as captured
        'payment_date' => now(),
    ]);

    // Check if payment is captured and associate the user with course or workshop
    if ($payment->status === 'captured') {
        // If it's for a course
        if ($payment->course_id) {
            DB::table('course_user')->insert([
                'course_id' => $payment->course_id,
                'user_id' => $payment->student_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // If it's for a workshop
        if ($payment->workshop_id) {
            DB::table('workshop_user')->insert([
                'workshop_id' => $payment->workshop_id,
                'user_id' => $payment->student_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    return response()->json([
        'success' => true,
        'message' => 'Payment processed successfully.',
    ]);
}


public function refreshPaymentStatus(Request $request)
{
    $orderId = $request->order_id; // The order_id passed from the frontend

    // Use Razorpay API to fetch payments associated with the order_id
    try {
        $response = Http::withBasicAuth(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'))
            ->get("https://api.razorpay.com/v1/orders/{$orderId}/payments");

        $paymentData = $response->json();

        // Check if the API returned any payments
        if (isset($paymentData['items']) && count($paymentData['items']) > 0) {
            // Assume we have only one payment record for this order
            $payment = $paymentData['items'][0];  // Only one payment in the response for the order

            // Find the payment record in the database using the order_id
            $paymentRecord = Payment::where('order_id', $orderId)->first();

            if ($paymentRecord) {
                // Update the payment record with the latest data from Razorpay
                $paymentRecord->status = $payment['status'];
                $paymentRecord->payment_id = $payment['id'];  // Save Razorpay payment ID
                $paymentRecord->transaction_id = $payment['id'];  // Save the transaction ID
                $paymentRecord->transaction_date = now();  // Update with the current date
                $paymentRecord->error_reason = $payment['error_description'] ?? null;  // Handle errors if any
                $paymentRecord->save();

                // Check if payment status is 'captured'
                if ($payment['status'] == 'captured') {
                    // Insert into course_user or workshop_user table
                    if ($paymentRecord->course_id) {
                        DB::table('course_user')->insert([
                            'course_id' => $paymentRecord->course_id,
                            // 'user_id' => $paymentRecord->student_id,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }

                    if ($paymentRecord->workshop_id) {
                        DB::table('workshop_user')->insert([
                            'workshop_id' => $paymentRecord->workshop_id,
                            // 'user_id' => $paymentRecord->student_id,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }

                return response()->json([
                    'success' => true,
                    'message' => 'Payment record updated successfully',
                    'data' => $paymentRecord
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Payment record not found for the given order ID'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'No payments found for the given order ID'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error occurred while refreshing payment status: ' . $e->getMessage()
        ]);
    }
}
}
