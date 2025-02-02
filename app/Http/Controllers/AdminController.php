<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Category;
use App\Models\Chapter;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Enquiry;
use App\Models\Payment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;
        $previousYear = Carbon::now()->subMonth()->year;
        $previousMonth = Carbon::now()->subMonth()->month;

        // $capturedPayments = Payment::where('status', 'captured');

        $counts = [
            'studentsCount' => Payment::whereNotNull('course_id')
                ->where('status', 'captured')
                ->distinct('student_id')
                ->count('student_id'),
            'coursesCount' => Course::count(),
            'batchesCount' => Batch::count(),
            // 'paymentsCount' => Payment::sum('amount'),
            'paymentsCount' => Payment::where('status', 'captured')->sum('total_amount'),
            'currentMonthAmount' => Payment::where('status', 'captured')
                ->whereYear('created_at', $currentYear)
                ->whereMonth('created_at', $currentMonth)
                ->sum('total_amount'),
            'previousMonthAmount' => Payment::where('status', 'captured')
                ->whereYear('created_at', $previousYear)
                ->whereMonth('created_at', $previousMonth)
                ->sum('total_amount'),
            'overdueCount' => Payment::where('status', 'overdue')->sum('total_amount'),
            'currentMonthOverdue' => Payment::where('status', 'overdue')
                ->whereYear('created_at', $currentYear)
                ->whereMonth('created_at', $currentMonth)
                ->sum('total_amount'),
            'previousMonthOverdue' => Payment::where('status', 'overdue')
                ->whereYear('created_at', $previousYear)
                ->whereMonth('created_at', $previousMonth)
                ->sum('total_amount'),

        ];
        return view('admin.dashboard', $counts);
    }


    // search Course
    public function searchCourse(Request $request)
    {
        $search = $request->search;
        $search_course = Course::whereLike('title', value: "%$search%")->paginate(10);
        return view("admin.manageCourse", ['courses' => $search_course, "search" => $search]);
    }

    public function searchEnquiry(Request $request)
    {
        $search = $request->search;
        $search_enquiry = Enquiry::whereLike('name', "%$search%")->paginate(10);
        return view("admin.manageEnquiry", ['enquiry' => $search_enquiry]);
    }

    public function editEnquiry(Enquiry $enquiry)
    {
        return view('admin.edit_enquiry', compact('enquiry'));
    }

    public function updateEnquiry(Request $request, Enquiry $enquiry)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'required|digits:10|regex:/^[0-9]{10}$/',
            'status' => 'required|string',
        ]);

        $enquiry->update($validatedData);

        return redirect()->route('admin.manage.enquiry', $enquiry)->with('success', 'Enquiry updated successfully');
    }


    public function managePayment(Request $request)
    {
        $query = Payment::with(['student', 'course'])
            ->where('status', 'captured');

        // Search filter for student name
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->whereHas('student', function ($studentQuery) use ($search) {
                $studentQuery->where('name', 'LIKE', "%{$search}%");
            });
        }

        // Fetch and paginate results, sorted by payment date
        $payments = $query->latest('payment_date')->paginate(10);

        // Return view with payments and search term
        return view('admin.managePayment', [
            'payments' => $payments,
            'search' => $request->input('search'),
        ]);
    }



    // function to view the payment:
    public function viewPayment($id)
    {
        // Fetch payment with related student and course data
        $payment = Payment::with(['student', 'course'])->findOrFail($id);

        // Return a view to display payment details
        return view('admin.viewPayment', compact('payment'));
    }

    // ------------------------------------------------- tested ---------------------------------------

}
