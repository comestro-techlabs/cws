<?php

namespace App\Livewire\Public\Course;

use App\Models\Course;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\DB;

class Ourcourses extends Component
{
    public $courses, $placedStudents, $title, $course, $course_id, $payment_exist;

    public function mount($slug)
    {
        $this->courses = Course::where("published", true)->latest()->take(6)->get();
        $this->course = Course::where('slug', $slug)->first();
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
            
            // --- START OF CHANGES: Add GST calculation ---
            $courseAmount = $this->course->discounted_fees;
            $gstRate = 0.18; // 18% GST
            $gstAmount = round($courseAmount * $gstRate, 2);
            $totalAmount = $courseAmount + $gstAmount;
            // --- END OF CHANGES ---

            // --- MODIFIED: Include GST and total amount in payment record ---
            $payment = Payment::create([
                'student_id' => Auth::id(),
                'course_id' => $this->course->id,
                'amount' => $courseAmount,
                'gst_amount' => $gstAmount, // Store GST amount
                'total_amount' => $totalAmount, // Store total amount including GST
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
            
            // --- MODIFIED: Use totalAmount for Razorpay order ---
            $orderData = [
                'amount' => $totalAmount * 100, // Use total amount including GST
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
            // --- MODIFIED: Include payment breakdown in data dispatched ---
            $data = [
                'key' => $razorpayKey,
                'amount' => (int)($totalAmount * 100), // Use total amount
                'currency' => 'INR',
                'name' => 'LearnSyntax',
                'description' => "Payment for {$this->course->title}",
                'image' => asset('front_assets/img/logo/logo.png'),
                'order_id' => $razorpayOrder->id,
                'payment_id' => $payment->id,
                'prefill' => [
                    'name' => $user ? $user->name : '',
                    'email' => $user ? $user->email : ''
                ],
                'breakdown' => [ // Add payment breakdown
                    'Course Fee' => $courseAmount,
                    'GST (18%)' => $gstAmount,
                    'Total' => $totalAmount
                ]
            ];

            Log::info('Payment data:', $data);
            // --- MODIFIED: Dispatch payment data with breakdown ---
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
            if ($response['razorpay_payment_id'] && $payment->course_id) {
                DB::table('course_student')->updateOrInsert(
                    [
                        'course_id' => $payment->course_id,
                        'user_id' => $payment->student_id,
                    ],
                    [
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                );
            }

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