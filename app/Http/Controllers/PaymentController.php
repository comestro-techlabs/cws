<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Payment;
use Razorpay\Api\Api;

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
                $fetchprocessdata = saveCoursePayment::where('token_no', $request->token_no)->first();    
            if ($fetchprocessdata) {
                    $payment = Payment::create([
                        'course_id' => $fetchprocessdata->id,
                        'customer_name' => $fetchprocessdata->customer_name,
                        'mobile' => $fetchprocessdata->mobile_no,
                        'email' => $fetchprocessdata->email,
                        'receipt_no' => time() . $fetchprocessdata->id,
                        'payment_id' => $request->razorpay_payment_id,
                        'transaction_fee' => $fetchprocessdata->promotion_charge,
                        'transaction_id' => time() . rand(11, 99) . date('yd'),
                        'transaction_date' => now(),
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

                        $tempPayment = Course::where('token_no',  $request->token_no)->first();
                        $tempPayment->update([
                            'isPayment'=>1
                        ]);
                        if($tempPayment){
                            return redirect('course-payment-success/'.$request->token_no)->with('alert-success', 'Transaction successful.');
                        }                       
                    }
                    else{
                        return redirect()->route('course')->with('alert-danger', 'Something Went Wrong.');
                    }
                
            } else {
                throw new Exception("Temporary user not found.");
            }
    }

    public function coursePaymentSuccess(Request $request, $token_no)
    {
        $token_no = $request->token_no;
        $getTempDetails = Course::where('token_no', $token_no)->first();
        if($getTempDetails){
            $data = Payment::where('course_id', $getTempDetails->id)->first();
            // dd($donation);
            return view('frontend/instagram-payment-success', compact('data'));
        }
        else{
            return redirect()->route('Course')->with('alert-danger', 'Invalid token number.');
        }
    }

}
