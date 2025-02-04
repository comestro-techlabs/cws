<?php

namespace App\Http\Controllers;

use App\Models\Batch;
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
        $user = auth()->user();
        if (Auth::check()) {
            if(!$user->is_active){
                return redirect()->back()->with('error', 'Your account is inactive. Please contact support.');
            }
        }
        $course = Course::where('slug', $slug)->first(); // replace 1 with course id
        $course_id = $course->id;

        $payment_exist = Payment::where("student_id", Auth::id())->where("course_id", $course_id)->where("status", "captured")->exists();
        return view("public.course", compact('course', "payment_exist"));
    }

    public function training()
    {
        $courses = Course::where("published", true)
        ->whereHas('batches')
        ->get();
        return view("public.training")->with('courses', $courses);
    }

    public function enrollCourse($courseId)
    {
        $user = auth()->user();
        if (!$user->is_active) {
            return redirect()->back()->with('error', 'Your account is inactive. Please contact support.');
        }
        $course = Course::with('category')->where('id', $courseId)->first();

        $coursesWithoutBatch = $user->courses()->wherePivot('batch_id', null)->exists();

        if ($coursesWithoutBatch) {
            return redirect()->back()->with('error', 'Please update the batch for your existing course before enrolling in a new one.');
        }
        if ($user->courses()->where('course_id', $courseId)->exists()) {
            return redirect()->back()->with('error', 'You are already enrolled in this course.');
        }

        if ($user->is_member) {
            // Find active batches where the user is already enrolled
            $activeFreeCourse = $user->courses()
                ->whereHas('batches', function ($query) {
                    $query->whereDate('end_date', '>=', now());
                })
                ->withPivot('batch_id')
                ->get()
                ->pluck('pivot.batch_id')
                ->filter()
                ->isNotEmpty();

            if ($activeFreeCourse) {
                // Redirect the member to payment if they have an ongoing free course
                return redirect()->route('public.courseDetails', [
                    'category_slug' => optional($course->category)->cat_slug, // Use optional() to prevent errors
                    'slug' => $course->slug
                ])->with('error', 'You can only have one active free course at a time. Complete your current course before enrolling in another for free. You can buy this course now.');


                // return redirect()->route('public.courseDetails', ['id' => $courseId])
                //     ->with('error', 'You can only have one active free course at a time. Complete your current course before enrolling in another for free. You can buy this course now.');
            }

            // Find an active batch for the course the member wants to enroll in
            $batch = Batch::where('course_id', $courseId)
                          ->whereDate('end_date', '>=', now())
                          ->first();

            if (!$batch) {
                return redirect()->back()->with('error', 'No active batch available for this course.');
            }
            $user->courses()->attach($courseId);
        } else {
            return redirect()->route('public.courseDetails', [
                'category_slug' => optional($course->category)->cat_slug, // Use optional() to prevent errors
                'slug' => $course->slug
            ]);
        }

        return redirect()->route('public.index')->with('success', 'You have successfully enrolled in the course.');
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
