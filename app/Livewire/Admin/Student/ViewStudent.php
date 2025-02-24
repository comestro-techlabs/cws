<?php

namespace App\Livewire\Admin\Student;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use App\Models\User;
use App\Models\Payment;

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
    public $activeTab = 'courses';
    public $dueDate;
    public function mount($id)
    {
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
