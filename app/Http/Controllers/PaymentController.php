<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\User;
use App\Models\Payment;
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

        // if ($student->courses()->where('course_id', $request->input('course_id'))->exists()) {
        //     return redirect()->back()->with('error', 'This course is already assigned to the student.');
        // }
     
        // $student->courses()->attach($request->input('course_id'));

        $payment = Payment::create([
            'course_id' =>$request->input('course_id'),
            'student_id' => $student->id,
            'receipt_no' => time() . $student->id,
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

        if($payment){
            return redirect('/student/dashboard')->with('success', 'Payment Successfull');
        }  

        // $tempPayment = Course::where('token_no',  $request->token_no)->first();
        // $tempPayment->update([
        //     'isPayment'=>1
        // ]);
                            
        else{
            return redirect()->back()->with('error', 'Something Went Wrong.');
        }
                
    }

}
