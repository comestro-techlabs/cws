<?php

namespace App\Livewire\Admin\Course;

use App\Models\Course;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.admin')]
class ShowBatch extends Component
{
    // Properties to manage course and filter states
    public $selectedCourse = null;   // Currently selected course
    public $search = '';            // Search query for filtering courses
    public $courseType = '';        // Filter by course type (online/offline)
    public $filterCourse = '';      // Filter by specific course

    // Handle course selection
    public function selectCourse($courseId)
    {
        $this->selectedCourse = $courseId;
    }

    // Reset selected course when search changes
    public function updatedSearch()
    {
        $this->selectedCourse = null;
    }

    // Reset selected course when course type changes
    public function updatedCourseType()
    {
        $this->selectedCourse = null;
    }

    // Reset selected course when course filter changes
    public function updatedFilterCourse()
    {
        $this->selectedCourse = null;
    }

    private function getActiveBatches($batches)
    {
        return $batches->filter(function($batch) {
            return $batch->end_date->isFuture();
        });
    }

    private function getInactiveBatches($batches)
    {
        return $batches->filter(function($batch) {
            return $batch->end_date->isPast();
        });
    }

   
    public function render()
    {
        // Get all courses for the filter dropdown
        $allCourses = Course::all();
        
        // Get filtered courses with batch counts
        $courses = Course::withCount('batches')
            ->when($this->search, function($query) {
                $query->where('title', 'like', '%' . $this->search . '%');
            })
            ->when($this->courseType, function($query) {
                $query->where('course_type', $this->courseType);
            })
            ->when($this->filterCourse, function($query) {
                $query->where('id', $this->filterCourse);
            })
            ->get();

        // Get detailed data for selected course including batches
        $selectedCourseData = null;
        if ($this->selectedCourse) {
            $selectedCourseData = Course::with(['batches' => function($query) {
                $query->orderBy('start_date', 'desc'); // Order batches by start date
            }])->find($this->selectedCourse);

            if ($selectedCourseData) {
                $selectedCourseData->active_batches = $this->getActiveBatches($selectedCourseData->batches);
                $selectedCourseData->inactive_batches = $this->getInactiveBatches($selectedCourseData->batches);
            }
        }

        return view('livewire.admin.course.show-batch', [
            'courses' => $courses,
            'allCourses' => $allCourses,
            'selectedCourseData' => $selectedCourseData
        ]);
    }
}
