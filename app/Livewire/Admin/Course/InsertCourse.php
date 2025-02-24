<?php

namespace App\Livewire\Admin\Course;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use App\Models\Course;

class InsertCourse extends Component
{
    #[Layout('components.layouts.admin')]
    #[Title('Insert Course')]

    public $title;
    public $slug;
    protected $rules = [
        'title' => 'required|string|max:255',
    ];

    public function insertCourse(){
        $this->validate();
       $course = Course::create(['title' => $this->title]);
        $this->reset();
        return redirect()->route('admin.course.update', ['courseId' => $course->id]);
    }
    public function render()
    {
        return view('livewire.admin.course.insert-course');
    }
}
