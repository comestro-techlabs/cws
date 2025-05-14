<?php

namespace App\Livewire\Admin\Student;

use App\Models\Course as ModelsCourse;
use Illuminate\Support\Facades\Http;
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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Picqer\Barcode\BarcodeGeneratorPNG;

#[Layout('components.layouts.admin')]
#[Title('Manage Students')]
class ViewStudent extends Component
{
    public $student;
    public $studentId;
    public $isMember;
    public $purchasedCourses;
    public $isActive;
    public $paymentsWithWorkshops;
    public $courses;
    public $activeTab = 'attendance';
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
    public $isEditSubscriptionModalOpen = false;
    public $editSubscriptionId;
    public $editPlanId;
    public $editEndsAt;
    public $editStatus;
    public $education_qualification;
    public $isEditing = false;
    public $isEditingCard = false;
    public $name;
    public $email;
    public $contact;
    public $gender;
    public $dob;
    public $editingField = null;
    public $amount;
    public function mount($id)
    {
        $this->studentId = $id;
        $this->loadStudentData();
    }

    private function loadStudentData()
    {
        try {
            $this->student = User::findOrFail($this->studentId);
            $this->name = $this->student->name;
            $this->email = $this->student->email;
            $this->contact = $this->student->contact;
            $this->gender = $this->student->gender;
            $this->education_qualification = $this->student->education_qualification;
            $this->dob = $this->student->dob;
            $this->isMember = $this->student->is_member == 1;
            $this->isActive = $this->student->is_active == 1;

            $this->courses = $this->student->courses()
                ->with([
                    'batches' => function ($query) {
                        $query->whereDate('end_date', '>=', now());
                    }
                ])
                ->withPivot('created_at', 'batch_id')
                ->get();

            $this->offlineCourse = ModelsCourse::whereHas('students', function ($query) {
                $query->where('user_id', $this->studentId);
            })->where('course_type', 'offline')->with('batches')->first();

            $this->purchasedCourses = Payment::with('course')
                ->where('student_id', $this->studentId)
                ->where('status', 'captured')
                ->whereNotNull('course_id')
                ->latest()
                ->get() ?? collect();

            $this->paymentsWithWorkshops = Payment::where('student_id', $this->studentId)
                ->whereNotNull('workshop_id')
                ->get() ?? collect();

            $this->availableCourses = ModelsCourse::all()->except($this->purchasedCourses->pluck('course_id')->toArray());
            $this->subscriptionPlans = SubscriptionPlan::where('is_active', true)->get();
            $this->loadSubscriptionData();
            $this->allCourses = ModelsCourse::orderBy('title')->get();

            if ($this->student->barcode) {
                $this->barcode = $this->student->barcode;
                $this->generateBarcodeImage();
            }
        } catch (\Exception $e) {
            Log::error('Failed to load student data: ' . $e->getMessage());
            session()->flash('error', 'Failed to load student information.');
            $this->redirectRoute('admin.students.index');
        }
    }

    private function generateBarcodeImage()
    {
        try {
            $generator = new BarcodeGeneratorPNG();
            $this->barcodeImage = base64_encode($generator->getBarcode($this->barcode, $generator::TYPE_CODE_128));
        } catch (\Exception $e) {
            Log::error('Failed to generate barcode image: ' . $e->getMessage());
            $this->barcodeImage = null;
        }
    }

    #[On('updateMembershipData')]
    public function renderMembership()
    {
        $this->isMember = true;
        $this->fetchPayments();
    }

    public function createFuturePayment()
    {
        try {
            DB::beginTransaction();
            $startDate = Carbon::now();
            for ($i = 1; $i <= 12; $i++) {
                $dueDate = $startDate->copy()->addDays(28 * $i);
                Payment::create([
                    'student_id' => $this->studentId,
                    'amount' => 700,
                    'receipt_no' => 'RCPT-' . $dueDate->year . '-' . $dueDate->month . '-' . $this->studentId,
                    'transaction_fee' => 700,
                    'due_date' => $dueDate,
                    'status' => 'unpaid',
                    'month' => $dueDate->month,
                    'year' => $dueDate->year,
                    'total_amount' => 700,
                ]);
            }
            $this->student->update(['is_member' => 1]);
            DB::commit();
            $this->dispatch('updateMembershipData')->self();
            session()->flash('success', 'Future payments created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to create future payments: ' . $e->getMessage());
            session()->flash('error', 'Failed to create future payments');
        }
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
        $this->reset(['selectedCourseId', 'total_amount', 'order_id']);
    }

    public function hasActiveBatch()
    {
        if ($this->courses->isEmpty())
            return false;

        $currentDate = Carbon::today();
        foreach ($this->courses as $course) {
            $batchId = $course->pivot->batch_id ?? null;
            $batch = $batchId ? $course->batches->find($batchId) : $course->batches->first();
            if ($batch && $currentDate->between(Carbon::parse($batch->start_date)->startOfDay(), Carbon::parse($batch->end_date)->startOfDay())) {
                return true;
            }
        }
        return false;
    }

    public function editField($field)
    {
        $this->editingField = $field;
        $this->resetErrorBag($field);
    }

    public function cancelEdit()
    {
        $this->editingField = null;
        $this->name = $this->student->name;
        $this->email = $this->student->email;
        $this->contact = $this->student->contact;
        $this->gender = $this->student->gender;
        $this->education_qualification = $this->student->education_qualification;
        $this->dob = $this->student->dob;
        $this->resetErrorBag();
    }

    public function saveField($field)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $this->studentId,
            'contact' => 'nullable|string|max:20',
            'gender' => 'nullable|in:Male,Female,Other',
            'education_qualification' => 'required|string|max:255',
            'dob' => 'nullable|date|before:today',
        ];

        $this->validateOnly($field, $rules);

        try {
            DB::beginTransaction();
            $this->student->update([$field => $this->$field]);
            DB::commit();

            $this->editingField = null;
            $this->resetErrorBag();
            session()->flash('success', ucfirst($field) . ' updated successfully');
            $this->dispatch('field-updated')->self();
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            Log::error("Database error updating $field: " . $e->getMessage());
            session()->flash('error', 'Database error occurred while updating ' . $field . '.');
            $this->addError($field, 'Failed to save changes.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Failed to update $field: " . $e->getMessage());
            session()->flash('error', 'Failed to update ' . $field . '.');
            $this->addError($field, 'An unexpected error occurred.');
        }
    }

    public function edit()
    {
        $this->editField('education_qualification');
    }

    public function cancel()
    {
        $this->cancelEdit();
    }

    public function education()
    {
        $this->saveField('education_qualification');
    }

    public function openEditSubscriptionModal($subscriptionId)
    {
        try {
            $subscription = Subscription::findOrFail($subscriptionId);
            $this->editSubscriptionId = $subscription->id;
            $this->editPlanId = $subscription->plan_id;
            $this->editEndsAt = $subscription->ends_at->format('Y-m-d');
            $this->editStatus = $subscription->status;
            $this->isEditSubscriptionModalOpen = true;
        } catch (\Exception $e) {
            Log::error('Failed to open edit subscription modal: ' . $e->getMessage());
            session()->flash('error', 'Failed to load subscription data.');
        }
    }

    public function saveEditedSubscription()
    {
        $this->validate([
            'editPlanId' => 'required|exists:subscription_plans,id',
            'editEndsAt' => 'required|date|after_or_equal:today',
            'editStatus' => 'required|in:active,inactive,cancelled',
        ]);

        try {
            DB::beginTransaction();
            $subscription = Subscription::findOrFail($this->editSubscriptionId);
            $subscription->update([
                'plan_id' => $this->editPlanId,
                'ends_at' => Carbon::parse($this->editEndsAt),
                'status' => $this->editStatus,
            ]);
            DB::commit();

            $this->loadSubscriptionData();
            $this->isEditSubscriptionModalOpen = false;
            session()->flash('success', 'Subscription updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to update subscription: ' . $e->getMessage());
            session()->flash('error', 'Failed to update subscription');
        }
    }

    public function closeEditSubscriptionModal()
    {
        $this->isEditSubscriptionModalOpen = false;
        $this->reset(['editSubscriptionId', 'editPlanId', 'editEndsAt', 'editStatus']);
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

        try {
            $this->barcode = 'LS' . str_pad($studentId, 8, '0', STR_PAD_LEFT);
            $this->student->update(['barcode' => $this->barcode]);
            $this->generateBarcodeImage();
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
            'selectedCourseId' => 'required|exists:courses,id',
        ]);

        try {
            DB::beginTransaction();
            $course = ModelsCourse::findOrFail($this->selectedCourseId);
            $courseAmount = $course->discounted_fees ?? $course->fees;

            if ($this->total_amount > $courseAmount) {
                throw new \Exception('Paid amount cannot exceed course fees.');
            }

            $existingPayment = Payment::where('student_id', $this->studentId)
                ->where('course_id', $this->selectedCourseId)
                ->where('status', 'captured')
                ->first();

            if ($existingPayment) {
                throw new \Exception('Student is already enrolled in this course.');
            }

            $dueAmount = $courseAmount - $this->total_amount;

            $payment = Payment::create([
                'student_id' => $this->studentId,
                'course_id' => $this->selectedCourseId,
                'payment_type' => 'course',
                'amount' => $courseAmount,
                'total_amount' => $this->total_amount,
                'transaction_fee' => 0,
                'currency' => 'INR',
                'payment_method' => 'cash',
                'payment_status' => 'completed',
                'status' => 'captured',
                'order_id' => $this->order_id ?? 'ORD-' . uniqid(),
                'payment_id' => 'CASH-' . uniqid(),
                'receipt_no' => 'RCPT-CRS-' . time(),
                'notes' => "Course: {$course->title}",
                'payment_date' => now(),
                'month' => now()->month,
                'year' => now()->year,
                'ip_address' => request()->ip(),
            ]);

            $gemService = new GemService($this->studentId);
            $gemsToAward = (int) ($this->total_amount * 0.10);
            $gemService->earnedGem($gemsToAward, 'Welcome bonus for enrolling in course');

            DB::commit();

            $this->dispatch('courseEnrollDataUpdated')->self();
            $this->isModalOpen = false;
            $this->closeModal();
            session()->flash('success', 'Course enrolled successfully' . ($dueAmount > 0 ? ' with due amount of ' . $dueAmount : ''));

            // Send SMS notification
            $this->sendEnrollmentNotification($course->title);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to enroll in course: ' . $e->getMessage());
            session()->flash('error', $e->getMessage() ?: 'Failed to enroll in course');
        }
    }

    private function sendEnrollmentNotification($courseTitle)
    {
        $user = User::find($this->studentId);
        if (!$user) {
            session()->flash('error', 'User not found');
            return;
        }

        $contact = preg_replace('/[^0-9]/', '', $user->contact);
        $userName = $user->name;

        try {
            $response = Http::timeout(5)->withHeaders([
                'authkey' => env('MSG91_AUTH_KEY'),
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->post('https://control.msg91.com/api/v5/flow', [
                        'template_id' => '68026bbbd6fc0563fd0faa54',
                        'short_url' => 0,
                        'recipients' => [
                            [
                                'mobiles' => '91' . $contact,
                                'name' => $userName,
                                'course' => $courseTitle,
                            ]
                        ]
                    ]);

            if (!$response->successful()) {
                Log::error('SMS sending failed', [
                    'user_id' => $user->id,
                    'error' => $response->body(),
                    'status' => $response->status()
                ]);

                session()->flash('warning', 'Course enrollment successful but SMS notification failed.');
            }
        } catch (\Exception $e) {
            Log::error('SMS sending error', [
                'user_id' => $user->id,
                'error' => $e->getMessage()
            ]);

            session()->flash('warning', 'Course enrollment successful but SMS notification failed.');
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
        $this->purchasedCourses = Payment::with('course')
            ->where('student_id', $this->studentId)
            ->where('status', 'captured')
            ->whereNotNull('course_id')
            ->latest()
            ->get() ?? collect();
    }

    public function payWithCash($id)
    {
        try {
            $payment = Payment::findOrFail($id);
            $payment->update([
                'status' => 'captured',
                'payment_id' => 'cash_payment',
                'payment_status' => 'completed',
                'payment_method' => 'cash',
                'payment_date' => now(),
            ]);
            $this->dispatch('paymentUpdated')->self();
            session()->flash('success', 'Payment updated successfully');
        } catch (\Exception $e) {
            Log::error('Failed to process cash payment: ' . $e->getMessage());
            session()->flash('error', 'Failed to process payment');
        }
    }

    public function payDueAmount($paymentId)
    {
        try {
            $payment = Payment::findOrFail($paymentId);
            $dueAmount = $payment->amount - $payment->total_amount;

            if ($dueAmount <= 0) {
                throw new \Exception('No due amount to pay.');
            }

            $this->validate([
                'total_amount' => 'required|numeric|min:0|max:' . $dueAmount,
            ]);

            DB::beginTransaction();

            $payment->update([
                'total_amount' => $payment->total_amount + $this->total_amount,
                'payment_date' => now(),
            ]);

            DB::commit();

            $this->dispatch('paymentUpdated')->self();
            $this->closeModal();
            session()->flash('success', 'Due amount paid successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to pay due amount: ' . $e->getMessage());
            session()->flash('error', $e->getMessage() ?: 'Failed to pay due amount');
        }
    }

    public function openDuePaymentModal($paymentId)
    {
        try {
            $payment = Payment::findOrFail($paymentId);
            $this->paymentId = $payment->id;
            $this->course_title = $payment->course->title ?? 'Unknown Course';
            $this->amount = $payment->amount;
            $this->total_amount = $payment->amount - $payment->total_amount;
            $this->order_id = 'ORD-' . uniqid();
            $this->showModal = true;
        } catch (\Exception $e) {
            Log::error('Failed to open due payment modal: ' . $e->getMessage());
            session()->flash('error', 'Failed to load payment data');
        }
    }

    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
        if ($tab === 'attendance') {
            $this->dispatch('show-attendance-tab');
        }
    }

    public function subscribePlan($planId)
    {
        try {
            DB::beginTransaction();
            $plan = SubscriptionPlan::findOrFail($planId);
            $subscription = Subscription::create([
                'user_id' => $this->studentId,
                'plan_id' => $planId,
                'starts_at' => now(),
                'ends_at' => now()->addDays($plan->duration_in_days),
                'status' => 'active',
                'payment_status' => 'completed',
                'payment_method' => 'cash',
                'transaction_id' => 'CASH-' . uniqid(),
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
                'ip_address' => request()->ip(),
            ]);

            $this->student->update(['is_active' => true]);
            DB::commit();

            $this->loadSubscriptionData();
            $this->fetchPayments();
            session()->flash('success', 'Subscription activated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to activate subscription: ' . $e->getMessage());
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
        if (empty($batchId))
            return;

        try {
            DB::beginTransaction();
            DB::table('course_student')->updateOrInsert(
                ['user_id' => $this->studentId, 'course_id' => $courseId],
                ['batch_id' => $batchId, 'updated_at' => now()]
            );
            DB::commit();

            $this->courseBatches = [];
            $this->courses = $this->student->courses()->withPivot('created_at', 'batch_id')->get();
            session()->flash('success', 'Batch assigned successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to assign batch: ' . $e->getMessage());
            session()->flash('error', 'Failed to assign batch');
        }
    }

    public function updatedSearchTerm()
    {
        $this->availableCourses = $this->getFilteredCoursesProperty();
    }

    public function updatedCourseFilter()
    {
        $this->availableCourses = $this->getFilteredCoursesProperty();
    }

    public function getFilteredCoursesProperty()
    {
        return ModelsCourse::query()
            ->when($this->searchTerm, fn($query) => $query->where('title', 'like', '%' . $this->searchTerm . '%')->orWhere('description', 'like', '%' . $this->searchTerm . '%'))
            ->when($this->courseFilter !== 'all', fn($query) => $query->where('id', $this->courseFilter))
            ->whereNotIn('id', $this->purchasedCourses->pluck('course_id')->toArray())
            ->orderBy('title')
            ->get();
    }

    public function openModal($paymentId)
    {
        try {
            $payment = Payment::findOrFail($paymentId);
            $this->paymentId = $payment->id;
            $this->course_title = $payment->course->title ?? 'Unknown Course';
            $this->order_id = $payment->order_id;
            $this->total_amount = $payment->total_amount;
            $this->amount = $payment->amount;
            $this->showModal = true;
        } catch (\Exception $e) {
            Log::error('Failed to open payment modal: ' . $e->getMessage());
            session()->flash('error', 'Failed to load payment data');
        }
    }

    public function openModalForEnrollment($courseId)
    {
        try {
            $course = ModelsCourse::findOrFail($courseId);
            $this->selectedCourseId = $courseId;
            $this->course_title = $course->title;
            $this->amount = $course->discounted_fees ?? $course->fees;
            $this->total_amount = $this->amount;
            $this->order_id = 'ORD-' . uniqid();
            $this->showModal = true;
        } catch (\Exception $e) {
            Log::error('Failed to open enrollment modal: ' . $e->getMessage());
            session()->flash('error', 'Failed to load course data');
        }
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->reset(['paymentId', 'course_title', 'order_id', 'total_amount', 'selectedCourseId', 'amount']);
    }

    public function save()
    {
        $this->validate([
            'order_id' => 'required|string|max:255',
            'total_amount' => 'nullable|numeric|min:0',
        ]);

        try {
            $payment = Payment::findOrFail($this->paymentId);
            if ($this->total_amount > $payment->amount) {
                throw new \Exception('Paid amount cannot exceed course fees.');
            }

            $payment->update([
                'order_id' => $this->order_id,
                'total_amount' => $this->total_amount,
            ]);

            $this->closeModal();
            $this->dispatch('paymentUpdated')->self();
            session()->flash('success', 'Payment updated successfully');
        } catch (\Exception $e) {
            Log::error('Failed to save payment: ' . $e->getMessage());
            session()->flash('error', $e->getMessage() ?: 'Failed to update payment');
        }
    }

    public function deletePayment($paymentId)
    {
        try {
            $payment = Payment::findOrFail($paymentId);
            $payment->delete();
            $this->dispatch('paymentUpdated')->self();
            session()->flash('success', 'Payment deleted successfully');
        } catch (\Exception $e) {
            Log::error('Failed to delete payment: ' . $e->getMessage());
            session()->flash('error', 'Failed to delete payment');
        }
    }

    public function deletePaymentHistory($paymentId)
    {
        try {
            $payment = Payment::findOrFail($paymentId);
            $payment->delete();
            $this->dispatch('paymentUpdated')->self();
            session()->flash('success', 'Payment history deleted successfully');
        } catch (\Exception $e) {
            Log::error('Failed to delete payment history: ' . $e->getMessage());
            session()->flash('error', 'Failed to delete payment history');
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