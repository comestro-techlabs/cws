<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Category;
use App\Models\Chapter;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Enquiry;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(){
        $admissionsCount = User::count();
        $studentsCount = User::count();
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
    public function searchCourse(Request $request){
        $search = $request->search;
        $search_course = Course::whereLike('title', "%$search%")->paginate(10);
        return view("admin.manageCourse",['courses' => $search_course]);
    }

    public function indexEnquiry()
    {
        $data['enquiry'] = Enquiry::paginate(20);
        return view("admin.manageEnquiry",$data);
    }

    public function searchEnquiry(Request $request){
        $search = $request->search;
        $search_enquiry = Enquiry::whereLike('name', "%$search%")->paginate(10);
        return view("admin.manageEnquiry",['enquiry' => $search_enquiry]);
    }
    
}
