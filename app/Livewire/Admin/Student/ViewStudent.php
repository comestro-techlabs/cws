<?php

namespace App\Livewire\Admin\Student;

use App\Livewire\Student\Course;
use App\Models\Course as ModelsCourse;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use App\Models\User;
use App\Models\Payment;
use Carbon\Carbon;
use Livewire\Attributes\On;
use App\Models\SubscriptionPlan;
use App\Models\Subscription;
use App\Models\Batch;
use DB;

#[Layout('components.layouts.admin')]
#[Title('Manage Students')]
class ViewStudent extends Component
{
    public $student;
    public $isMember;
    public $purchasedCourses;
    public $paymentsGroupedByCourse;
    public $isActive;
    public $paymentsWithWorkshops;
    public $overdueDays;
    public $isPaymentDue;
    public $lastPayment;
    public $courses;
    public $studentId;
    public $activeTab = 'courses';
    public $dueDate;
    public $isModalOpen = false;
    public $availableCourses = [];
    public $subscriptionPlans;
    public $activeSubscription;
    public $subscriptionHistory;
    public $courseBatches = [];
    public $selectedBatch;
    public $barcode;
    public $showBarcodeModal = false;

    public function mount($id)
    {
        // dd($id); this is user/student id
        $this->studentId = $id;
        $this->student = USer::findOrFail($id);
        $this->courses = $this->student->courses()->withPivot('created_at', 'batch_id')->get();
        $this->isMember = $this->student->is_member == 1;
        $this->isActive = $this->student->is_active == 1;
        // $this->lastPayment = Payment::where('student_id', $id)
        //     ->where('status', 'captured')
        //     ->latest()
        //     ->first();

        // if ($this->lastPayment) {
        //     $this->dueDate = $this->lastPayment->created_at->addMonth();
        //     $this->isPaymentDue = now()->greaterThan($this->dueDate);
        //     $this->overdueDays = $this->isPaymentDue ? now()->diffInDays($this->dueDate) : 0;
        // } else {
        //     $this->dueDate = null;
        //     $this->isPaymentDue = true;
        //     $this->overdueDays = null;
        // }

        $this->purchasedCourses = Payment::with('course')
            ->where('student_id', $id)
            ->where('status', 'captured')
            ->whereNotNull('course_id')
            ->latest() // This will order by created_at desc
            ->get() ?? collect();
        $this->paymentsWithWorkshops = Payment::where('student_id', $id)
            ->whereNotNull('workshop_id')
            ->get() ?? collect();
        $this->availableCourses = ModelsCourse::all()->except($this->purchasedCourses->pluck('course_id')->toArray());
        $this->fetchPayments();
        // $this->renderMembership();

        // Load subscription data
        $this->subscriptionPlans = SubscriptionPlan::where('is_active', true)->get();
        $this->activeSubscription = Subscription::where('user_id', $id)
            ->where('status', 'active')
            ->where('ends_at', '>', now())
            ->with('plan')
            ->first();
        $this->subscriptionHistory = Subscription::where('user_id', $id)
            ->with('plan')
            ->orderBy('created_at', 'desc')
            ->get();
    }
    #[On('updateMembershipData')]
    public function renderMembership()
    {
        $this->isMember = true;
        // dd("testing by shaique");
        $this->lastPayment = Payment::where('student_id', $this->studentId)
            ->whereIn('status', ['captured', 'unpaid', 'overdue'])
            ->latest()
            ->get();


        // dd($this->lastPayment);

    }
    public function createFuturePayment()
    {
        $startDate = Carbon::now();
        $studentId = $this->studentId;

        // Create 12 payments (total 12)
        for ($i = 1; $i <= 12; $i++) {
            $dueDate = $startDate->copy()->addDays(28 * $i);
            $year = $dueDate->year;
            $month = $dueDate->month;

            Payment::create([
                'student_id' => $studentId,
                'amount' => 700,
                'receipt_no' => 'RCPT-' . $year . '-' . $month . '-' . $studentId,
                'transaction_fee' => 700,
                'due_date' => $dueDate,
                'status' => 'unpaid',
                'month' => $month,
                'year' => $year,
                'total_amount' => 700,
            ]);


        }
        $this->student->is_member = 1;
        $this->student->save();
        $this->dispatch('updateMembershipData')->self();
    }


    #[On('courseEnrollDataUpdated')]
    public function updateCourseModal()
    {
        $this->purchasedCourses = Payment::with('course')
            ->where('student_id', $this->studentId)
            ->where('status', 'captured')
            ->whereNotNull('course_id')
            ->latest() // This will order by created_at desc
            ->get() ?? collect();
        $this->availableCourses = ModelsCourse::all()->except($this->purchasedCourses->pluck('course_id')->toArray());
        // dd($this->availableCourses);
    }
    public function generateBarcode($studentId)
    {
        $student = User::find($studentId);
        if ($student) {
            $this->barcode = 'LS' . str_pad($studentId, 8, '0', STR_PAD_LEFT);
            $student->barcode = $this->barcode;
            $student->save();
            $this->showBarcodeModal = true;  // Show the modal
        }
    }

    public function closeBarcodeModal()
    {
        $this->showBarcodeModal = false;  // Close the modal
        $this->barcode = null;  // Clear the barcode
    }
    public function enrollCourse($course_id)
    {
        try {
            $course_data = ModelsCourse::find($course_id);
            if ($course_data) {
                Payment::create([
                    'student_id' => $this->studentId,
                    'course_id' => $course_id,
                    'payment_type' => 'course',
                    'amount' => $course_data->discounted_fees,
                    'total_amount' => $course_data->discounted_fees,
                    'transaction_fee' => 0,
                    'currency' => 'INR',
                    'payment_method' => 'cash',
                    'payment_status' => 'completed',
                    'status' => 'captured',
                    'order_id' => 'ORD-' . uniqid(),
                    'payment_id' => 'CASH-' . uniqid(),
                    'receipt_no' => 'RCPT-CRS-' . time(),
                    'notes' => "Course: {$course_data->title}",
                    'payment_date' => now(),
                    'month' => now()->month,
                    'year' => now()->year,
                    'ip_address' => request()->ip()
                ]);

                $this->dispatch('courseEnrollDataUpdated')->self();
                $this->isModalOpen = false; // Close modal after successful enrollment
                session()->flash('success', 'Course enrolled successfully');
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to enroll in course');
        }
    }

    public function enrollButtonOpenModal()
    {
        $this->isModalOpen = true;
    }
    public function enrollButtonCloseModal()
    {
        $this->isModalOpen = false;
    }
    #[On('paymentUpdated')]
    public function fetchPayments()
    {
        $this->lastPayment = Payment::where('student_id', $this->studentId)
            ->whereIn('status', ['captured', 'unpaid'])
            ->orderBy('created_at')
            ->get();
    }
    public function payWithCash($id)
    {
        $payment = Payment::find($id);

        if ($payment) {
            $payment->status = 'captured';
            $payment->payment_id = 'cash_payment';
            $payment->payment_status = 'completed';
            $payment->method = 'cash';
            $payment->payment_date = now();
            $payment->save();

            // yha se paymentUpdated event dispatch krke fetchPayments function call kra hai, isi component me
            $this->dispatch('paymentUpdated')->self();
        }
    }
    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function subscribePlan($planId)
    {
        try {
            $plan = SubscriptionPlan::findOrFail($planId);

            // Create new subscription
            $subscription = Subscription::create([
                'user_id' => $this->studentId,
                'plan_id' => $planId,
                'starts_at' => now(),
                'ends_at' => now()->addDays($plan->duration_in_days),
                'status' => 'active',
                'payment_status' => 'completed',
                'payment_method' => 'cash',
                'transaction_id' => 'CASH-' . uniqid()
            ]);

            // Create payment record
            Payment::create([
                'student_id' => $this->studentId,
                'payment_type' => 'subscription',
                'amount' => $plan->price,
                'total_amount' => $plan->price,
                'transaction_fee' => 0,
                'currency' => 'INR',
                'payment_method' => 'cash',
                'payment_status' => 'completed',
                'status' => 'captured',
                'order_id' => 'ORD-' . uniqid(),
                'payment_id' => $subscription->transaction_id,
                'receipt_no' => 'RCPT-SUB-' . time(),
                'notes' => "Subscription Plan: {$plan->name}",
                'payment_date' => now(),
                'month' => now()->month,
                'year' => now()->year,
                'ip_address' => request()->ip()
            ]);

            // Update student status if needed
            $this->student->is_active = true;
            $this->student->save();

            // Refresh subscription data and payments
            $this->loadSubscriptionData();
            $this->fetchPayments();

            session()->flash('success', 'Subscription activated successfully');
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to activate subscription');
        }
    }

    private function loadSubscriptionData()
    {
        $this->activeSubscription = Subscription::where('user_id', $this->studentId)
            ->where('status', 'active')
            ->where('ends_at', '>', now())
            ->with('plan')
            ->first();

        $this->subscriptionHistory = Subscription::where('user_id', $this->studentId)
            ->with('plan')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function loadCourseBatches($courseId)
    {
        $this->courseBatches = Batch::where('course_id', $courseId)
            ->whereDate('end_date', '>=', now())
            ->get();
    }

    public function assignBatch($courseId, $batchId)
    {
        try {
            if (empty($batchId)) {
                return;
            }

            DB::table('course_student')
                ->updateOrInsert(
                    [
                        'user_id' => $this->studentId,
                        'course_id' => $courseId,
                    ],
                    [
                        'batch_id' => $batchId,
                        'updated_at' => now()
                    ]
                );

            session()->flash('success', 'Batch assigned successfully');
            $this->courseBatches = []; // Hide the select after successful assignment
            $this->courses = $this->student->courses()->withPivot('created_at', 'batch_id')->get();
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to assign batch');
        }
    }

    public function render()
    {
        $payments = Payment::where('student_id', $this->studentId)
            ->with(['course'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('livewire.admin.student.view-student', [
            'student' => $this->student,
            'purchasedCourses' => $this->purchasedCourses,
            'courses' => $this->courses,
            'subscriptionPlans' => $this->subscriptionPlans,
            'activeSubscription' => $this->activeSubscription,
            'subscriptionHistory' => $this->subscriptionHistory,
            'payments' => $payments,
        ]);
    }
}
