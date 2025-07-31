<?php

namespace App\Livewire\Admin\Course;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Course;
use App\Models\Category;
use App\Models\Feature;
use Illuminate\Support\Facades\Storage;
use ImageKit\ImageKit;
use App\Helpers\ImageKitHelper;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;


#[Layout('components.layouts.admin')]
#[Title('Update Course')]
class UpdateCourse extends Component
{
    use WithFileUploads;

    // Core Models
    public Course $course;

    // Course Basic Information
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

    // Image Management
    #[Validate('nullable|image|max:2048')]
    public $tempImage;
    public $previewImage = null;

    // Course Type & Meeting Details
    public $course_type;
    public $meeting_link;
    public $meeting_id;
    public $meeting_password;
    public $venue;

    // Features Management
    public $allFeatures;
    #[Validate('array')]
    public $selectedFeatures = [];
    public $showFeaturesModal = false;

    // UI State Management
    public $categories;
    public $isPublished = false;
    public $editingField = null;
    public $tempData = [];
    public $showCourseModal = false;
    public $activeTab = 'addBatch';
    
    // Legacy/Unused properties (consider removing)
    public $progress = 0;
    public $image;

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
        $this->validate([
            'tempImage' => 'nullable|image|max:2048',
        ]);

        if (!$this->tempImage) {
            return;
        }

        $result = $this->uploadImageToImageKit($this->tempImage);
        
        if ($result['success']) {
            $this->dispatch('notice', type: 'success', text: $result['message']);
        } else {
            $this->addError('tempImage', $result['message']);
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

    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
    }
    public function courseEdit()
    {
        $this->showCourseModal = true;
    }

    public function closeModal()
    {
        $this->showCourseModal = false;
        $this->editingField = null;
    }
    public function saveField($field)
    {
        try {
            $this->validateOnly($field);

            $updateData = [$field => $this->{$field}];

            // Handle course type specific logic
            if ($field === 'course_type') {
                if ($this->course_type === 'online') {
                    $updateData['venue'] = null;
                    $this->venue = null;
                } else {
                    $updateData = array_merge($updateData, [
                        'meeting_link' => null,
                        'meeting_id' => null,
                        'meeting_password' => null
                    ]);
                    $this->meeting_link = null;
                    $this->meeting_id = null;
                    $this->meeting_password = null;
                }
            }

            $this->course->update($updateData);

            $this->editingField = null;
            $this->tempData = [];

            $this->dispatch('notice', type: 'success', text: ucfirst(str_replace('_', ' ', $field)) . ' updated successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Re-throw validation exceptions to show field errors
            throw $e;
        } catch (\Exception $e) {
            $this->dispatch('notice', type: 'error', text: 'Failed to update: ' . $e->getMessage());
        }
    }

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

        // Use direct ImageKit URL for preview
        $this->previewImage = $this->course->course_image ?: null;
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
            $this->dispatch('notice', type: 'success', text: 'Features Updated Successfully!');
        } catch (\Exception $e) {
            $this->dispatch('notice', type: 'error', text: 'Failed to update features: ' . $e->getMessage());
        }
    }

    /**
     * Private method to handle image upload operations
     */
    private function uploadImageToImageKit($file, $resetTempImage = false)
    {
        try {
            // Delete old image from ImageKit if it exists
            if ($this->course->imagekit_file_id) {
                ImageKitHelper::deleteImage($this->course->imagekit_file_id);
            }

            // Use ImageKitHelper for upload
            $result = ImageKitHelper::uploadImage($file, '/cws/course_images');

            if ($result && isset($result['url'], $result['fileId'])) {
                // Update course with new image data
                $this->course->update([
                    'course_image' => $result['url'],
                    'imagekit_file_id' => $result['fileId']
                ]);

                // Update preview
                $this->previewImage = $result['url'];

                // Reset temp data if requested
                if ($resetTempImage) {
                    $this->reset('tempImage');
                }

                return ['success' => true, 'message' => 'Image uploaded successfully!'];
            } else {
                return ['success' => false, 'message' => 'ImageKit upload failed.'];
            }
        } catch (\Exception $e) {
            return ['success' => false, 'message' => 'Upload failed: ' . $e->getMessage()];
        }
    }

    public function handleImageUpload()
    {
        $this->validate([
            'tempImage' => 'nullable|image|max:2048',
        ]);

        if ($this->tempImage) {
            $result = $this->uploadImageToImageKit($this->tempImage, true);
            
            if ($result['success']) {
                $this->dispatch('notice', type: 'success', text: 'Course image updated successfully!');
            } else {
                $this->addError('tempImage', $result['message']);
            }
        }
    }

    public function checkAndPublish()
    {
        $requiredFields = [
            'title' => 'Title',
            'description' => 'Description',
            'duration' => 'Duration',
            'instructor' => 'Instructor',
            'fees' => 'Fees',
            'discounted_fees' => 'Discounted Fees',
            'category_id' => 'Category',
            'course_code' => 'Course Code',
            'course_image' => 'Course Image'
        ];

        $missingFields = collect($requiredFields)
            ->filter(fn($label, $field) => empty($this->course->$field))
            ->values();

        if ($missingFields->isNotEmpty()) {
            $this->dispatch('notice', type: 'warning', text: 'Please fill all required fields: ' . $missingFields->join(', '));
            return;
        }

        if (!$this->isPublished) {
            $this->course->update(['published' => true]);
            $this->isPublished = true;
            $this->dispatch('notice', type: 'success', text: 'Course published successfully!');
        } else {
            $this->dispatch('notice', type: 'info', text: 'Course is already published.');
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
        try {
            if ($this->course->imagekit_file_id) {
                // Delete from ImageKit
                ImageKitHelper::deleteImage($this->course->imagekit_file_id);
                
                // Update database
                $this->course->update([
                    'course_image' => null,
                    'imagekit_file_id' => null
                ]);
                
                $this->previewImage = null;
                $this->dispatch('notice', type: 'success', text: 'Course image removed successfully!');
            } elseif ($this->course->course_image) {
                // Fallback for old images stored locally
                Storage::disk('public')->delete($this->course->course_image);
                $this->course->update(['course_image' => null]);
                $this->previewImage = null;
                $this->dispatch('notice', type: 'success', text: 'Course image removed successfully!');
            } else {
                $this->dispatch('notice', type: 'info', text: 'No image to delete.');
            }
        } catch (\Exception $e) {
            $this->dispatch('notice', type: 'error', text: 'Failed to delete image: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.course.update-course');
    }
}
