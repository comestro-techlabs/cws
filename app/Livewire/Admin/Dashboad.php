<?php

namespace App\Livewire\Admin;

use Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\Payment;
use App\Models\Assignment;
use App\Models\Assignments;
use App\Models\Student;
use App\Models\Batch;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class Dashboad extends Component
{
    #[Layout('components.layouts.admin')]

    public $showPayment = false;
    public $totalPayments;
    public $paymentGrowth;
    public $totalAssignments;
    public $assignmentCompletion;
    public $previousMonthPayments;
    public $totalStudents;
    public $totalBatches;

    public function mount()
    {
        $this->calculatePayments();
        $this->calculateAssignments();
        $this->calculateStudentsAndBatches();
    }

    public function togglePaymentVisibility()
    {
        $this->showPayment = !$this->showPayment;
    }

    private function calculatePayments()
    {
        $this->totalPayments = Payment::where('status', 'captured')->sum('amount');

        $previousMonth = Carbon::now()->subMonth();
        $currentMonthPayments = Payment::where('status', 'captured')
            ->whereMonth('created_at', Carbon::now()->month)
            ->sum('amount');
        $this->previousMonthPayments = Payment::where('status', 'captured')
            ->whereMonth('created_at', $previousMonth->month)
            ->sum('amount');

        $this->paymentGrowth = $this->previousMonthPayments > 0
            ? round((($currentMonthPayments - $this->previousMonthPayments) / $this->previousMonthPayments) * 100, 2)
            : 100;
    }

    private function calculateAssignments()
    {
        $this->totalAssignments = Assignments::count();
        $completedAssignments = Assignments::where('status', 'completed')->count();
        $this->assignmentCompletion = $this->totalAssignments > 0
            ? round(($completedAssignments / $this->totalAssignments) * 100, 2)
            : 0;
    }

    private function calculateStudentsAndBatches()
    {
        $this->totalStudents = User::count();
        $this->totalBatches = Batch::count();
    }

    public function logout()
    {
        FacadesAuth::logout();
        return redirect()->route('auth.login');
    }

    public function render()
    {
        return view('livewire.admin.dashboad', [
            'showPayment' => $this->showPayment,
            'totalPayments' => $this->totalPayments,
            'paymentGrowth' => $this->paymentGrowth,
            'totalAssignments' => $this->totalAssignments,
            'assignmentCompletion' => $this->assignmentCompletion,
            'previousMonthPayments' => $this->previousMonthPayments,
            'totalStudents' => $this->totalStudents,
            'totalBatches' => $this->totalBatches,
        ]);
    }
}
