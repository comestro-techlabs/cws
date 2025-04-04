<?php

namespace App\Livewire\Public\Viewallcourses;

use App\Models\PostCourse;
use Livewire\Component;

class FreeCourses extends Component
{
    public $courses;
    public $search='';
    public function mount(){
        $this->courses = PostCourse::all();
    }
    public function updatedSearch()
    {
        $this->filterCourses(); 
    }
    public function filterCourses()
    {
        $query = PostCourse::query();

        if (!empty($this->search)) {
            $query->where('title', 'like', '%' . $this->search . '%');
        }

        $this->courses = $query->get();
    }

    public function render()
    {
        return view('livewire.public.viewallcourses.free-courses');
    }
}
