<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;

class PublicControlller extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return view("public.homepage")->with('courses', $courses);
    }

    public function logIn() {}

    // to visit the sign up page
    public function apply()
    {
        return view("public.register");
    }

    // to actually sign up
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'contact' => 'required|unique:users,contact',
            'dob' => 'required|date',
            'gender' => 'required|in:male,female,other',
            'course' => 'required|in:php,nextjs,react,laravel',
            'password' => 'required|confirmed|min:8',
            'referral' => 'nullable|string|max:255',
            'education' => 'required|string|max:255',
            'course' => 'required|in:Php webDev,Nexts,React.Dev,Laravel',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'contact' => $validatedData['contact'],
            'dob' => $validatedData['dob'],
            'gender' => $validatedData['gender'],
            'course' => $validatedData['course'],
            'referral' => $validatedData['referral'],
            'education_qualification' => $validatedData['education'],
            'course' => $validatedData['course'],
            'password' => Hash::make($validatedData['password']),

        ]);

        return redirect()->route('public.index');
    }

    // to visit the signup page (testing)
    public function signup(){
        return view('public.signup');
    }

    public function viewCourse() {}
}
