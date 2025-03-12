<?php

namespace App\Livewire\Admin\Blog;

use Livewire\Component;
use App\Models\PostCourse As PostCourseModel;
use Livewire\WithFileUpload;
use Livewire\WithPagination;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Features\SupportFileUploads\WithFileUploads;

#[Layout('components.layouts.admin')]
#[Title('Post Course')]
class PostCourse extends Component
{
    use WithFileUploads, WithPagination;

    public $title;
    public $description;
    public $image;
    public $status = false;
    public $existingImage;
    public $courseId;
    public $isModalOpen = false;
    public $search = '';

    protected $rules = [
        'title' => 'required|min:3',
        'description' => 'nullable',
        'image' => 'nullable|image|max:1024', // max 1MB
        'status' => 'boolean'
    ];

    public function openModal()
    {
        $this->resetValidation();
        $this->reset(['title', 'description', 'image', 'status', 'courseId']);
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    }

    public function store()
    {
        $this->validate();

        $course = new PostCourseModel();
        $course->title = $this->title;
        $course->description = $this->description;
        $course->status = $this->status;
        $course->course_slug = Str::slug($this->title);

        if ($this->image) {
            $course->image = $this->image->store('courses', 'public');
        }

        $course->save();
        $this->closeModal();
        session()->flash('message', 'Course created successfully.');
    }

    public function edit($id)
    {
        $course = PostCourseModel::findOrFail($id);
        $this->courseId = $id;
        $this->title = $course->title;
        $this->description = $course->description;
        $this->status = $course->status;
        $this->existingImage = $course->image;
        $this->isModalOpen = true;
    }

    public function update()
    {
        $this->validate([
            'title' => 'required|min:3',
            'description' => 'nullable',
            'image' => 'nullable|image|max:1024',
        ]);

        $course = PostCourseModel::findOrFail($this->courseId);
        $course->title = $this->title;
        $course->description = $this->description;
        $course->status = $this->status;
        $course->course_slug = Str::slug($this->title);

        if ($this->image) {
            if ($course->image) {
                Storage::disk('public')->delete($course->image);
            }
            $course->image = $this->image->store('courses', 'public');
        }

        $course->save();
        $this->closeModal();
        session()->flash('message', 'Course updated successfully.');
    }

    public function delete($id)
    {
        $course = PostCourseModel::findOrFail($id);
        if ($course->image) {
            Storage::disk('public')->delete($course->image);
        }
        $course->delete();
        session()->flash('message', 'Course deleted successfully.');
    }

    public function toggleStatus($id)
    {
        $course = PostCourseModel::findOrFail($id);
        $course->status = !$course->status;
        $course->save();
    }
 
    public function render()
    {
        $courses = PostCourseModel::where('title', 'like', '%'.$this->search.'%')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('livewire.admin.blog.post-course', compact('courses'));
    }
}
