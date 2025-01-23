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

class PaymentController extends Controller
{


    public function saveCoursePayment(Request $request)
    {

        $input = $request->all();
        dd($input);
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        try {
            $student = User::findOrFail(Auth::id());
            $order = time() . $student->id . $request->input('amount');

            //Initially we will save these data in DB
            $paymentData = Payment::create([
                'course_id' => $request->input('course_id'),
                'student_id' => $student->id,
                'receipt_no' => $order,
                'order_id' => $order,
                'payment_id' => $request->razorpay_payment_id,
                'transaction_fee' => $request->input('amount'),
                'amount' => $request->input('amount'),
                'transaction_id' => time() . rand(11, 99) . date('yd'),
                'transaction_date' => now(),
                'payment_date' => now(),
                'payment_status' => 'initiated',
                'ip_address' => $request->ip(),
                'status' => 0,
            ]);

            //Agr frontend pe modal ko close krdiya jaye ya phir payment_id null aye ,
            //to ondismis wala array element  k wjh se yha null ajayega razorpay_payment_id or niche if condition trigger ni hoga
            if ($request->filled('razorpay_payment_id')) {
                $payment = $api->payment->fetch($input['razorpay_payment_id']);
                // dd($payment);
                if ($payment->status === 'authorized') {
                    $response = $api->payment->fetch($input['razorpay_payment_id'])->capture([
                        'amount' => $payment['amount']
                    ]);
                    // dd($response);
                    $paymentData->update([
                        'payment_id' => $response->id,
                        'payment_status' => $response->status,
                        'payment_card_id' => $response->card_id,
                        'method' => $response->method,
                        'wallet' => $response->wallet,
                        'payment_vpa' => $response->vpa,
                        'international_payment' => $response->international,
                        'error_reason' => $response->error_reason ?? 'No error',
                        'status' => 1,
                    ]);
                    $student->courses()->attach($request->input('course_id'));
                    return redirect('/student/dashboard')->with('success', 'Payment Successfull');
                }
                else {
                    $paymentData->update([
                        'payment_status' => $payment->status,
                        'error_reason' => $paymentData->error_reason ?? 'Payment failed.',
                        'status' => 0,
                    ]);
                    return redirect()->back()->with('error', 'Payment failed: ' . $paymentData->error_reason);
                }
            }
            else{
                $paymentData->update([
                    'payment_status' => 'canceled',
                    'error_reason' => 'Transaction cancelled by the user.',
                    'status' => 0,
                ]);

                return redirect()->back()->with('error', 'Transaction cancelled by the user.');
            }

        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Payment processing failed:' . $e->getMessage());
        }
    }


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
}
