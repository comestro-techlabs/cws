<?php

namespace App\Livewire\Public\Blog;

use App\Models\PostCourse;
use Livewire\Component;

class CourseWithChapterAndTopic extends Component
{
    public $course;
    public $chapters;

    public function mount($course_slug)
    {
        // dd($course_slug);
        // $this->course = PostCourse::with('chapters.topics')->findOrFail($course_slug);
        $this->course = PostCourse::where('course_slug', $course_slug)->with('chapters.topics')->first();
    //    dd($this->course);
        $this->chapters = $this->course->chapters;
        // dd($this->chapters);
    }

    public function render()
    {
        return view('livewire.public.blog.course-with-chapter-and-topic', [
            'course' => $this->course,
            'chapters' => $this->chapters,
        ]);
    }
}
