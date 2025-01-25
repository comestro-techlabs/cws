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
        $data['courses'] = Course::where("published", true)->latest()->take(6)->get();
        $data['placedStudents'] = PlacedStudent::where('status', 1)->inRandomOrder()->take(4)->get();
        return view("public.homepage", $data);
    }

    //----------------------------- tested- -------------------------------------------
    public function courseDetails($category_slug, $slug)
    {
        $course = Course::where('slug', $slug)->first(); // replace 1 with course id
        $course_id = $course->id;

        $payment_exist = Payment::where("student_id", Auth::id())->where("course_id", $course_id)->where("status", "captured")->exists();
        return view("public.course", compact('course', "payment_exist"));
    }

    public function training()
    {
        $courses = Course::where("published", true)->get();
        return view("public.training")->with('courses', $courses);
    }
    public function aboutPage()
    {
        return view("public.about-us");
    }

    public function contactUsPage()
    {
        return view("public.contact-us");
    }

    public function privacyAndPolicy()
    {
        return view('public.privacy-policy');
    }


    public function termsAndConditions()
    {
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
