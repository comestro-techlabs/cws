<?php

namespace App\Http\Controllers;

use App\Services\PhonePeService;
use Illuminate\Http\Request;

class PhonepeController extends Controller
{
    protected $phonePeService;

    public function __construct(PhonePeService $phonePeService)
    {
        $this->phonePeService = $phonePeService;
    }
    public function index(){
        return view('welcome');
    }

    public function initiatePayment(Request $request)
    {
        $validated = $request->validate([
            'mobile_number' => 'required|digits:10',
            'amount' => 'required|numeric|min:1',
            'course_id'=>'required',
            'email'=>'required',
            'name'=>'required',
        ]);

        $callbackUrl = route('phonepe.callback');
        $redirectUrl = route('phonepe.redirect');

        $payment = $this->phonePeService->initiatePayment(
            $validated['mobile_number'],
            $validated['amount'],
            'https://comestro.com/test/status',
            'https://comestro.com/test/redirect',
        );

        return redirect($payment['redirect_url']);
    }

    public function callback(Request $request)
    {
        // Handle callback logic here
    }

    public function checkStatus($transactionId)
    {
        $status = $this->phonePeService->checkStatus($transactionId);

        return response()->json($status);
    }

    public function refund(Request $request)
    {
        $validated = $request->validate([
            'original_transaction_id' => 'required',
            'amount' => 'required|numeric|min:1',
        ]);

        $callbackUrl = route('phonepe.callback');
        $refund = $this->phonePeService->refund(
            $validated['original_transaction_id'],
            $validated['amount'],
            $callbackUrl
        );

        return response()->json($refund);
    }
    public function redirect(Request $request)
    {
        // Handle the redirect after payment
        // You can access query parameters like status, merchantTransactionId, etc.

        $status = $request->query('status');
        $merchantTransactionId = $request->query('merchantTransactionId');
        $amount = $request->query('amount');

       
        // Process the status of the transaction (success or failure)
        // if ($status == 'SUCCESS') {
        //     return view('phonepe.success', compact('merchantTransactionId'));
        // } else {
        //     return view('phonepe.failure', compact('merchantTransactionId'));
        // }
    }
}
