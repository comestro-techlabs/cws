<?php

namespace App\Livewire\Admin\Blog;

use Livewire\Component;
use App\Models\PostChapter;
use App\Models\PostCourse;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithPagination;
#[Layout('components.layouts.admin')]
#[Title('Post Chapter')]
class ManageChapter extends Component
{
    use WithPagination;

    public $course;
    public $chapter_name;
    public $chapter_description;
    public $order;
    public $chapterId;
    public $isModalOpen = false;

    protected $rules = [
        'chapter_name' => 'required|min:3',
        'chapter_description' => 'nullable',
        'order' => 'nullable|integer'
    ];

    public function mount(PostCourse $course)
    {
        $this->course = $course;
    }

    public function openModal()
    {
        $this->resetValidation();
        $this->reset(['chapter_name', 'chapter_description', 'order', 'chapterId']);
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    }

    public function store()
    {
        $this->validate();

        $chapter = new PostChapter();
        $chapter->chapter_name = $this->chapter_name;
        $chapter->chapter_description = $this->chapter_description;
        $chapter->order = $this->order ?? PostChapter::where('post_course_id', $this->course->id)->count() + 1;
        $chapter->post_course_id = $this->course->id;
        $chapter->save();

        $this->closeModal();
        session()->flash('message', 'Chapter created successfully.');
    }

    public function edit($id)
    {
        $chapter = PostChapter::findOrFail($id);
        $this->chapterId = $id;
        $this->chapter_name = $chapter->chapter_name;
        $this->chapter_description = $chapter->chapter_description;
        $this->order = $chapter->order;
        $this->isModalOpen = true;
    }

    public function update()
    {
        $this->validate();

        $chapter = PostChapter::findOrFail($this->chapterId);
        $chapter->chapter_name = $this->chapter_name;
        $chapter->chapter_description = $this->chapter_description;
        $chapter->order = $this->order;
        $chapter->save();

        $this->closeModal();
        session()->flash('message', 'Chapter updated successfully.');
    }

    public function delete($id)
    {
        PostChapter::findOrFail($id)->delete();
        session()->flash('message', 'Chapter deleted successfully.');
    }

    public function render()
    {
        $chapters = PostChapter::where('post_course_id', $this->course->id)
            ->orderBy('order')
            ->paginate(10);
        return view('livewire.admin.blog.manage-chapter', compact('chapters'));
    }
}
