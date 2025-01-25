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

    public function courseDetails($category_slug, $slug)


    {
        $course = Course::where('slug',$slug)->first(); // replace 1 with course id
        $course_id = $course->id;

        $payment_exist = Payment::where("student_id",Auth::id())->where("course_id",$course_id)->where("status","captured")->exists();
        return view("public.course", compact('course', "payment_exist"));
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

    public function privacyAndPolicy(){
        return view('public.privacy-policy');
    }


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

        return redirect()->route('public.contact')->with('success', 'Request added successfully.');
    }



}
