<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index()
    {
        $courses = Course::where("published", true)->get();;
        return view("public.homepage")->with('courses', $courses);
    }

    public function logIn() {}

    // to visit the sign up page
    public function apply()
    {
        return view("public.register");
    }

    public function register(Request $request){
    // to actually sign up
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'contact' => 'required|string|max:255|unique:users',
        'gender' => 'required|in:male,female,other',
        'education_qualification' => 'required|string|max:255',
        'dob' => 'required|date',
        'password' => 'required|string|min:8',
    ]);

    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'contact' => $request->contact,
        'gender' => $request->gender,
        'education_qualification' => $request->education_qualification,
        'dob' => $request->dob,
        'password' => Hash::make($request->password),
    ]);


    return redirect()->route('public.success');
}

    // to visit the signup page (testing)
    
    public function success(){
        return view("public.success");
    }

    // to view a course details
    public function courseDetails($id) {
        $course = Course::find($id); // replace 1 with course id
        return view("public.course", compact('course'));
    }


    public function viewCourse() {}
}
