<?php

namespace App\Livewire\Admin\Blog;

use App\Models\PostMyPost;
use Livewire\Component;
use App\Models\PostTopicPost;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
#[Title('Posts')]
class ManagePost extends Component
{
    use WithPagination;

    public $topic,$postId ,$post_name, $post_description, $isModalOpen = false;
    protected $rules = [
        'post_name' => 'required|min:3',
        'post_description' => 'nullable',
    ];

    public function mount(PostTopicPost $topic)
    {
        $this->topic = $topic;
        // dd($this->topic);
    }
    public function edit($id)
    {
        $post = PostMyPost::findOrFail($id);
        $this->postId = $id;
        $this->post_name = $post->title;
        $this->post_description = $post->content;
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    }
    public function openModal()
    {
        $this->resetValidation();
        $this->reset(['post_name', 'post_description', 'postId']);
        $this->isModalOpen = true;
    }
    public function store()
    {
        $this->validate();

        $post = new PostMyPost();
        $post->title = $this->post_name;
        $post->content = $this->post_description;
        $post->post_topic_post_id = $this->topic->id;
        $post->save();

        $this->closeModal();
        session()->flash('message', 'post created successfully.');
    }
    public function update()
    {
        $this->validate();

        $post = PostMyPost::findOrFail($this->postId);
        $post->title = $this->post_name;
        $post->content = $this->post_description;
        $post->save();

        $this->closeModal();
        session()->flash('message', 'Post updated successfully.');
    }

    public function delete($id)
    {
        PostMyPost::findOrFail($id)->delete();
        session()->flash('message', 'Post deleted successfully.');
    }

    public function render()
    {
        return view('livewire.admin.blog.manage-post', [
            'posts' => $this->topic->posts,
        ]);
    }
}
