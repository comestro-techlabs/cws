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
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Validate;

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
    public $isModalOpen = false;
    public $paymentMode;


    #[Validate('required')] 
    public $student_name = '';
    #[Validate('required')]
    public $student_email = '';
    #[Validate('required')]
    public $amount = '';

    public function mount()
    {
        $this->calculateStats();
        $this->calculateMonthlyPayments();
        $this->courses = Course::latest()->take(3)->get();
        $this->users = User::latest()->take(3)->get();
        $this->enquiries = Enquiry::latest()->take(3)->get();
    }
    public function mode($mode){
        $this->paymentMode = $mode;
        // dd($this->paymentMode);
    }
 

public function storePayment()
{
    $this->validate();

    $user = User::where('email', $this->student_email)->first();

    if (!$user) {
        $user = User::create([
            'name'  => $this->student_name,
            'email' => $this->student_email,
        ]);
    }

    $currentMonth = Carbon::now()->month;
    $currentYear = Carbon::now()->year;

    Payment::create([
        'student_id'   => $user->id,
        'amount'       => $this->amount,
        'total_amount' => $this->amount,
        'month'        => $currentMonth,
        'year'         => $currentYear,
        'status'       => 'captured',
        'method'       => $this->paymentMode,
    ]);

    // Convert month number to full name (e.g., 3 -> March)
    $monthName = Carbon::create()->month($currentMonth)->format('F');

    // Sending raw email
    try {
        $messageBody = "Hello {$user->name},\n\n"
            . "Thank you for your payment of Rs{$this->amount} for {$monthName} {$currentYear}.\n"
            . "Your payment has been successfully processed.\n\n"
            . "Best Regards,\nLearn Syntax";

        Mail::raw($messageBody, function ($message) use ($user) {
            $message->to($user->email)
                ->subject('Payment Successful');
        });
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Payment added but failed to send email.');
    }

    // Reset form fields and close modal
    $this->reset(['student_name', 'student_email', 'amount']);
    $this->isModalOpen = false;
    session()->flash('success', 'Payment added successfully, and email sent!');
}


    public function openModal()
    {
        // $this->resetValidation();
        // $this->reset(['title', 'description', 'image', 'status', 'courseId']);
        $this->isModalOpen = true;
    }
    public function closeModal()
    {
        $this->isModalOpen = false;
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
