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
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $admissionsCount = User::count();

        // counting students here on the basis of purchased courses as well as made a payment:
        $studentsCount = Payment::whereNotNull('course_id')
            ->where('payment_status', 'captured')
            ->distinct('student_id')
            ->count('student_id');

        $categoriesCount = Category::count();
        $coursesCount = Course::count();
        $batchesCount = Batch::count();
        $lessonsCount = Lesson::count();
        $chaptersCount = Chapter::count();
        $enquiriesCount = Enquiry::count();
        $paymentsCount = 0;
        $duePaymentsCount = 0;

        return view('admin.dashboard', compact(
            'admissionsCount',
            'studentsCount',
            'categoriesCount',
            'coursesCount',
            'batchesCount',
            'lessonsCount',
            'enquiriesCount',
            'chaptersCount',
            'paymentsCount',
            'duePaymentsCount'
        ));
        // return view('admin.dashboard');
    }

    // search Course
    public function searchCourse(Request $request)
    {
        $search = $request->search;
        $search_course = Course::whereLike('title', "%$search%")->paginate(10);
        return view("admin.manageCourse", ['courses' => $search_course]);
    }

    public function indexEnquiry()
    {
        $data['enquiry'] = Enquiry::paginate(20);
        return view("admin.manageEnquiry", $data);
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
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'required|digits:10|regex:/^[0-9]{10}$/',
            'status' => 'required|string',  // Adjust as needed for valid statuses
        ]);

        // Update the enquiry with validated data
        $enquiry->update($validatedData);

        // Redirect with a success message
        return redirect()->route('admin.manage.enquiry', $enquiry)->with('success', 'Enquiry updated successfully');
    }

    // showing students who have paid:
    public function managePayment(Request $request)
    {
        // Fetch all payments with related student and course data
        $query = Payment::with(['student', 'course'])
            ->where('payment_status', 'captured'); // Assuming 'captured' means fully paid

        // here checking if the search term is provided:
        if ($request->filled('search')) {
            $search = $request->input('search');

            // filter by student name:
            $query->whereHas('student', function ($studentQuery) use ($search) {
                $studentQuery->where('name', 'LIKE', '%' . $search . '%');
            });
        }

        // fetch results and sort them:
        $payments = $query->orderBy('payment_date', 'desc')->paginate(10);
 
        // pass payments and search term to the view
        return view('admin.managePayment', compact('payments'));

        // ->orderBy('payment_date','desc') //sorting by date in descending order here;
        // ->paginate(10);

    }


    // function to view the payment:
    public function viewPayment($id)
    {
        // Fetch payment with related student and course data
        $payment = Payment::with(['student', 'course'])->findOrFail($id);

        // Return a view to display payment details
        return view('admin.viewPayment', compact('payment'));
    }
    


    // public function showPurchasedCourses($userId)
    // {
    //     // Fetch the user along with their payments and related courses
    //     $user = User::with(['payments.course' => function ($query) {
    //         $query->where('payment_status', 'captured'); // Only successful payments
    //     }])->findOrFail($userId);

    //     return view('purchased-courses', compact('user'));
    // }
}
