<?php

namespace App\Livewire\Public\Course;

use App\Models\Course;
use App\Models\Payment;
use App\Models\PlacedStudent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Ourcourses extends Component
{   

    public $courses,$placedStudents,$title,$course,$course_id,$payment_exist;

    public function mount($slug){     
        $this->courses = Course::where("published", true)->latest()->take(6)->get();
        $this->course = Course::where('slug', $slug)->first(); // replace 1 with course id
        $this->course_id = $this->course->id;
        $this->payment_exist = Payment::where("student_id", Auth::id())
        ->where("course_id", $this->course_id)
        ->where("status", "captured")
        ->exists();  
        }

        
   
    public function render()
    {
        return view('livewire.public.course.ourcourses');
    }
}
