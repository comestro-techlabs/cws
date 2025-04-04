<?php

namespace App\Livewire\Student\Billing;

use App\Models\Assignment_upload;
use App\Models\ExamUser;
use App\Models\Payment;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Workshop;
use App\Services\PaymentService;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.student')]
class ViewBilling extends Component
{
    public $hasCompleted;
    public $courses;
    public $paymentsWithWorkshops;
    public $overdueCount;

    protected $paymentService;

    public function mount(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;

        if (!Auth::check()) {
            return redirect()->route('auth.login')->with('error', 'You must be logged in to access this page');
        }
        
        $studentId = Auth::id();
        $user = User::where('id', $studentId)->first();
        $this->overdueCount = $this->paymentService->processOverduePayments();
        $this->hasCompleted = $this->hasCompletedExamOrAssignment($studentId);
        
        $today = Carbon::now();
        $payments = Payment::where('student_id', $studentId)->orderBy('created_at', 'ASC')->get();
        
        $this->paymentsWithWorkshops = $payments->map(function ($payment) use ($today, $user) {
            $workshopTitle = null;
            
            if ($payment->workshop_id) {
                $workshop = Workshop::find($payment->workshop_id);
                $workshopTitle = $workshop ? $workshop->title : null;
            }
            
            if ($payment->status === 'unpaid' && Carbon::parse($payment->due_date)->lt($today)) {
                $payment->status = 'overdue';
                $payment->save();

                if ($user) {
                    $user->is_active = 0;
                    $user->save();
                }
            }
            
            $payment->workshop_title = $workshopTitle;
            return $payment;
        });
        
        $this->courses = User::find($studentId)->courses()->get();
    }

    public function hasCompletedExamOrAssignment($userId)
    {
        $hasExam = ExamUser::where('user_id', $userId)->exists();
        $hasAssignment = Assignment_upload::where('student_id', $userId)->exists();
        return $hasExam || $hasAssignment;
    }

    #[Layout('components.layouts.student')]
    public function render()
    {
        return view('livewire.student.billing.view-billing');
    }
}
