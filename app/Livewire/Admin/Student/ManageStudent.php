<?php

namespace App\Livewire\Admin\Student;

use App\Models\Course;
use App\Models\Payment;
use App\Models\SubscriptionPlan;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.admin')]
#[Title('Manage Students')]
class ManageStudent extends Component
{
    use WithPagination;

    public $search = '';
    public $subscriptionFilter = '';
    public $courseFilter = '';
    public $membershipFilter = '';
    public $statusFilter = '';
    public $dueFilter = '';
    public $courses;
    public $subscriptionPlans;
    public $barcode;
    public $showBarcodeModal = false;
    protected $paginationTheme = 'tailwind';
    protected $queryString = ['filter', 'search', 'dueFilter'];

    public function mount()
    {
        $this->courses = Course::where('published', true)->get();
        $this->subscriptionPlans = SubscriptionPlan::where('is_active', true)->get();
    }

    public function resetFilters()
    {
        $this->search = '';
        $this->subscriptionFilter = '';
        $this->courseFilter = '';
        $this->membershipFilter = '';
        $this->statusFilter = '';
        $this->dueFilter = '';
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function status($studentId)
    {
        $student = User::find($studentId);
        if ($student) {
            $student->is_active = !$student->is_active;
            $student->save();
        }
    }

    public function generateBarcode($studentId)
    {
        $student = User::find($studentId);
        $this->barcode = 'STU' . str_pad($studentId, 8, '0', STR_PAD_LEFT);
        $student->barcode = $this->barcode;
        $student->save();
        $this->showBarcodeModal = true;
    }

    public function closeBarcodeModal()
    {
        $this->showBarcodeModal = false;
        $this->barcode = null;
    }

    public function render()
{
    $students = User::query()
        ->where('isAdmin', false)
        ->with([
            'payments' => function ($query) {
                $query->with('course');
            },
            'subscriptions' => function ($query) {
                $query->where('status', 'active')
                      ->whereDate('ends_at', '>=', now())
                      ->with('plan');
            }
        ])
        ->when($this->search, function ($query) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('email', 'like', '%' . $this->search . '%')
                  ->orWhere('contact', 'like', '%' . $this->search . '%');
            });
        })
        ->when($this->subscriptionFilter, function ($query) {
            $query->whereHas('subscriptions', function ($q) {
                $q->where('plan_id', $this->subscriptionFilter)
                  ->where('status', 'active')
                  ->whereDate('ends_at', '>=', now());
            });
        })
        ->when($this->courseFilter, function ($query) {
            $query->whereHas('payments', function ($q) {
                $q->where('course_id', $this->courseFilter);
            });
        })
        ->when($this->membershipFilter, function ($query) {
            $query->where('is_member', $this->membershipFilter === 'member');
        })
        ->when($this->statusFilter, function ($query) {
            $query->where('is_active', $this->statusFilter === 'active');
        })
        ->when($this->dueFilter, function ($query) {
            if ($this->dueFilter === 'has_due') {
                $query->whereHas('payments', function ($q) {
                    $q->whereRaw('payments.total_amount < courses.discounted_fees')
                      ->join('courses', 'payments.course_id', '=', 'courses.id');
                });
            } elseif ($this->dueFilter === 'no_payments') {
                $query->whereDoesntHave('payments');
            }
        })
        ->orderBy('created_at', 'desc')
        ->paginate(10);

    foreach ($students as $student) {
        $student->total_due = 0;
        foreach ($student->payments as $payment) {
            if ($payment->course) {
                $coursePrice = $payment->course->discounted_fees;
                $totalAmount = $payment->total_amount ?? 0;
                $due = $coursePrice - $totalAmount;
                if ($due > 0) {
                    $student->total_due += $due;
                }
            }
        }
    }

    return view('livewire.admin.student.manage-student', [
        'students' => $students,
    ]);
}
}