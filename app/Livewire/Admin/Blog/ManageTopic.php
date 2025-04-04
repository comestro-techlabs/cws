<?php

namespace App\Livewire\Admin\Blog;

use Livewire\Component;
use App\Models\PostChapter;
use App\Models\PostTopicPost;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.admin')]
#[Title('Manage Topics')]
class ManageTopic extends Component
{
    use WithPagination;

    public $chapter;
    public $topic_name;
    public $topic_description;
    public $order;
    public $topicId;
    public $isModalOpen = false;

    protected $rules = [
        'topic_name' => 'required|min:3',
        'topic_description' => 'nullable',
        'order' => 'nullable|integer'
    ];

    public function mount(PostChapter $chapter)
    {
        $this->chapter = $chapter;
    }

    public function openModal()
    {
        $this->resetValidation();
        $this->reset(['topic_name', 'topic_description', 'order', 'topicId']);
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    }

    public function store()
    {
        $this->validate();

        $topic = new PostTopicPost();
        $topic->topic_name = $this->topic_name;
        $topic->topic_description = $this->topic_description;
        $topic->order = $this->order ?? PostTopicPost::where('post_chapter_id', $this->chapter->id)->count() + 1;
        $topic->post_chapter_id = $this->chapter->id;
        $topic->save();

        $this->closeModal();
        session()->flash('message', 'Topic created successfully.');
    }

    public function edit($id)
    {
        $topic = PostTopicPost::findOrFail($id);
        $this->topicId = $id;
        $this->topic_name = $topic->topic_name;
        $this->topic_description = $topic->topic_description;
        $this->order = $topic->order;
        $this->isModalOpen = true;
    }

    public function update()
    {
        $this->validate();

        $topic = PostTopicPost::findOrFail($this->topicId);
        $topic->topic_name = $this->topic_name;
        $topic->topic_description = $this->topic_description;
        $topic->order = $this->order;
        $topic->save();

        $this->closeModal();
        session()->flash('message', 'Topic updated successfully.');
    } 

    public function delete($id)
    {
        PostTopicPost::findOrFail($id)->delete();
        session()->flash('message', 'Topic deleted successfully.');
    }

    public function render()
    {
        $topics = PostTopicPost::where('post_chapter_id', $this->chapter->id)
            ->orderBy('order')
            ->paginate(10);

        return view('livewire.admin.blog.manage-topic', [
            'topics' => $topics,
            'breadcrumbs' => [
                ['label' => 'Courses', 'url' => route('admin.blog.post-course')],
                ['label' => $this->chapter->course->title, 'url' => route('blog.chapters', $this->chapter->course->id)],
                ['label' => $this->chapter->chapter_name, 'url' => '#']
            ]
        ]);
    }
}
