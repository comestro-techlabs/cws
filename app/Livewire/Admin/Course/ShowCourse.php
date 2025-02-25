<?php

namespace App\Livewire\Admin\Course;

use Livewire\Component;
use App\Models\Course;

class ShowCourse extends Component
{
    public $course;

    public function mount($courseId)
    {
       $this->course = Course::findOrFail($courseId);
    }
    public function render()
    {
        return view('livewire.admin.course.show-course');
    }
}
