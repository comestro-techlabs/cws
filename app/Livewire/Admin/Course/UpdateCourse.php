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
#[Title('Manage Students')]
class UpdateCourse extends Component{
    use WithFileUploads;

    public Course $course;
    public $title, $course_code, $description, $duration, $instructor, $fees, $discounted_fees, $category_id, $tempImage;
    public $categories=[];
    public $isPublished = false;

    protected $rules = [
        'title' => 'required',
        'description' => 'required',
        'duration' => 'required|numeric|min:0',
        'instructor' => 'required',
        'fees' => 'required|numeric|min:0',
        'discounted_fees' => 'required|numeric|min:0',
        'category_id' => 'required|exists:categories,id',
        'tempImage' => 'nullable|image|max:2048'
    ];

    public function mount($courseId)
    {
        $this->course = Course::findOrFail((int) $courseId);
        $this->fill($this->course->toArray());
        $this->isPublished = $this->course->published ?? false;
        $this->categories = Category::all();
    }

    public function saveField($field)
    {
        $this->validateOnly($field);

        if ($field === 'tempImage' && $this->tempImage) {
            if ($this->course->course_image) {
                Storage::disk('public')->delete($this->course->course_image);
            }
            $filePath = $this->tempImage->store('course_images', 'public');
            $this->course->update(['course_image' => $filePath]);
        } else {
            $this->course->update([$field => $this->$field]);
        }
        $this->checkAndPublish();
        session()->flash('message', ucfirst($field) . ' updated successfully.');
     
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
    }

    public function render()
    {
        return view('livewire.admin.course.update-course');
    }
}



