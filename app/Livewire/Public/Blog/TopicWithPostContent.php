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

    public function mount($course_id, $chapter_id = null, $topic_id = null)
    {
        $this->course = PostCourse::with('chapters.topics')->findOrFail($course_id);
        $this->chapters = $this->course->chapters;

        if ($topic_id) {
            $this->selectedTopic = PostTopicPost::findOrFail($topic_id);
            $this->posts = $this->selectedTopic->posts; 
        }
    }

    public function render()
    {
        return view('livewire.public.blog.topic-with-post-content');
    }
}
