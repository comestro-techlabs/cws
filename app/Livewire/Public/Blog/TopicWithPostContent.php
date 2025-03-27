<?php

namespace App\Livewire\Public\Blog;

use App\Models\PostCourse;
use App\Models\PostTopicPost;
use App\Models\PostMyPost;
use Livewire\Component;

class TopicWithPostContent extends Component
{
    public $course;
    public $chapters;
    public $selectedTopic;
    public $posts = []; 

    public function mount($course_slug, $chapter_slug = null, $topic_slug = null)
    {
        //  dd($course_slug,$topic_slug);
        $this->course = PostCourse::where('course_slug', $course_slug)->with('chapters.topics')->first();
        // dd( $this->course);
        $this->chapters = $this->course->chapters;
        // dd($this->chapters);
        // dd($topic_slug);
        if ($topic_slug) {
            // dd($topic_slug);
            $this->selectedTopic = PostTopicPost::where('topic_slug', $topic_slug)->first();
            // dd('shaique');
            // dd($this->selectedTopic->posts);
            $this->posts = $this->selectedTopic->posts; 
        }
    }

    public function render()
    {
        return view('livewire.public.blog.topic-with-post-content');
    }
}
