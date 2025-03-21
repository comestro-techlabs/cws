<?php

namespace App\Livewire\Public\Course;

use App\Models\Course;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Razorpay\Api\Api;

class Ourcourses extends Component
{

    public $courses,$placedStudents,$title,$course,$course_id,$payment_exist;

    public function mount($slug){
        $this->courses = Course::where("published", true)->latest()->take(6)->get();
        $this->course = Course::where('slug', $slug)->first(); // replace 1 with course id
        $this->course_id = $this->course->id;
        $this->payment_exist = Payment::where("student_id", Auth::id())
        ->where("course_id", $this->course_id)
        ->where("status", "captured")
        ->exists();
    }

    public function initiatePayment()
    {
        try {
            Log::info('Course payment initiation started');
            
            if (!Auth::check()) {
                Log::info('User not authenticated');
                return redirect()->route('auth.login');
            }

            $receipt = 'CRS_' . time();
            Log::info('Generated receipt:', ['receipt' => $receipt]);
            
            // Create payment record first
            $payment = Payment::create([
                'student_id' => Auth::id(),
                'course_id' => $this->course->id,
                'amount' => $this->course->discounted_fees,
                'total_amount' => $this->course->discounted_fees,
                'payment_type' => 'course',
                'currency' => 'INR',
                'status' => 'pending',
                'payment_status' => 'initiated',
                'receipt_no' => $receipt,
                'ip_address' => request()->ip(),
                'month' => now()->month,
                'year' => now()->year
            ]);

            Log::info('Payment record created:', $payment->toArray());

            $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
            Log::info('Razorpay API initialized');
            
            $orderData = [
                'amount' => $this->course->discounted_fees * 100,
                'currency' => 'INR',
                'receipt' => $receipt,
                'payment_capture' => 1
            ];

            Log::info('Creating Razorpay order:', $orderData);
            $razorpayOrder = $api->order->create($orderData);
            Log::info('Razorpay order created:', (array)$razorpayOrder);

            $payment->update(['order_id' => $razorpayOrder->id]);
            Log::info('Payment record updated with order_id');

            $razorpayKey = config('services.razorpay.key');
            if (empty($razorpayKey)) {
                throw new \Exception('Razorpay key not configured');
            }

            $user = Auth::user();
            $data = [
                'key' => $razorpayKey,
                'amount' => (int)($this->course->discounted_fees * 100), // Ensure amount is integer
                'currency' => 'INR',
                'name' => 'LearnSyntax',
                'description' => "Payment for {$this->course->title}",
                'image' => asset('front_assets/img/logo/logo.png'),
                'order_id' => $razorpayOrder->id,
                'payment_id' => $payment->id,
                'prefill' => [
                    'name' => $user ? $user->name : '',
                    'email' => $user ? $user->email : ''
                ]
            ];

            Log::info('Payment data:', $data);
            return $this->dispatch('initCoursePayment', [$data]);

        } catch (\Exception $e) {
            Log::error('Payment initiation error:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            session()->flash('error', 'Failed to initiate payment: ' . $e->getMessage());
        }
    }

    public function handlePaymentSuccess($response)
    {
        try {
            $payment = Payment::where('order_id', $response['razorpay_order_id'])->first();
            
            if (!$payment) {
                session()->flash('error', 'Payment record not found');
                return;
            }

            $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
            $attributes = [
                'razorpay_signature' => $response['razorpay_signature'],
                'razorpay_payment_id' => $response['razorpay_payment_id'],
                'razorpay_order_id' => $response['razorpay_order_id']
            ];

            $api->utility->verifyPaymentSignature($attributes);

            $payment->update([
                'razorpay_payment_id' => $response['razorpay_payment_id'],
                'razorpay_signature' => $response['razorpay_signature'],
                'status' => 'captured',
                'payment_status' => 'completed',
                'payment_date' => now()
            ]);

            $this->payment_exist = true;
            session()->flash('success', 'Payment successful!');
            return redirect()->route('student.dashboard');

        } catch (\Exception $e) {
            Log::error('Payment verification error: ' . $e->getMessage());
            session()->flash('error', 'Payment verification failed');
        }
    }

    public function render()
    {
        return view('livewire.public.course.ourcourses');
    }
}
