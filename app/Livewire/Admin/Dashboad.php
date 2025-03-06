<?php

namespace App\Livewire\Admin;

use Auth;

use App\Models\Assignment;
use App\Models\Assignments;
use App\Models\Student;

use App\Models\User;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use App\Models\Payment;
use App\Models\Course;
use App\Models\Batch;
use App\Models\Enquiry;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth as FacadesAuth;

#[Layout('components.layouts.admin')]
#[Title('Dashboard')]
class Dashboad extends Component
{
    public $showPaymentDetails = false;
    
    public $studentsCount;
    public $coursesCount;
    public $batchesCount;
    public $paymentsCount;
    public $currentMonthAmount;
    public $previousMonthAmount;
    public $overdueCount;
    public $currentMonthOverdue;
    public $previousMonthOverdue;
    public $monthlyPaymentsLabels = [];
    public $monthlyCapturedValues = [];
    public $monthlyOverdueValues = [];
    public $courses;
    public $users;
    public $enquiries;
    public function mount()
    {
        $this->calculateStats();
        $this->calculateMonthlyPayments();
        $this->courses = Course::latest()->take(3)->get();
        $this->users = User::latest()->take(3)->get();
        $this->enquiries = Enquiry::latest()->take(3)->get();
    }

    public function togglePaymentDetails()
    {
        $this->showPaymentDetails = !$this->showPaymentDetails;
    }

    private function calculateStats()
    {
        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;
        $previousYear = Carbon::now()->subMonth()->year;
        $previousMonth = Carbon::now()->subMonth()->month;

        $this->studentsCount = Payment::whereNotNull('course_id')
            ->where('status', 'captured')
            ->distinct('student_id')
            ->count('student_id');
        
        $this->coursesCount = Course::count();
        $this->batchesCount = Batch::count();
        $this->paymentsCount = Payment::where('status', 'captured')->sum('total_amount');
        
        $this->currentMonthAmount = Payment::where('status', 'captured')
            ->whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->sum('total_amount');
            
        $this->previousMonthAmount = Payment::where('status', 'captured')
            ->whereYear('created_at', $previousYear)
            ->whereMonth('created_at', $previousMonth)
            ->sum('total_amount');
            
        $this->overdueCount = Payment::where('status', 'overdue')->sum('total_amount');
        
        $this->currentMonthOverdue = Payment::where('status', 'overdue')
            ->whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->sum('total_amount');
            
        $this->previousMonthOverdue = Payment::where('status', 'overdue')
            ->whereYear('created_at', $previousYear)
            ->whereMonth('created_at', $previousMonth)
            ->sum('total_amount');
    }

    private function calculateMonthlyPayments()
    {
        $months = collect(range(5, 0))->map(fn ($i) => Carbon::now()->subMonths($i)->format('Y-m'))->toArray();

        $monthlyPayments = Payment::select(
            DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month"),
            DB::raw("SUM(CASE WHEN status = 'captured' THEN total_amount ELSE 0 END) as captured_total"),
            DB::raw("SUM(CASE WHEN status = 'overdue' THEN total_amount ELSE 0 END) as overdue_total")
        )
        ->where('created_at', '>=', Carbon::now()->subMonths(5)->startOfMonth())
        ->groupBy(DB::raw("DATE_FORMAT(created_at, '%Y-%m')"))
        ->orderBy('month', 'ASC')
        ->get()
        ->keyBy('month');

        foreach ($months as $month) {
            $this->monthlyPaymentsLabels[] = Carbon::createFromFormat('Y-m', $month)->format('M Y');
            $this->monthlyCapturedValues[] = $monthlyPayments[$month]->captured_total ?? 0;
            $this->monthlyOverdueValues[] = $monthlyPayments[$month]->overdue_total ?? 0;
        }
    }
    public function logout()
    {
        FacadesAuth::logout();
        return redirect()->route('auth.login');
    }
    public function render()
    {
        return view('livewire.admin.dashboad');
    }
}
