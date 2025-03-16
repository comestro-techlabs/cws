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
        'title' => 'required|min:3',
        'course_type' => 'required|in:online,offline',
        'category_id' => 'required|exists:categories,id',
        'fees' => 'required|numeric|min:0',
        'discounted_fees' => 'required|numeric|min:0',
        'duration' => 'required|numeric|min:1',
        'instructor' => 'required|string',
        'description' => 'required',
        'meeting_link' => 'required_if:course_type,online|nullable|url',
        'meeting_id' => 'nullable',
        'meeting_password' => 'nullable',
        'venue' => 'required_if:course_type,offline|nullable',
    ];

    public function mount()
    {
        $this->categories = Category::all(); // Load categories in mount
    }

    public function insertCourse(){
        $this->validate();

        $course = new Course();
        $course->title = $this->title;
        $course->slug = Str::slug($this->title);
        $course->course_type = $this->course_type;
        
        if ($this->course_type === 'online') {
            $course->meeting_link = $this->meeting_link;
            $course->meeting_id = $this->meeting_id;
            $course->meeting_password = $this->meeting_password;
            $course->venue = null;
        } else {
            $course->venue = $this->venue;
            $course->meeting_link = null;
            $course->meeting_id = null;
            $course->meeting_password = null;
        }

        $course->save();

        session()->flash('message', 'Course created successfully!');
        return redirect()->route('admin.course.manage');
    }
    public function render()
    {
        return view('livewire.admin.course.insert-course');
    }
}
