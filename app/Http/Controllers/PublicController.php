<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicController extends Controller
{
    public function index()
    {
        $courses = Course::where("published", true)->get();;
        return view("public.homepage")->with('courses', $courses);
    }



    // to visit the sign up page
    public function apply()
    {
        return view("public.register");
    }

    public function register(Request $request)
    {
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

    public function success()
    {
        return view("public.success");
    }

    // to view a course details
    public function courseDetails($id)
    {
        $course = Course::find($id); // replace 1 with course id
        return view("public.course", compact('course'));
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        // Attempt to log in the user
        if (Auth::attempt($credentials)) {
            // Check if the user is an admin
            if (Auth::user()->isAdmin) {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('student.dashboard');
            }
        }

        return back()->withErrors(['email' => 'The provided credentials do not match our records.']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }


    public function servicePage(){
        return view("public.services");
    }

    public function aboutPage(){
        return view("public.about-us");
    }
}
