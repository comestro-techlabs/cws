<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Course;
use App\Models\User;
use App\Models\Enquiry;
use App\Models\Payment;
use App\Models\PlacedStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class PublicController extends Controller
{
    public function index()
    {
        $data['courses'] = Course::where("published", true)->latest()->take(6)->get();
        $data['placedStudents'] = Cache::remember('placed_students_active', 60, function () {
            return PlacedStudent::where('status', 1)->get();
        });
        $data['title'] = "";
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

        $payment_exist = Payment::where("student_id", Auth::id())
        ->where("course_id", $course_id)
        ->where("status", "captured")
        ->exists();

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

    if (!$course) {
        return redirect()->back()->with('error', 'Course not found.');
    }

    // Check if user has already enrolled in the course
    if ($user->courses()->where('course_id', $courseId)->exists()) {
        return redirect()->back()->with('error', 'You are already enrolled in this course.');
    }

    // Check if the course is free
    if ($course->discounted_fees == 0) {
        $alreadyEnrolled = DB::table('course_user')
            ->where('user_id', $user->id)
            ->where('course_id', $courseId)
            ->exists();

        if (!$alreadyEnrolled) {
            DB::table('course_user')->insert([
                'user_id'    => $user->id,
                'course_id'  => $courseId,
                'batch_id'   => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return redirect()->route('student.dashboard')->with('success', 'You have been enrolled in the course.');
    }

    // Check if the user has a successful payment for this course
    $paymentExists = Payment::where('student_id', $user->id)
        ->where('course_id', $courseId)
        ->where('status', 'captured') // Ensuring successful payment
        ->exists();

    if (!$paymentExists) {
        return redirect()->route('public.courseDetails', [
            'category_slug' => optional($course->category)->cat_slug, // Use optional() to prevent errors
            'slug' => $course->slug
        ])->with('error', 'Payment required to access this course.');
    }

    // Ensure the user is a member and can access one free course at a time
    if ($user->is_member) {
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
            return redirect()->route('public.courseDetails', [
                'category_slug' => optional($course->category)->cat_slug,
                'slug' => $course->slug
            ])->with('error', 'You can only have one active free course at a time. Complete your current course before enrolling in another for free.');
        }

        // Find an active batch for the course
        $batch = Batch::where('course_id', $courseId)
                      ->whereDate('end_date', '>=', now())
                      ->first();

        if (!$batch) {
            return redirect()->back()->with('error', 'No active batch available for this course.');
        }

        $user->courses()->attach($courseId, ['batch_id' => $batch->id]);
    } else {
        return redirect()->route('public.courseDetails', [
            'category_slug' => optional($course->category)->cat_slug,
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
            'g-recaptcha-response' => 'required',
        ]);

        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => config('services.recaptcha.secret_key'),
            'response' => $request->input('g-recaptcha-response'),
            'remoteip' => $request->ip(),
        ]);
    
        $responseData = $response->json();
    
        if (!$responseData['success']) {
            return back()->withErrors(['captcha' => 'reCAPTCHA verification failed.']);
        }

        $data = new Enquiry();
        $data->name = $request->name;
        $data->mobile = $request->mobile;
        $data->message = $request->message;
        $data->email = $request->email;
        $data->save();

        return redirect()->route('public.contact')->with('success', 'Request added successfully.');
    }
}
