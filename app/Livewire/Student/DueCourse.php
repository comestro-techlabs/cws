<?php

namespace App\Livewire\Student;

use App\Models\Course;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Support\Str;
use Log;
use Razorpay\Api\Api;

class DueCourse extends Component
{
    public $payment = null;
    public $total_amount = null;
    public $course = null;

    public function mount($courseId)
    {
        Log::info('Mounting DueCourse', ['courseId' => $courseId]);

        $this->course = Course::find($courseId);

        Log::info('Course Data', [
            'courseId' => $courseId,
            'course' => $this->course ? $this->course->toArray() : null,
        ]);

        if (!$this->course) {
            session()->flash('error', 'Course not found.');
            return;
        }

        $this->payment = Payment::where('course_id', $courseId)
            ->where('student_id', auth()->id())
            ->first();

        if (!$this->payment) {
            session()->flash('error', 'No payment found for this course.');
        } else {
            // Initialize total_amount with the minimum allowed amount
            $dueAmount = $this->payment->amount - $this->payment->total_amount;
            $this->total_amount = $this->payment->payment_status === 'requested' ? $dueAmount * 0.2 : $dueAmount * 0.4;
        }
    }

    public function payDueAmount($paymentId)
    {
        try {
            $this->payment = Payment::findOrFail($paymentId);
            $dueAmount = $this->payment->amount - $this->payment->total_amount;

            if ($dueAmount <= 0 && $this->payment->payment_status !== 'requested') {
                throw new \Exception('No due amount to pay.');
            }

          

            $minAmount = $this->payment->payment_status === 'requested' ? $dueAmount * 0.2 : $dueAmount * 0.4;

            Log::info('Pay Due Amount', [
                'payment_id' => $paymentId,
                'due_amount' => $dueAmount,
                'min_amount' => $minAmount,
                'total_amount' => $this->total_amount,
                'payment_status' => $this->payment->payment_status,
            ]);

            $this->validate([
                'total_amount' => [
                    'required',
                    'numeric',
                    'min:' . $minAmount,
                    'max:' . $dueAmount,
                ],
            ]);

            Log::info('Dispatching initiate-payment event', [
                'amount' => $this->total_amount,
                'paymentId' => $paymentId,
            ]);

            $this->dispatch('initiate-payment', amount: $this->total_amount, paymentId: $paymentId);
        } catch (\Exception $e) {
            Log::error('Failed to initiate due payment: ' . $e->getMessage());
            session()->flash('error', $e->getMessage() ?: 'Failed to initiate due payment.');
        }
    }

    #[On('initiate-payment')]
    public function initiatePayment($amount, $paymentId)
    {
        try {
            Log::info('Initiating Payment', [
                'amount' => $amount,
                'payment_id' => $paymentId,
            ]);

            $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
            $receipt_no = 'COURSE_' . time();

            $orderData = [
                'receipt' => $receipt_no,
                'amount' => $amount * 100,
                'currency' => 'INR',
                'payment_capture' => 1,
                'notes' => [
                    'student_id' => auth()->id(),
                    'course_id' => $this->course->id,
                    'course_name' => $this->course->name,
                    'course_type' => $this->course->course_type,
                    'description' => 'Due payment for course: ' . $this->course->name,
                ],
            ];

            $razorpayOrder = $api->order->create($orderData);
            $this->payment = Payment::findOrFail($paymentId);

            $this->payment->update([
                'order_id' => $razorpayOrder->id,
                'receipt_no' => $receipt_no,
                'payment_status' => 'initiated',
                'status' => 'pending',
                'payment_id' => $this->payment->payment_id ?? 'PAY_' . Str::random(10) . '_' . auth()->id(),
                'payment_method' => $this->payment->payment_method ?? 'razorpay',
                'notes' => json_encode($orderData['notes']),
                'payment_date' => $this->payment->payment_date ?? now(),
                'ip_address' => request()->ip(),
                'month' => now()->month,
                'year' => now()->year,
            ]);

            Log::info('Payment Initiated Successfully', [
                'order_id' => $razorpayOrder->id,
                'payment_id' => $paymentId,
                'razorpay_order' => $razorpayOrder->toArray(),
                'notes' => $orderData['notes'],
            ]);

            return [
                'payment_id' => $this->payment->id,
                'order_id' => $razorpayOrder->id,
                'amount' => $amount,
            ];
        } catch (\Exception $e) {
            Log::error('Payment Initiation Error: ' . $e->getMessage(), [
                'amount' => $amount,
                'payment_id' => $paymentId,
                'trace' => $e->getTraceAsString(),
            ]);
            session()->flash('error', 'Failed to initiate payment: ' . $e->getMessage());
            return null;
        }
    }

    #[On('handle-payment-response')]
    public function handlePaymentResponse($data)
    {
        try {
            Log::info('Handling Payment Response', $data);

            $payment = Payment::findOrFail($data['payment_id']);
            $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

            // Fetch Razorpay payment details
            $razorpayPayment = $api->payment->fetch($data['razorpay_payment_id']);

            if (empty($razorpayPayment->method)) {
                Log::warning('Razorpay payment method is missing', ['razorpay_payment_id' => $data['razorpay_payment_id']]);
            }
            if (empty($razorpayPayment->notes)) {
                Log::warning('Razorpay payment notes are missing', ['razorpay_payment_id' => $data['razorpay_payment_id']]);
            }

            // Verify the payment signature
            $attributes = [
                'razorpay_order_id' => $data['razorpay_order_id'],
                'razorpay_payment_id' => $data['razorpay_payment_id'],
                'razorpay_signature' => $data['razorpay_signature'],
            ];
            $api->utility->verifyPaymentSignature($attributes);

            // Start transaction
            DB::beginTransaction();

            // Merge existing notes with new ones
            $existingNotes = $payment->notes ? json_decode($payment->notes, true) : [];
            $newNotes = $razorpayPayment->notes ? (array)$razorpayPayment->notes : ($data['notes'] ?? []);
            $mergedNotes = array_merge($existingNotes, $newNotes, [
                'updated_at' => now()->toDateTimeString(),
                'payment_processed' => true,
            ]);

            // Calculate new total amount
            $newTotalAmount = $payment->total_amount + ($data['amount'] ?? 0);

            // Log payment state before update
            Log::info('Payment Record Before Update', $payment->toArray());

            // Update payment record
            $payment->update([
                'razorpay_payment_id' => $data['razorpay_payment_id'],
                'razorpay_order_id' => $data['razorpay_order_id'],
                'razorpay_signature' => $data['razorpay_signature'],
                'total_amount' => $newTotalAmount,
                'payment_status' => ($payment->amount <= $newTotalAmount) ? 'completed' : 'partial',
                'status' => $razorpayPayment->status === 'captured' ? 'captured' : 'pending',
                'payment_id' => $payment->payment_id ?? 'PAY_' . Str::random(10) . '_' . auth()->id(),
                'payment_method' => $payment->payment_method ?? $razorpayPayment->method ?? 'razorpay',
                'notes' => json_encode($mergedNotes),
                'payment_date' => $payment->payment_date ?? now(),
            ]);

            // Log payment state after update
            Log::info('Payment Record After Update', $payment->toArray());

            DB::commit();

            Log::info('Payment Verified and Updated', [
                'payment_id' => $payment->id,
                'razorpay_payment_id' => $payment->razorpay_payment_id,
                'total_amount' => $payment->total_amount,
                'payment_status' => $payment->payment_status,
                'status' => $payment->status,
                'payment_method' => $payment->payment_method,
                'notes' => $mergedNotes,
            ]);

            session()->flash('success', ($payment->payment_status === 'completed') ? 'Payment completed successfully!' : 'Partial payment successful! Please complete the remaining payment of ₹' . number_format($payment->amount - $payment->total_amount, 2) . '.');

            return [
                'success' => true,
                'message' => 'Payment verified successfully.',
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Payment Verification Error: ' . $e->getMessage(), $data);
            session()->flash('error', 'Payment verification failed: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Payment verification failed: ' . $e->getMessage(),
            ];
        }
    }

    #[On('redirectToDashboard')]
    public function redirectToDashboard()
    {
        return redirect()->route('student.dashboard')->with('success', 'You have successfully enrolled in the course.');
    }
    public function render()
    {
        return view('livewire.student.due-course', [
            'course' => $this->course,
        ]);
    }
}