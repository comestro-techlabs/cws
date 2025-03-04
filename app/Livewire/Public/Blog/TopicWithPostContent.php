<?php

namespace App\Livewire\Public\Blog;
use App\Models\PostCourse;
use App\Models\PostTopicPost;
use Livewire\Component;

class TopicWithPostContent extends Component
{
    public $course;
    public $chapters;
    public $selectedTopic;

    public function mount($course_id, $chapter_id = null, $topic_id = null)
    {
        $this->course = PostCourse::with('chapters.topics')->findOrFail($course_id);
        $this->chapters = $this->course->chapters;
        $this->selectedTopic = $topic_id ? PostTopicPost::findOrFail($topic_id) : null;
    }

    public function render()
    {
        return view('livewire.public.blog.topic-with-post-content', [
            'course' => $this->course,
            'chapters' => $this->chapters,
            'selectedTopic' => $this->selectedTopic,
        ]);
    }
}



