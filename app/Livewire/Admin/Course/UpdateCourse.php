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
    public $showFeaturesModal = false;
    public $categories;
    public $isPublished = false;
    public $previewImage = null;

    public $editing = false;
    public $editingField = null;
    public $tempData = [];

    // Add new property for progress
    public $progress = 0;

    // New properties for course type
    public $course_type;
    public $meeting_link;
    public $meeting_id;
    public $meeting_password;
    public $venue;

    protected $rules = [
        'title' => 'nullable|min:3|max:255',
        'description' => 'nullable',
        'duration' => 'nullable|numeric|min:0',
        'instructor' => 'nullable|string',
        'fees' => 'nullable|numeric|min:0',
        'discounted_fees' => 'nullable|numeric|min:0',
        'category_id' => 'nullable|exists:categories,id',
        'course_code' => 'nullable|string',
        'course_type' => 'nullable|in:online,offline',
        'meeting_link' => 'nullable|url',
        'meeting_id' => 'nullable|string',
        'meeting_password' => 'nullable|string',
        'venue' => 'nullable|string',
    ];

    public function updatedTempImage()
    {
        // Validate the image
        $this->validate([
            'tempImage' => 'nullable|image|max:2048',
        ]);

        if ($this->tempImage) {
            try {
                // Reset progress at start
                $this->progress = 0;

                // Simulate upload progress (since local uploads are usually too fast)
                $this->js("
                    let progress = 0;
                    const interval = setInterval(() => {
                        progress += 10;
                        if (progress <= 90) {
                            $wire.set('progress', progress);
                        } else {
                            clearInterval(interval);
                        }
                    }, 200);
                ");

                // Store image temporarily (not yet saved to the course)
                $imagePath = $this->tempImage->store('course_images', 'public');

                // Set progress to 100% when complete
                $this->progress = 100;
                $this->previewImage = asset('storage/' . $imagePath);

                // Reset progress after a delay
                $this->js("
                    setTimeout(() => {
                        $wire.set('progress', 0);
                    }, 1000);
                ");
            } catch (\Exception $e) {
                $this->addError('tempImage', 'Error uploading preview image.');
                $this->progress = 0;
            }
        }
    }

    public function editField($field)
    {
        $this->editingField = $field;
        $this->tempData[$field] = $this->{$field};
    }

    public function cancelEdit()
    {
        if ($this->editingField && isset($this->tempData[$this->editingField])) {
            $this->{$this->editingField} = $this->tempData[$this->editingField];
        }
        $this->editingField = null;
        $this->tempData = [];
    }

    public function saveField($field)
    {
        try {
            // First click - enter edit mode
            if ($this->editingField === null) {
                $this->editingField = $field;
                $this->tempData[$field] = $this->{$field};
                return;
            }

            // Second click - save changes
            if ($this->editingField === $field) {
                // Validate and save
                $this->validateOnly($field);
                
                $updateData = [$field => $this->{$field}];

                // Special handling for course type
                if ($field === 'course_type') {
                    if ($this->course_type === 'online') {
                        $updateData['venue'] = null;
                    } else {
                        $updateData['meeting_link'] = null;
                        $updateData['meeting_id'] = null;
                        $updateData['meeting_password'] = null;
                    }
                }

                // Update the course
                $success = $this->course->update($updateData);

                if (!$success) {
                    throw new \Exception('Failed to update the course.');
                }

                // Reset states
                $this->editingField = null;
                $this->tempData = [];
                
                $this->dispatch('notice', type: 'success', text: 'Field updated successfully!');
            }

        } catch (\Exception $e) {
            $this->dispatch('notice', type: 'error', text: 'Failed to update: ' . $e->getMessage());
        }
    }

    // Ensure preview image is loaded when page refreshes

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
            'category_id',
            'course_type',
            'meeting_link',
            'meeting_id',
            'meeting_password',
            'venue'
        ]));
        $this->isPublished = (bool) $this->course->published;
        $this->categories = Category::all();
        $this->allFeatures = Feature::all();
        $this->selectedFeatures = $this->course->features->pluck('id')->toArray();

        $this->previewImage = $this->course->course_image
        ? asset('storage/' . $this->course->course_image)
        : null;

    }

    public function openFeaturesModal()
    {
        $this->showFeaturesModal = true;
    }

    public function closeFeaturesModal()
    {
        $this->showFeaturesModal = false;
    }
    public function updateFeatures()
    {
        try {
            $this->validateOnly('selectedFeatures');
            $this->course->features()->sync($this->selectedFeatures);
            $this->closeFeaturesModal();
            $this->dispatch('notice', type: 'info', text: 'Features Updated Successfully!');

        } catch (\Exception $e) {
            $this->dispatch('notice', type: 'info', text: 'Failed to update features!');
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
        $this->dispatch('notice', type: 'info', text: 'Course image updated successfully!');

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
            $this->dispatch('notice', type: 'info', text: 'Course published successfully!');
        }
    }

    public function togglePublish()
    {
        $this->isPublished = !$this->isPublished;
        $this->course->update(['published' => $this->isPublished]);
        $this->dispatch('notice', type: 'info', text: $this->isPublished
        ? 'Course published successfully.'
        : 'Course unpublished successfully.');
    }

    public function deleteImage()
    {
        if ($this->course->course_image) {
            Storage::disk('public')->delete($this->course->course_image);
            $this->course->update(['course_image' => null]);
            $this->dispatch('notice', type: 'info', text: 'Course image removed successfully!');

        }
    }

    public function render()
    {
        return view('livewire.admin.course.update-course');
    }
}
