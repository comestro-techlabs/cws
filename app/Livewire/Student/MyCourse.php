<?php
namespace App\Livewire\Student;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\Batch;
use Livewire\Attributes\Layout;

class MyCourse extends Component
{
    public $courses;
    public $coursesWithoutBatch = [];

    public function mount()
    {
        $this->loadCourses();
    }

    private function loadCourses()
    {
        $this->courses = Auth::user()->courses()->with('batches')->get();
        $this->coursesWithoutBatch = $this->courses->filter(function ($course) {
            return !$course->pivot->batch_id;
        })->values();

        if ($this->coursesWithoutBatch->isNotEmpty()) {
            $courses = $this->coursesWithoutBatch->pluck('title')->toArray();
            \Log::info('Emitting alert with courses: ' . implode(', ', $courses));
            $this->dispatch('show-alert', [
                'icon' => 'warning',
                'title' => 'Reminder',
                'text' => 'The following courses do not have a batch selected: ' . implode(', ', $courses),
            ]);
        }
    }

    public function updateBatch($courseId, $batchId)
    {
        $user = Auth::user();
        $course = $this->courses->firstWhere('id', $courseId);

        // Check if the course has any batches
        if ($course->batches->isEmpty()) {
            $this->dispatch('show-alert', [
                'icon' => 'error',
                'title' => 'No Batches Available',
                'text' => 'You don’t have any batches available for this course.',
            ]);
            return;
        }

        // Check if batchId is empty or invalid
        if (empty($batchId) || !$course->batches->contains('id', $batchId)) {
            $this->dispatch('show-alert', [
                'icon' => 'error',
                'title' => 'Invalid Batch',
                'text' => 'Please select a valid batch.',
            ]);
            return;
        }

        // Update the batch
        $user->courses()->updateExistingPivot($courseId, ['batch_id' => $batchId]);
        $this->loadCourses();
        $this->dispatch('show-alert', [
            'icon' => 'success',
            'title' => 'Success',
            'text' => 'Batch updated successfully!',
        ]);
    }

    #[Layout('components.layouts.student')]
    public function render()
    {
        return view('livewire.student.my-course');
    }
}