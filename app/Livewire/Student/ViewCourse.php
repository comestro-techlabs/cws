<?php
namespace App\Livewire\Student;

use App\Models\Batch;
use App\Models\CourseReview;
use App\Models\Payment;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Razorpay\Api\Api;
use App\Services\GemService;

class ViewCourse extends Component
{
    public $course;
    public $reviewedCourse;
    public $payment_exist = false;
    public $avgRating;
    public $enrolledCourses = [];
    public $selectedBatchId;
    public $activeBatches;

    public $batch;

    #[Layout('components.layouts.student')]
    public function mount($courseId)
    {
        if (!Auth::check()) {
            return redirect()->route('auth.login')->with('error', 'You must be logged in to access this page');
        }

        $this->enrolledCourses = Auth::user()
            ->courses()
            ->pluck('courses.id')
            ->toArray();

        $this->course = Course::with(['features', 'category', 'batches' => function($query) {
            $query->whereDate('end_date', '>=', now())
                  ->orderBy('start_date');
        }])->findOrFail($courseId);

        $this->activeBatches = $this->course->batches->map(function($batch) {
            $batch->start_date = \Carbon\Carbon::parse($batch->start_date);
            $batch->end_date = \Carbon\Carbon::parse($batch->end_date);
            return $batch;
        });
        
        if($this->activeBatches->isNotEmpty()) {
            $this->selectedBatchId = $this->activeBatches->first()->id;
        }

        $this->reviewedCourse = CourseReview::where('course_id', $courseId)->get();
        $this->avgRating = CourseReview::where('course_id', $courseId)->avg('rating');

        // Fetch the active batch
        $this->batch = Batch::where('course_id', $courseId)
            ->whereDate('end_date', '>=', now())
            ->first();

        $course_id = $this->course->id;
        $user_id = Auth::id();

        $this->payment_exist = Payment::where("student_id", $user_id)
            ->where("course_id", $course_id)
            ->where("status", "captured")
            ->exists();

        if ($this->course->discounted_fees == 0) {
            $already_enrolled = DB::table('course_student')
                ->where('user_id', $user_id)
                ->where('course_id', $course_id)
                ->where('batch_id', $this->batch ? $this->batch->id : null)
                ->exists();

            if (!$already_enrolled && $this->batch) {
                try {
                    DB::table('course_student')->insert([
                        'user_id'    => $user_id,
                        'course_id'  => $course_id,
                        'batch_id'   => $this->batch->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    // Award gems based on course fees
                    try {
                        $gemService = new GemService();
                        $gemsToAward = (int)($this->course->discounted_fees * 0.10); // 10% of course fees
                        $gemService->earnedGem($gemsToAward, 'Welcome bonus for enrolling in course');
                    } catch (\Exception $e) {
                        \Log::error('Failed to award enrollment gems: ' . $e->getMessage());
                    }

                    $this->payment_exist = true;
                    $this->enrolledCourses[] = $course_id;
                } catch (\Exception $e) {
                    session()->flash('error', 'Failed to enroll in free course: ' . $e->getMessage());
                }
            }
        }
    }

    #[On('initiate-payment')]
    public function initiatePayment()
    {
        try {
            $courseAmount = $this->course->discounted_fees;
            $receipt_no = 'COURSE_' . time();

            // Initialize Razorpay API
            $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

            // Create Razorpay Order
            $orderData = [
                'receipt'         => $receipt_no,
                'amount'          => $courseAmount * 100, // Convert to paise
                'currency'        => 'INR',
                'payment_capture' => 1 // Auto capture
            ];
            
            $razorpayOrder = $api->order->create($orderData);

            // Create local payment record
            $payment = Payment::create([
                'student_id' => Auth::id(),
                'course_id' => $this->course->id,
                'receipt_no' => $receipt_no,
                'amount' => $courseAmount,
                'total_amount' => $courseAmount,
                'transaction_fee' => 0,
                'payment_type' => 'course',
                'currency' => 'INR',
                'payment_status' => 'initiated',
                'status' => 'pending',
                'ip_address' => request()->ip(),
                'month' => now()->month,
                'year' => now()->year,
                'payment_method' => 'razorpay',
                'order_id' => $razorpayOrder->id
            ]);

            return [
                'payment_id' => $payment->id,
                'order_id' => $razorpayOrder->id
            ];
        } catch (\Exception $e) {
            \Log::error('Payment Initiation Error: ' . $e->getMessage());
            session()->flash('error', 'Failed to initiate payment');
            return null;
        }
    }

    #[On('handle-payment-response')]
    public function handlePaymentResponse($response)
    {
        try {
            $payment = Payment::where('id', $response['payment_id'])->first();
            
            if (!$payment) {
                return [
                    'success' => false,
                    'message' => 'Payment record not found'
                ];
            }
    
            $payment->update([
                'razorpay_payment_id' => $response['razorpay_payment_id'],
                'razorpay_order_id' => $response['razorpay_order_id'],
                'razorpay_signature' => $response['razorpay_signature'],
                'payment_status' => 'completed',
                'status' => 'captured',
                'payment_date' => now(),
            ]);
    
            if (!$this->batch) {
                throw new \Exception('No active batch available for this course.');
            }
    
            DB::table('course_student')->insert([
                'user_id'    => Auth::id(),
                'course_id'  => $this->course->id,
                'batch_id'   => $this->batch->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Award gems based on course fees
            try {
                $gemService = new GemService();
                $gemsToAward = (int)($this->course->discounted_fees * 0.10); // 10% of course fees
                $gemService->earnedGem($gemsToAward, 'Welcome bonus for enrolling in course');
            } catch (\Exception $e) {
                \Log::error('Failed to award enrollment gems: ' . $e->getMessage());
            }
    
            $this->payment_exist = true;
            $this->enrolledCourses[] = $this->course->id;
    
            return ['success' => true];

        } catch (\Exception $e) {
            \Log::error('Payment Verification Error: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Payment verification failed: ' . $e->getMessage()
            ];
        }
    }
    #[On('redirectToDashboard')]
    public function redirectToDashboard()
    {
        return redirect()->route('student.dashboard')->with('success', 'You have successfully enrolled in the course.');
    }
    public function enrollCourse($courseId)
    {
        try {
            $user = auth()->user();
    
            if (!$user->is_active) {
                return redirect()->back()->with('error', 'Your account is inactive. Please contact support.');
            }
    
            if ($user->courses()->where('course_id', $courseId)->exists()) {
                return redirect()->back()->with('error', 'You are already enrolled in this course.');
            }
    
            $hasSubscription = $user->hasActiveSubscription();
            $subscriptionCourseCount = $user->courses()
                ->whereHas('batches', function ($query) {
                    $query->whereDate('end_date', '>=', now());
                })
                ->wherePivot('is_subs', 1)
                ->count();
    
            if (!$hasSubscription) {
                return redirect()->back()->with('warning', 'You need to purchase this course to enroll.');
            }
    
            if ($hasSubscription && $subscriptionCourseCount >= 1) {
                return redirect()->back()->with('warning', 'You have already enrolled in one course with your subscription. Please purchase this course to enroll.');
            }
    
            $batch = Batch::where('course_id', $courseId)
                ->whereDate('end_date', '>=', now())
                ->first();
    
            if (!$batch) {
                return redirect()->back()->with('error', 'No active batch available for this course.');
            }
    
            $user->courses()->attach($courseId, [
                'batch_id' => $batch->id,
                'is_subs' => 1,
            ]);

            // Award gems based on course fees
            try {
                $gemService = new GemService();
                $course = Course::find($courseId);
                $gemsToAward = (int)($course->discounted_fees * 0.10); // 10% of course fees
                $gemService->earnedGem($gemsToAward, 'Welcome bonus for enrolling in course');
            } catch (\Exception $e) {
                \Log::error('Failed to award enrollment gems: ' . $e->getMessage());
            }
    
            $this->enrolledCourses[] = $courseId;
    
            return redirect()->route('student.dashboard')
                ->with('success', "You have successfully enrolled in the course and earned {$gemsToAward} gems!");

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Enrollment failed: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.student.view-course', [
            'course' => $this->course,
            'activeBatches' => $this->activeBatches,
            'courseType' => [
                'type' => ucfirst($this->course->course_type),
                'details' => $this->course->course_type === 'online' ? [
                    'meeting_link' => $this->course->meeting_link,
                    'meeting_id' => $this->course->meeting_id,
                    'meeting_password' => $this->course->meeting_password
                ] : [
                    'venue' => $this->course->venue
                ]
            ]
        ]);
    }
}