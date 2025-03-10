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


    public function mount($id)
    {
        // dd($id); this is user/student id
        $this->studentId = $id;
        $this->student = USer::findOrFail($id);
        $this->courses = $this->student->courses()->withPivot('created_at', 'batch_id')->get();
        $this->isMember = $this->student->is_member == 1;
        $this->isActive = $this->student->is_active == 1;
        $this->lastPayment = Payment::where('student_id', $id)
            ->where('status', 'captured')
            ->latest()
            ->first();

        if ($this->lastPayment) {
            $this->dueDate = $this->lastPayment->created_at->addMonth();
            $this->isPaymentDue = now()->greaterThan($this->dueDate);
            $this->overdueDays = $this->isPaymentDue ? now()->diffInDays($this->dueDate) : 0;
        } else {
            $this->dueDate = null;
            $this->isPaymentDue = true;
            $this->overdueDays = null;
        }

        $this->purchasedCourses = Payment::with('course')
            ->where('student_id', $id)
            ->where('status', 'captured')
            ->whereNotNull('course_id')
            ->get() ?? collect();
        $this->paymentsWithWorkshops = Payment::where('student_id', $id)
            ->whereNotNull('workshop_id')
            ->get() ?? collect();
        $this->availableCourses = ModelsCourse::all()->except($this->purchasedCourses->pluck('course_id')->toArray());
        $this->fetchPayments();
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
                'total_amount' =>  700,
            ]);

           
        }
        $this->student->is_member = 1;
        $this->student->save();
    }

    #[On('courseEnrollDataUpdated')]
    public function updateCourseModal()
    {
        $this->purchasedCourses = Payment::with('course')
            ->where('student_id', $this->studentId)
            ->where('status', 'captured')
            ->whereNotNull('course_id')
            ->get() ?? collect();
        $this->availableCourses = ModelsCourse::all()->except($this->purchasedCourses->pluck('course_id')->toArray());
        // dd($this->availableCourses);
    }

    public function enrollCourse($course_id)
    {
        $course_data = ModelsCourse::find($course_id);
        // dd($course_data);
        if ($course_data) {
            Payment::create([
                'student_id' => $this->studentId,
                'course_id' => $course_id,
                'status' => 'captured',
                'payment_id' => 'cash_payment',
                'payment_status' => 'completed',
                'method' => 'cash',
                'month' => now()->month,
                'year' => now()->year,
                'transaction_fee' => $course_data->discounted_fees,
                'amount' => $course_data->discounted_fees,
                'total_amount' => $course_data->discounted_fees,
                'payment_date' => now(),
            ]);
        }
        // yha se course enroll k bad courseEnrollDataUpdated event dispatch krke updateCourseModal function call kra hai, isi component me
        $this->dispatch('courseEnrollDataUpdated')->self();
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
    public function render()
    {

        return view('livewire.admin.student.view-student', [
            'student' => $this->student,
            'purchasedCourses' => $this->purchasedCourses,
            'courses' => $this->courses,
        ]);
    }
}
