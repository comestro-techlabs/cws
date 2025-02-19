<?php

namespace App\Livewire\Public;

use App\Models\Course;
use App\Models\Payment;
use App\Models\PlacedStudent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Home extends Component
{
    //when course detail page will be there then will work on it
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

    #[Layout('components.layouts.app')]
    public function render()
    {  
        $courses = Course::where("published", true)->latest()->take(6)->get();
        $placedStudents = Cache::remember('placed_students_active', 60, function () {
            return PlacedStudent::where('status', 1)->get();
        });
        $title = "";
        return view('livewire.public.home',compact('courses','placedStudents','title'));
    }
}
