<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(){
        return view('admin.dashboard');
    }

    // search Course
    public function searchCourse(Request $request){
        $search = $request->search;
        $search_course = Course::whereLike('title', "%$search%")->paginate(10);
        return view("admin.manageCourse",['courses' => $search_course]);
    }
    
}
