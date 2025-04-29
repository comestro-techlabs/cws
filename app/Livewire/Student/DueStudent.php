<?php

namespace App\Livewire\Student;

use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\Course;
use Illuminate\Support\Str;
use Log;
use Razorpay\Api\Api;

class DueStudent extends Component
{
    public $courseId;
    public $course;
    public $isEnrolled = false;
    public $showModal = false;
    public $showDue = false;
    public $selectedCourseId;
    public $course_title;
    public $amount;
    public $total_amount;
    public $payment;
    public $batch;
    public $activeBatches;
    public $selectedBatchId;
    public $enrolledCourses = [];
    public $payment_exist = false;
    public $paymentOption = 'pay_now';

    public function mount($courseId)
    {
        Log::info('DueStudent mount called with Course ID: ' . $courseId);
        $this->courseId = $courseId;

        $user = Auth::user();
        if (!$user) {
            Log::error('No authenticated user found');
            abort(401, 'You must be logged in to access this page.');
        }

        $this->enrolledCourses = $user->courses()->pluck('courses.id')->toArray();

        $this->course = Course::with([
            'features',
            'category',
            'batches' => function ($query) {
                $query->whereDate('end_date', '>=', now())->orderBy('start_date');
            }
        ])->find($courseId);

        if (!$this->course) {
            Log::error('Course not found for ID: ' . $courseId);
            abort(404, 'Course not found.');
        }

        $this->activeBatches = $this->course->batches->map(function ($batch) {
            $batch->start_date = \Carbon\Carbon::parse($batch->start_date);
            $batch->end_date = \Carbon\Carbon::parse($batch->end_date);
            return $batch;
        });

        if ($this->activeBatches->isNotEmpty()) {
            $this->selectedBatchId = $this->activeBatches->first()->id;
            $this->batch = $this->activeBatches->first();
        } else {
            Log::warning('No active batches found for course ID: ' . $courseId);
            $this->batch = null;
            $this->selectedBatchId = null;
        }

        $this->isEnrolled = DB::table('course_student')
            ->where('user_id', Auth::id())
            ->where('course_id', $this->courseId)
            ->exists();

        $this->loadPaymentForCourse($courseId);
    }

    public function loadPaymentForCourse($courseId)
    {
        $this->payment = Payment::where('student_id', Auth::id())
            ->where('course_id', $courseId)
            ->where('payment_type', 'course')
            ->latest()
            ->first();

        $this->showDue = $this->payment && ($this->payment->amount > $this->payment->total_amount || $this->payment->payment_status === 'requested');
        if ($this->showDue) {
            $dueAmount = $this->payment->amount - $this->payment->total_amount;
            $this->total_amount = $this->payment->payment_status === 'requested' ? $dueAmount * 0.2 : $dueAmount * 0.4;
        }
    }

    public function openModalForEnrollment($courseId)
    {
        try {
            $course = Course::findOrFail($courseId);
            $this->selectedCourseId = $courseId;
            $this->course_title = $course->title;
            $this->amount = $course->discounted_fees ?? $course->fees;
            $this->total_amount = $this->amount * 0.2;
            $this->paymentOption = 'pay_now';
            $this->showModal = true;
        } catch (\Exception $e) {
            Log::error('Failed to open enrollment modal: ' . $e->getMessage());
            session()->flash('error', 'Failed to load course data');
        }
    }

    public function enrollDue()
    {
        try {
            if ($this->paymentOption === 'pay_now') {
                $this->validate([
                    'total_amount' => 'required|numeric|min:' . ($this->amount * 0.2) . '|max:' . $this->amount,
                ]);

                $existingPayment = Payment::where('student_id', Auth::id())
                    ->where('course_id', $this->course->id)
                    ->where('payment_type', 'course')
                    ->whereIn('payment_status', ['initiated', 'partial', 'requested'])
                    ->where('status', 'pending')
                    ->latest()
                    ->first();

                if ($existingPayment) {
                    $this->payment = $existingPayment;
                } else {
                    $this->payment = Payment::create([
                        'student_id' => Auth::id(),
                        'course_id' => $this->course->id,
                        'receipt_no' => 'COURSE_INIT_' . time(),
                        'amount' => $this->amount,
                        'total_amount' => 0,
                        'transaction_fee' => 0,
                        'payment_type' => 'course',
                        'currency' => 'INR',
                        'payment_status' => 'initiated',
                        'status' => 'pending',
                        'ip_address' => request()->ip(),
                        'month' => now()->month,
                        'year' => now()->year,
                        'payment_method' => 'razorpay',
                        'payment_id' => 'PAY_' . Str::random(10) . '_' . Auth::id(),
                        'notes' => json_encode([
                            'student_id' => Auth::id(),
                            'course_id' => $this->course->id,
                            'course_name' => $this->course->name,
                            'course_type' => $this->course->course_type,
                            'description' => 'Initial payment for course: ' . $this->course->name,
                        ]),
                        'payment_date' => now(),
                    ]);
                }

                $this->dispatch('initiate-payment', amount: $this->total_amount, paymentId: $this->payment->id);
            } else {
                $this->requestCourseAccess();
            }
        } catch (\Exception $e) {
            Log::error('Validation failed for enrollDue: ' . $e->getMessage());
            session()->flash('error', 'Invalid payment amount or request failed');
        }
    }

    public function requestCourseAccess()
    {
        try {
            DB::beginTransaction();

            $existingPayment = Payment::where('student_id', Auth::id())
                ->where('course_id', $this->course->id)
                ->where('payment_type', 'course')
                ->whereIn('payment_status', ['initiated', 'partial', 'requested'])
                ->where('status', 'pending')
                ->latest()
                ->first();

            if ($existingPayment) {
                throw new \Exception('A payment or request is already pending for this course.');
            }

            $this->payment = Payment::create([
                'student_id' => Auth::id(),
                'course_id' => $this->course->id,
                'receipt_no' => 'COURSE_REQUEST_' . time(),
                'amount' => $this->amount,
                'total_amount' => 0,
                'transaction_fee' => 0,
                'payment_type' => 'course',
                'currency' => 'INR',
                'payment_status' => 'requested',
                'status' => 'captured',
                'ip_address' => request()->ip(),
                'month' => now()->month,
                'year' => now()->year,
                'payment_method' => 'none',
                'payment_id' => 'PAY_' . Str::random(10) . '_' . Auth::id(),
                'notes' => json_encode([
                    'student_id' => Auth::id(),
                    'course_id' => $this->course->id,
                    'course_name' => $this->course->name,
                    'course_type' => $this->course->course_type,
                    'description' => 'Course access request for: ' . $this->course->name,
                ]),
                'payment_date' => now(),
            ]);

            $deadline = \Carbon\Carbon::parse($this->payment->created_at)->addDays(7);

            if (!$this->isEnrolled) {
                if (!$this->batch) {
                    throw new \Exception('No active batch available for this course.');
                }

                DB::table('course_student')->insert([
                    'user_id' => Auth::id(),
                    'course_id' => $this->course->id,
                    'batch_id' => $this->batch->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $this->isEnrolled = true;
                $this->enrolledCourses[] = $this->course->id;
            }

            DB::commit();

            $this->payment_exist = true;
            $this->loadPaymentForCourse($this->course->id);
            $this->closeModal();

            return redirect()->route('student.dashboard')->with('success', 'You have successfully enrolled in the course.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Course Access Request Error: ' . $e->getMessage());
            session()->flash('error', 'Failed to request course access: ' . $e->getMessage());
        }
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->total_amount = null;
        $this->paymentOption = 'pay_now';
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
                'total_amount' => 'required|numeric|min:' . $minAmount . '|max:' . $dueAmount,
            ]);

            $this->dispatch('initiate-payment', amount: $this->total_amount, paymentId: $paymentId);
        } catch (\Exception $e) {
            Log::error('Failed to initiate due payment: ' . $e->getMessage());
            session()->flash('error', $e->getMessage() ?: 'Failed to initiate due payment');
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
                    'student_id' => Auth::id(),
                    'course_id' => $this->course->id,
                    'course_name' => $this->course->name,
                    'course_type' => $this->course->course_type,
                    'description' => 'Due payment for course: ' . $this->course->name,
                ],
            ];

            $razorpayOrder = $api->order->create($orderData);

            DB::beginTransaction();

            $payment = Payment::findOrFail($paymentId);

            $payment->update([
                'receipt_no' => $receipt_no,
                'order_id' => $razorpayOrder->id,
                'payment_status' => 'initiated',
                'status' => 'pending',
                'payment_id' => $payment->payment_id ?? 'PAY_' . Str::random(10) . '_' . Auth::id(),
                'payment_method' => $payment->payment_method ?? 'razorpay',
                'notes' => json_encode($orderData['notes']),
                'payment_date' => $payment->payment_date ?? now(),
                'ip_address' => request()->ip(),
                'month' => now()->month,
                'year' => now()->year,
            ]);

            DB::commit();

            Log::info('Payment Initiated Successfully', [
                'order_id' => $razorpayOrder->id,
                'payment_id' => $paymentId,
                'razorpay_order' => $razorpayOrder->toArray(),
                'notes' => $orderData['notes'],
            ]);

            return [
                'payment_id' => $payment->id,
                'order_id' => $razorpayOrder->id,
                'amount' => $amount,
            ];
        } catch (\Exception $e) {
            DB::rollBack();
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
    public function handlePaymentResponse($response)
    {
        try {
            Log::info('Handling Payment Response', $response);

            $payment = Payment::where('id', $response['payment_id'])->first();

            if (!$payment) {
                throw new \Exception('Payment record not found');
            }

            $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
            $razorpayPayment = $api->payment->fetch($response['razorpay_payment_id']);

            if (empty($razorpayPayment->method)) {
                Log::warning('Razorpay payment method is missing', ['razorpay_payment_id' => $response['razorpay_payment_id']]);
            }
            if (empty($razorpayPayment->notes)) {
                Log::warning('Razorpay payment notes are missing', ['razorpay_payment_id' => $response['razorpay_payment_id']]);
            }

            $attributes = [
                'razorpay_order_id' => $response['razorpay_order_id'],
                'razorpay_payment_id' => $response['razorpay_payment_id'],
                'razorpay_signature' => $response['razorpay_signature'],
            ];
            $api->utility->verifyPaymentSignature($attributes);

            DB::beginTransaction();

            $existingNotes = $payment->notes ? json_decode($payment->notes, true) : [];
            $newNotes = $razorpayPayment->notes ? (array)$razorpayPayment->notes : ($response['notes'] ?? []);
            $mergedNotes = array_merge($existingNotes, $newNotes, [
                'updated_at' => now()->toDateTimeString(),
                'payment_processed' => true,
            ]);

            $newTotalAmount = $payment->total_amount + ($response['amount'] ?? 0);

            Log::info('Payment Record Before Update', $payment->toArray());

            $payment->update([
                'razorpay_payment_id' => $response['razorpay_payment_id'],
                'razorpay_order_id' => $response['razorpay_order_id'],
                'razorpay_signature' => $response['razorpay_signature'],
                'total_amount' => $newTotalAmount,
                'payment_status' => ($payment->amount <= $newTotalAmount) ? 'completed' : 'partial',
                'status' => $razorpayPayment->status === 'captured' ? 'captured' : 'pending',
                'payment_id' => $payment->payment_id ?? 'PAY_' . Str::random(10) . '_' . Auth::id(),
                'payment_method' => $payment->payment_method ?? $razorpayPayment->method ?? 'razorpay',
                'notes' => json_encode($mergedNotes),
                'payment_date' => $payment->payment_date ?? now(),
            ]);

            Log::info('Payment Record After Update', $payment->toArray());

            if (!$this->isEnrolled) {
                if (!$this->batch) {
                    throw new \Exception('No active batch available for this course.');
                }

                DB::table('course_student')->insert([
                    'user_id' => Auth::id(),
                    'course_id' => $this->course->id,
                    'batch_id' => $this->batch->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $this->isEnrolled = true;
                $this->enrolledCourses[] = $this->course->id;
            }

            DB::commit();

            $this->payment_exist = true;
            $this->loadPaymentForCourse($this->course->id);
            $this->closeModal();

            $deadline = \Carbon\Carbon::parse($payment->created_at)->addDays(7);
            session()->flash('success', ($payment->payment_status === 'completed') ? 'Payment completed successfully!' : 'Partial payment successful! Please complete the remaining payment of ₹' . number_format($payment->amount - $payment->total_amount, 2) . ' by ' . $deadline->format('d M Y') . '.');

            Log::info('Payment Verified and Updated', [
                'payment_id' => $payment->id,
                'razorpay_payment_id' => $payment->razorpay_payment_id,
                'total_amount' => $payment->total_amount,
                'payment_status' => $payment->payment_status,
                'status' => $payment->status,
                'payment_method' => $payment->payment_method,
                'notes' => $mergedNotes,
            ]);

            if ($payment->payment_status === 'completed') {
                $this->dispatch('redirectToDashboard');
            }

            return ['success' => true];
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Payment Verification Error: ' . $e->getMessage(), $response);
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
        return view('livewire.student.due-student');
    }
}