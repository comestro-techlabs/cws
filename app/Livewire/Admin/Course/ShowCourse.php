<?php

namespace App\Livewire\Admin\Course;

use Livewire\Component;
use App\Models\Course;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.admin')]
class ShowCourse extends Component
{
    public $course;
    public $batches;

    public function mount($courseId)
    {
        $this->course = Course::with('batches')->findOrFail($courseId);
        $this->batches = $this->course->batches;
    }

    public function render()
    {
        return view('livewire.admin.course.show-course');
    }
}
