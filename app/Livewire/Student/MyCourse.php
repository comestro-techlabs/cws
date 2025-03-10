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
    public $selectedBatch = [];
    public $editingCourseId = null;

    public function mount()
    {
        $this->loadCourses();
        $this->initializeBatchSelections();
    }

    private function loadCourses()
    {
        try {
            $this->courses = Auth::user()->courses()
                ->with(['batches' => function ($query) {
                    $query->orderBy('batch_name');
                }])
                ->get();

            $this->coursesWithoutBatch = $this->courses->filter(function ($course) {
                return !$course->pivot || empty($course->pivot->batch_id);
            })->values();

            if ($this->coursesWithoutBatch->isNotEmpty()) {
                $courseTitles = $this->coursesWithoutBatch->pluck('title')->implode(', ');
                $this->dispatch('show-alert', [
                    'icon' => 'warning',
                    'title' => 'Reminder',
                    'text' => "The following courses need a batch selection: {$courseTitles}",
                ]);
            }
        } catch (\Exception $e) {
            $this->dispatch('show-alert', [
                'icon' => 'error',
                'title' => 'Error Loading Courses',
                'text' => 'Unable to load your courses. Please try again later.',
            ]);
            $this->courses = collect();
            $this->coursesWithoutBatch = collect();
        }
    }

    private function initializeBatchSelections()
    {
        foreach ($this->courses as $course) {
            $this->selectedBatch[$course->id] = $course->pivot ? ($course->pivot->batch_id ?? '') : '';
        }
        $this->editingCourseId = null;
    }

    public function toggleEdit($courseId)
{
    \Log::info("Toggling edit for courseId: {$courseId}, current editingCourseId: {$this->editingCourseId}");
    $this->editingCourseId = $this->editingCourseId === $courseId ? null : $courseId;
    \Log::info("New editingCourseId: " . ($this->editingCourseId ?? 'null'));
    $this->dispatch('refresh'); // Force a re-render
}

    public function updateBatch($courseId, $batchId)
    {
        try {
            $user = Auth::user();
            $course = $this->courses->firstWhere('id', $courseId);

            if (!$course) {
                $this->dispatch("show-alert-{$courseId}", [
                    'icon' => 'error',
                    'title' => 'Course Not Found',
                    'text' => 'The selected course could not be found.',
                ]);
                return;
            }

            if ($course->batches->isEmpty()) {
                $this->dispatch("show-alert-{$courseId}", [
                    'icon' => 'warning',
                    'title' => 'No Batches Available',
                    'text' => "No batches are available for {$course->title}.",
                ]);
                return;
            }

            if ($batchId && !$course->batches->contains('id', $batchId)) {
                $this->dispatch("show-alert-{$courseId}", [
                    'icon' => 'error',
                    'title' => 'Invalid Batch',
                    'text' => 'Please select a valid batch from the available options.',
                ]);
                return;
            }

            $user->courses()->updateExistingPivot($courseId, ['batch_id' => $batchId ?: null]);
            $this->selectedBatch[$courseId] = $batchId;
            $this->editingCourseId = null;
            $this->loadCourses();

            $this->dispatch("show-alert-{$courseId}", [
                'icon' => 'success',
                'title' => 'Batch Updated',
                'text' => "Batch for {$course->title} updated successfully!",
            ]);
        } catch (\Exception $e) {
            $this->dispatch("show-alert-{$courseId}", [
                'icon' => 'error',
                'title' => 'Update Failed',
                'text' => 'An error occurred while updating the batch: ' . $e->getMessage(),
            ]);
        }
    }

    #[Layout('components.layouts.student')]
    public function render()
    {
        return view('livewire.student.my-course');
    }
}