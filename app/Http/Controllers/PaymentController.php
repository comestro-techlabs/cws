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


class PaymentController extends Controller
{


    public function saveCoursePayment(Request $request)
    {
        $input = $request->all();

        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));        
        $payment = $api->payment->fetch($input['razorpay_payment_id']);
            if (!empty($input['razorpay_payment_id'])) {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture([
                    'amount' => $payment['amount']
                ]);
            } else {
                throw new Exception("Payment ID is empty.");
            }

        $student = User::findOrFail(Auth::id());
        $order = time() . $student->id. $request->input('amount');

        $payment = Payment::create([
            'course_id' =>$request->input('course_id'),
            'student_id' => $student->id,
            'receipt_no' => time() . $student->id,
            'order_id' => $order,
            'payment_id' => $request->razorpay_payment_id,
            'transaction_fee' => $request->input('amount'),
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
        // dd("halting here");
        $student->courses()->attach($request->input('course_id'));

        if($payment){
            return redirect('/student/dashboard')->with('success', 'Payment Successfull');
        }  

               
        else{
            return redirect()->back()->with('error', 'Something Went Wrong.');
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
