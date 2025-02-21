<?php

namespace App\Livewire\Public\Viewallcourses;

use App\Models\Course;
use Livewire\Component;

class AllCourses extends Component
{

    public $published_courses;

    public function mount(){
        $this->published_courses = Course::where("published", true)
        ->whereHas('batches')
        ->get();
    }
    public function render()
    {
        return view('livewire.public.viewallcourses.all-courses');
    }
}
