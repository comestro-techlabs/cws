<?php

namespace App\Livewire\Admin\Course;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Course;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.admin')]
#[Title('Update Course')]
class UpdateCourse extends Component
{
    use WithFileUploads;

    public Course $course;
    public string $title;
    public string $description;
    public int $duration;
    public string $instructor;
    public float $fees;
    public float $discounted_fees;
    public string $course_code;
    public int $category_id;
    public $tempImage;
    public $categories;
    public bool $isPublished = false;
    public $previewImage = null;

    protected $rules = [
        'title' => 'required',
        'description' => 'required',
        'duration' => 'required|numeric|min:0',
        'instructor' => 'required',
        'fees' => 'required|numeric|min:0',
        'discounted_fees' => 'required|numeric|min:0',
        'category_id' => 'required|exists:categories,id',
        'course_code' => 'required',
        'tempImage' => 'nullable|image|max:2048',
    ];

    public function mount($courseId)
    {
        $this->course = Course::findOrFail((int) $courseId);
        $this->fill($this->course->toArray());
        $this->isPublished = $this->course->published ?? false;
        $this->categories = Category::all();
    }

    public function updatedTempImage()
    {
        try {
            $this->validateOnly('tempImage');
            $this->previewImage = $this->tempImage->temporaryUrl();
        } catch (\Exception $e) {
            $this->previewImage = null;
        }
    }

    public function saveField($field)
    {
        $this->validateOnly($field);

        if ($field === 'tempImage') {
            if ($this->tempImage) {
                if ($this->course->course_image) {
                    Storage::disk('public')->delete($this->course->course_image);
                }
                $filePath = $this->tempImage->store('course_images', 'public');
                $this->course->update(['course_image' => $filePath]);
                $this->previewImage = null; // Reset preview
                session()->flash('message', 'Course image updated successfully.');
            }
        } else {
            $this->course->update([$field => $this->$field]);
            session()->flash('message', ucfirst($field) . ' updated successfully.');
            
            if ($field === 'description') {
                $this->dispatch('descriptionSaved');
            }
        }
        
        $this->checkAndPublish();
    }

    public function checkAndPublish()
    {
        if (
            $this->course->title &&
            $this->course->description &&
            $this->course->duration &&
            $this->course->instructor &&
            $this->course->fees &&
            $this->course->discounted_fees &&
            $this->course->category_id &&
            $this->course->course_code &&
            $this->course->course_image
        ) {
            $this->course->update(['published' => true]);
            $this->isPublished = true;
        }
    }

    public function togglePublish()
    {
        $this->course->update(['published' => !$this->course->published]);
        $this->isPublished = !$this->isPublished;
        
        if ($this->isPublished) {
            session()->flash('message', 'Course published successfully.');
        } else {
            session()->flash('message', 'Course unpublished successfully.');
        }
    }

    public function render()
    {
        return view('livewire.admin.course.update-course');
    }
}
