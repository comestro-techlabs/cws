<?php

namespace App\Livewire\Admin\Student;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use App\Models\User;
use App\Models\Payment;
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
    // protected $listeners = ['paymentUpdated' => 'fetchPayments'];

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
            ->get()?? collect();;
            $this->paymentsWithWorkshops = Payment::where('student_id', $id)
            ->whereNotNull('workshop_id')
            ->get()?? collect();;

            $this->fetchPayments();

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
