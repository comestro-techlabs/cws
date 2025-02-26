<?php

namespace App\Livewire\Student;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;

class ExploreCourse extends Component
{

    use WithPagination;
     public $search ='';
     public $enrolledCourses = [];

    public function updatingSearch(){
        $this->resetPage();
    }

    public function enroll($courseId){
        if(Auth::check() && Auth::user()->is_member){
            session()->flash('success','you have successfully enrolled in the course!');
        }else{
            return redirect()->route('livewire.student.view-course',['id' =>$courseId]);
        }
    }
    

    #[Layout('components.layouts.student')]
    public function mount()
    {
        $userId = Auth::id();

       $this->enrolledCourses = DB::table('course_user')
            ->where('user_id', $userId)
            ->pluck('course_id');
           
    }
    public function render()
    {
       
        $courses = Course::whereNotIn('id', $this->enrolledCourses)
            ->where('title', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate(8);

        return view('livewire.student.explore-course',compact('courses'));
    }
}
