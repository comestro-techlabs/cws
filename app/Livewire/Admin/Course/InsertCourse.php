<?php

namespace App\Livewire\Admin\Course;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use App\Models\Course;
use App\Models\Category;
use Illuminate\Support\Str;

class InsertCourse extends Component
{
    #[Layout('components.layouts.admin')]
    #[Title('Insert Course')]

    public $title;
    public $course_type = ''; // Add this property with default empty value
    public $meeting_link;
    public $meeting_id;
    public $meeting_password;
    public $venue;
    public $category_id;
    public $fees;
    public $discounted_fees;
    public $duration;
    public $instructor;
    public $description;
    public $categories; // Add this property
 
    protected $rules = [
        'title' => 'required|min:3|max:255|unique:courses,title',
    ];

    public function mount()
    {
        $this->categories = Category::all(); // Load categories in mount
    } 

    public function createCourse()
    {
        $this->validate();

        $course = Course::create([
            'title' => $this->title,
            'slug' => Str::slug($this->title),
            'published' => false
        ]);

        return redirect()->route('admin.course.update', $course->id)
            ->with('message', 'Course created successfully. Please complete the remaining details.');
    }

    public function render()
    {
        return view('livewire.admin.course.insert-course');
    }
}
