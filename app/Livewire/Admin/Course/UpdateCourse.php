<?php

namespace App\Livewire\Admin\Course;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Course;
use App\Models\Category;
use App\Models\Feature;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;

#[Layout('components.layouts.admin')]
#[Title('Update Course')]
class UpdateCourse extends Component
{
    use WithFileUploads;

    public Course $course;
    
    #[Validate('required|string|max:255')]
    public $title;
    
    #[Validate('required|string')]
    public $description;
    
    #[Validate('required|numeric|min:0')]
    public $duration;
    
    #[Validate('required|string|max:255')]
    public $instructor;
    
    #[Validate('required|numeric|min:0')]
    public $fees;
    
    #[Validate('required|numeric|min:0')]
    public $discounted_fees;
    
    #[Validate('required|string|max:100')]
    public $course_code = '';
    
    #[Validate('required|exists:categories,id')]
    public $category_id;
    
    #[Validate('nullable|image|max:2048')]
    public $tempImage;
    
    // Feature-related properties
    public $allFeatures;
    #[Validate('array')]
    public $selectedFeatures = [];
    
    public $categories;
    public $isPublished = false;
    public $previewImage = null;

    public function mount($courseId)
    {
        $this->course = Course::with('features')->findOrFail((int) $courseId);
        $this->fill($this->course->only([
            'title',
            'description',
            'duration',
            'instructor',
            'fees',
            'discounted_fees',
            'course_code',
            'category_id'
        ]));
        $this->isPublished = (bool) $this->course->published;
        $this->categories = Category::all();
        $this->allFeatures = Feature::all();
        $this->selectedFeatures = $this->course->features->pluck('id')->toArray();
    }

    public function updatedTempImage()
    {
        // Validate the image
        $this->validate([
            'tempImage' => 'nullable|image|max:2048',
        ]);

        // Try generating a temporary preview URL
        try {
            $this->previewImage = $this->tempImage->temporaryUrl();
        } catch (\Exception $e) {
            $this->reset('previewImage');
            $this->addError('tempImage', 'Unable to generate preview.');
        }
    }

    public function saveField($field)
    {
        try {
            $this->validateOnly($field);

            if ($field === 'tempImage' && $this->tempImage) {
                $this->handleImageUpload();
            } elseif ($this->$field !== null) {
                $this->course->update([$field => $this->$field]);
                session()->flash('message', ucfirst($field) . ' updated successfully.');
                
                if ($field === 'description') {
                    $this->dispatch('descriptionSaved');
                }
            }

            $this->checkAndPublish();
        } catch (\Exception $e) {
            $this->addError($field, 'Failed to update ' . $field);
        }
    }

    public function updateFeatures()
    {
        try {
            $this->validateOnly('selectedFeatures');
            $this->course->features()->sync($this->selectedFeatures);
            session()->flash('message', 'Features updated successfully');
            $this->dispatch('features-updated');
        } catch (\Exception $e) {
            $this->addError('selectedFeatures', 'Failed to update features');
        }
    }

    private function handleImageUpload()
    {
        // Validate the image
        $this->validate([
            'tempImage' => 'nullable|image|max:2048',
        ]);

        // Delete old image if it exists
        if ($this->course->course_image) {
            Storage::disk('public')->delete($this->course->course_image);
        }

        // Define a unique filename with the course ID and timestamp
        $filename = 'course_' . $this->course->id . '_' . time() . '.' . $this->tempImage->getClientOriginalExtension();

        // Store the file using 'storeAs'
        $filePath = $this->tempImage->storeAs('course_images', $filename, 'public');

        // Update course record with new image path
        $this->course->update(['course_image' => $filePath]);

        // Reset temp data
        $this->reset('tempImage', 'previewImage');

        // Show success message
        session()->flash('message', 'Course image updated successfully.');
    }

    public function checkAndPublish()
    {
        $requiredFields = [
            'title',
            'description',
            'duration',
            'instructor',
            'fees',
            'discounted_fees',
            'category_id',
            'course_code',
            'course_image'
        ];

        $allFieldsFilled = collect($requiredFields)
            ->every(fn($field) => !empty($this->course->$field));

        if ($allFieldsFilled && !$this->isPublished) {
            $this->course->update(['published' => true]);
            $this->isPublished = true;
            session()->flash('message', 'Course published successfully.');
        }
    }

    public function togglePublish()
    {
        $this->isPublished = !$this->isPublished;
        $this->course->update(['published' => $this->isPublished]);
        
        session()->flash('message', 
            $this->isPublished 
                ? 'Course published successfully.' 
                : 'Course unpublished successfully.'
        );
    }

    public function deleteImage()
    {
        if ($this->course->course_image) {
            Storage::disk('public')->delete($this->course->course_image);
            $this->course->update(['course_image' => null]);
            session()->flash('message', 'Course image removed successfully.');
        }
    }

    public function render()
    {
        return view('livewire.admin.course.update-course');
    }
}
