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
use App\Services\GemService;
use DB;
use Log;
use Picqer\Barcode\BarcodeGeneratorPNG;

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
    public $searchTerm = '';
    public $courseFilter = 'all';
    public $allCourses;
    public $barcodeImage;
    public $offlineCourse;

    public $showModal = false;
    public $paymentId;
    public $course_title;
    public $order_id;
    public $total_amount;
    public $selectedCourseId;
    public function mount($id)
    {
        $this->studentId = $id;
        $this->student = User::findOrFail($id); // Fixed typo: 'USer' to 'User'
        $this->courses = $this->student->courses()
            ->with([
                'batches' => function ($query) {
                    $query->whereDate('end_date', '>=', now());
                }
            ])
            ->withPivot('created_at', 'batch_id')
            ->get();
        $this->isMember = $this->student->is_member == 1;
        $this->isActive = $this->student->is_active == 1;

        $this->offlineCourse = ModelsCourse::whereHas('students', function ($query) {
            $query->where('user_id', $this->studentId);
        })->where('course_type', 'offline')->with('batches')->first();

        $this->purchasedCourses = Payment::with('course')
            ->where('student_id', $id)
            ->where('status', 'captured')
            ->whereNotNull('course_id')
            ->latest()
            ->get() ?? collect();
        $this->paymentsWithWorkshops = Payment::where('student_id', $id)
            ->whereNotNull('workshop_id')
            ->get() ?? collect();
        $this->availableCourses = ModelsCourse::all()->except($this->purchasedCourses->pluck('course_id')->toArray());
        $this->fetchPayments();

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
        $this->allCourses = ModelsCourse::orderBy('title')->get();

        if ($this->student->barcode) {
            $this->barcode = $this->student->barcode;
            try {
                $generator = new BarcodeGeneratorPNG();
                $this->barcodeImage = base64_encode(
                    $generator->getBarcode($this->barcode, $generator::TYPE_CODE_128)
                );
            } catch (\Exception $e) {
                Log::error('Failed to load barcode image on mount: ' . $e->getMessage());
            }
        }
    }

    #[On('updateMembershipData')]
    public function renderMembership()
    {
        $this->isMember = true;
        $this->lastPayment = Payment::where('student_id', $this->studentId)
            ->whereIn('status', ['captured', 'unpaid', 'overdue'])
            ->latest()
            ->get();
    }

    public function createFuturePayment()
    {
        $startDate = Carbon::now();
        $studentId = $this->studentId;

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
            ->latest()
            ->get() ?? collect();
        $this->availableCourses = ModelsCourse::all()->except($this->purchasedCourses->pluck('course_id')->toArray());
    }

    public function hasActiveBatch()
    {
        if ($this->courses->isEmpty()) {
            return false;
        }

        $currentDate = Carbon::today();
        foreach ($this->courses as $course) {
            $batchId = $course->pivot->batch_id ?? null;
            $batch = $batchId
                ? $course->batches->find($batchId)
                : $course->batches->first();

            if ($batch) {
                $startDate = Carbon::parse($batch->start_date)->startOfDay();
                $endDate = Carbon::parse($batch->end_date)->startOfDay();
                if ($currentDate->between($startDate, $endDate)) {
                    return true;
                }
            }
        }
        return false;
    }

    public function generateBarcode($studentId)
    {
        if (!$this->student || $this->courses->isEmpty()) {
            session()->flash('error', 'No courses found for barcode generation');
            return;
        }

        if (!$this->hasActiveBatch()) {
            session()->flash('error', 'No active batches found for barcode generation');
            return;
        }

        $this->barcode = 'LS' . str_pad($studentId, 8, '0', STR_PAD_LEFT);
        $this->student->barcode = $this->barcode;
        $this->student->save();

        try {
            $generator = new BarcodeGeneratorPNG();
            $this->barcodeImage = base64_encode(
                $generator->getBarcode($this->barcode, $generator::TYPE_CODE_128)
            );
            $this->showBarcodeModal = true;
            session()->flash('success', 'Barcode generated successfully');
        } catch (\Exception $e) {
            Log::error('Barcode generation failed: ' . $e->getMessage());
            $this->showBarcodeModal = false;
            session()->flash('error', 'Failed to generate barcode');
        }
    }

    public function closeBarcodeModal()
    {
        $this->showBarcodeModal = false;
    }

    
    public function saveEnrollment()
    {
        $this->validate([
            'total_amount' => 'required|numeric|min:0',
        ]);

        try {
            $course = ModelsCourse::find($this->selectedCourseId);
            if ($course) {
                Payment::create([
                    'student_id' => $this->studentId,
                    'course_id' => $this->selectedCourseId,
                    'payment_type' => 'course',
                    'amount' => $this->total_amount,
                    'total_amount' => $this->total_amount,
                    'transaction_fee' => 0,
                    'currency' => 'INR',
                    'payment_method' => 'cash',
                    'payment_status' => 'completed',
                    'status' => 'captured',
                    'order_id' => $this->order_id,
                    'payment_id' => 'CASH-' . uniqid(),
                    'receipt_no' => 'RCPT-CRS-' . time(),
                    'notes' => "Course: {$course->title}",
                    'payment_date' => now(),
                    'month' => now()->month,
                    'year' => now()->year,
                    'ip_address' => request()->ip()
                ]);

                try {
                    $gemService = new GemService($this->studentId);
                    $gemsToAward = (int) ($this->total_amount * 0.10); 
                    $gemService->earnedGem($gemsToAward, 'Welcome bonus for enrolling in course');
                } catch (\Exception $e) {
                    Log::error('Failed to award enrollment gems: ' . $e->getMessage());
                }

                $this->dispatch('courseEnrollDataUpdated')->self();
                $this->isModalOpen = false;
                $this->closeModal();
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
        // Update purchasedCourses to reflect changes after payment updates
        $this->purchasedCourses = Payment::with('course')
            ->where('student_id', $this->studentId)
            ->where('status', 'captured')
            ->whereNotNull('course_id')
            ->latest()
            ->get() ?? collect();
    }

    public function payWithCash($id)
    {
        $payment = Payment::find($id);

        if ($payment) {
            $payment->status = 'captured';
            $payment->payment_id = 'cash_payment';
            $payment->payment_status = 'completed';
            $payment->payment_method = 'cash'; // Fixed: Changed 'method' to 'payment_method'
            $payment->payment_date = now();
            $payment->save();

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

            $this->student->is_active = true;
            $this->student->save();

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
            $this->courseBatches = [];
            $this->courses = $this->student->courses()->withPivot('created_at', 'batch_id')->get();
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to assign batch');
        }
    }

    public function getFilteredCoursesProperty()
    {
        $query = ModelsCourse::query()
            ->when($this->searchTerm, function ($query) {
                $query->where('title', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('description', 'like', '%' . $this->searchTerm . '%');
            })
            ->whereNotIn('id', $this->purchasedCourses->pluck('course_id')->toArray());

        if ($this->courseFilter !== 'all') {
            $query->where('id', $this->courseFilter);
        }

        return $query->orderBy('title')->get();
    }

    public function updatedSearchTerm()
    {
        $this->availableCourses = $this->filteredCourses;
    }

    public function updatedCourseFilter()
    {
        $this->availableCourses = $this->filteredCourses;
    }

    public function openModal($paymentId)
    {
        $payment = Payment::find($paymentId);
        if ($payment) {
            $this->paymentId = $payment->id;
            $this->course_title = $payment->course->title ?? 'Unknown Course';
            $this->order_id = $payment->order_id;
            $this->total_amount = $payment->total_amount;
            $this->showModal = true;
        }
    }
    public function openModalForEnrollment($courseId)
    {
        $course = ModelsCourse::find($courseId);
        if ($course) {
            $this->selectedCourseId = $courseId;
            $this->course_title = $course->title;
            $this->total_amount = $course->discounted_fees; // Pre-fill with discounted fees
            $this->order_id = 'ORD-' . uniqid(); // Generate a default order ID
            $this->showModal = true;
        }
    }
    public function closeModal()
    {
        $this->showModal = false;
        $this->reset(['paymentId', 'course_title', 'order_id', 'total_amount']);
    }

    public function save()
    {
        $this->validate([
            'course_title' => 'required|string|max:255',
            'order_id' => 'required|string|max:255',
            'total_amount' => 'required|numeric|min:0',
        ]);

        $payment = Payment::find($this->paymentId);
        if ($payment) {
            $payment->update([
                'order_id' => $this->order_id,
                'total_amount' => $this->total_amount,
            ]);
        }

        $this->closeModal();
        $this->dispatch('paymentUpdated')->self(); // Fixed: Replaced emit with dispatch
    }

    public function deletePayment($paymentId)
    {
        $payment = Payment::find($paymentId);
        if ($payment) {
            $payment->delete();
            session()->flash('success', 'Payment deleted successfully');
            $this->dispatch('paymentUpdated')->self(); // Fixed: Replaced emit with dispatch
        } else {
            session()->flash('error', 'Payment not found');
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