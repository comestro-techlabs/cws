<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use App\Models\Enquiry;
use App\Models\Payment;
use App\Models\PlacedStudent;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicController extends Controller
{
    public function index()
    {
        $data['courses']=Course::where("published", true)->latest()->take(6)->get();
        $data['placedStudents'] = PlacedStudent::where('status', 1)->inRandomOrder()->take(4)->get();
        return view("public.homepage",$data);
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
    public function courseDetails($category_slug, $slug)
   
   
    {
        $course = Course::where('slug',$slug)->first(); // replace 1 with course id
        $course_id = $course->id;

        $payment_exist = Payment::where("student_id",Auth::id())->where("course_id",$course_id)->where("payment_status","captured")->exists();
        return view("public.course", compact('course', "payment_exist"));
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


    

    // following files resides inside the public folder:
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

    public function privacyAndPolicy(){
        return view('public.privacy-policy'); 
    }
    
    
    // public function hireUs(Request $request)
    // {
    //     $data=$request->validate([
    //         'name'=>'required|',
    //         'contact'=>'required|min:10|max:10',
    //     ]);
    //     HireUs::create($data);
     
    //     return redirect()->route('public.index')->with('success',"sucessfully added");
    // }

    public function seoServices(){
        return view('public.services.seo-services');
    }

    public function webDevPage(){
        return view('public.services.web-development');
    }

    public function mobileAppPage(){
        return view('public.services.mobile-app');
    }

    public function ecommercePage(){
        return view('public.services.ecommerce');
    }

    public function webDesignPage(){
        return view("public.services.web-design");
    }

    public function softwareDev(){
        return view('public.services.software-dev');
    }

    public function nativeApp(){
        return view('public.services.native-app');
    }

    public function inventorySolution(){
        return view('public.services.inventory-solution');
    }

    public function servicePage(){
        return view('public.services.services');
    }

    public function coachingPage(){
        return view('public.services.coaching');
    }

    public function termsAndConditions(){
        return view('public.terms-and-conditions');
    }



}
