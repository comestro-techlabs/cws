<?php
namespace App\Livewire\Student;

use Livewire\Component;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;


class ViewCourse extends Component
{
    public $course;
    // public $payment_exist = false;

   

    public function mount($courseId)
    {
        $this->course = Course::with(['chapters', 'features'])->findOrFail($courseId);
        // $this->payment_exist = Payment::where('course_id', Auth::id())->where('course_id', $this->course->id)->exists();
    }

   
    
    public function render()
    {
        return view('livewire.student.view-course');
    }
}

