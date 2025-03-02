<?php

namespace App\Livewire\Public\Blog;

use App\Models\PostCourse;
use Livewire\Component;

class CourseWithChapterAndTopic extends Component
{
    public $course;
    public $chapters;

    public function mount($course_id)
    {
        $this->course = PostCourse::with('chapters.topics')->findOrFail($course_id);
       
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
