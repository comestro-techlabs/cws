<?php
namespace App\Livewire\Student;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\Batch;
use Livewire\Attributes\Layout;

class MyCourse extends Component
{
    public $courses = [];
    public $coursesWithoutBatch;

    public function mount()
    {
        $this->loadCourses();

        if ($this->coursesWithoutBatch->isNotEmpty() && !$this->isUpdating()) {
            $courseTitles = $this->coursesWithoutBatch->pluck('title')->toArray();
            $this->dispatch('show-alert', [
                'title' => 'Reminder',
                'type' => 'warning',
                'coursesWithoutBatch' => $courseTitles
            ]);
        }
    }

    private function loadCourses()
    {
        $this->courses = Auth::user()
            ->courses()
            ->with('batches')
            ->get()
            ->map(function ($course) {
                return [
                    'id' => $course->id,
                    'title' => $course->title,
                    'description' => $course->description,
                    'instructor' => $course->instructor,
                    'discounted_fees' => $course->discounted_fees,
                    'course_image' => $course->course_image,
                    'batches' => $course->batches,
                    'pivot' => $course->pivot,
                ];
            });

        $this->coursesWithoutBatch = $this->courses->filter(function ($course) {
            return empty($course['pivot']['batch_id']);
        });
    }

    private function isUpdating()
    {
        return request()->headers->get('X-Livewire') === 'true';
    }

    public function updateBatch($courseId, $batchId)
    {
        try {
            $user = Auth::user();
            $user->courses()->updateExistingPivot($courseId, ['batch_id' => $batchId]);
            
            $this->loadCourses();
            $this->dispatch('show-alert', [
                'title' => 'Success!',
                'message' => 'Batch updated successfully!',
                'type' => 'success'
            ]);
        } catch (\Exception $e) {
            $this->dispatch('show-alert', [
                'title' => 'Error!',
                'message' => 'Failed to update batch: ' . $e->getMessage(),
                'type' => 'error'
            ]);
        }
    }

    #[Layout('components.layouts.student')]
    public function render()
    {
        return view('livewire.student.my-course', [
            'courses' => $this->courses,
            'coursesWithoutBatch' => $this->coursesWithoutBatch
        ]);
    }
}