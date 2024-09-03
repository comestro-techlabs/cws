<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\HireUs;
use App\Models\User;
use App\Models\Enquiry;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicController extends Controller
{
    public function index()
    {
        return view("public.homepage");
    }



    // to visit the sign up page
    // public function apply()
    // {
    //     return view("public.register");
    // }

    // public function register(Request $request)
    // {
    //     // to actually sign up
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|string|email|max:255|unique:users',
    //         'contact' => 'required|string|max:255|unique:users',
    //         'gender' => 'required|in:male,female,other',
    //         'education_qualification' => 'required|string|max:255',
    //         'dob' => 'required|date',
    //         'password' => 'required|string|min:8',
    //     ]);

    //     if ($validator->fails()) {
    //         return back()->withErrors($validator)->withInput();
    //     }

    //     $user = User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'contact' => $request->contact,
    //         'gender' => $request->gender,
    //         'education_qualification' => $request->education_qualification,
    //         'dob' => $request->dob,
    //         'password' => Hash::make($request->password),
    //     ]);


    //     return redirect()->route('public.success');
    // }

    // to visit the signup page (testing)

    // public function success()
    // {
    //     return view("public.success");
    // }

    // to view a course details
    public function courseDetails($id)
    {
        $course = Course::find($id); // replace 1 with course id
        return view("public.course", compact('course'));
    }

    // public function showLoginForm()
    // {
    //     return view('auth.login');
    // }

    // public function  login(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required',
    //     ]);

    //     $credentials = $request->only('email', 'password');

    //     // Attempt to log in the user
    //     if (Auth::attempt($credentials)) {
    //         // Check if the user is an admin
    //         if (Auth::user()->isAdmin) {
    //             return redirect()->route('admin.dashboard');
    //         } else {
    //             return redirect()->route('student.dashboard');
    //         }
    //     }

    //     return back()->withErrors(['email' => 'The provided credentials do not match our records.']);
    // }

    // public function logout()
    // {
    //     Auth::logout();
    //     return redirect('/login');
    // }


    public function servicePage(){
        return view("public.services");
    }

    public function training(){
        $courses = Course::where("published", true)->get();
        return view("public.training")->with('courses', $courses);
    }
    public function aboutPage(){
        return view("public.about-us");
    }

    public function contactUsPage(){
        return view("public.contact-us");
    }
    public function webDesignPage(){
        return view("public.web-design");
    }


    public function storeEnquiry(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'mobile' => 'required|digits:10|regex:/^[0-9]{10}$/',
        ]);

        $data = new Enquiry();
        $data->name = $request->name;
        $data->mobile = $request->mobile;
        $data->message = $request->message;
        $data->email = $request->email;
        $data->save();

        return redirect('/')->with('success', 'Request added successfully.');
    }

    
    public function ecommercePage(){
        return view("public.ecommerce");
    }
    public function coachingPage(){
        return view("public.coaching");
    }
    
    public function hireUs(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'contact' => 'required|digits:10|unique:hire_us,contact',
        ]);

        HireUs::create($data);

        return redirect()->route('public.index')->with('success', 'Successfully added.');
    }
    
}
