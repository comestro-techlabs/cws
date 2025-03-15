<?php

namespace App\Livewire\Student;

use App\Models\CourseReview;
use Livewire\Attributes\On;
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
    public $progress = [];

    public $showModal = false;

    public $viewingCourse = false;
    public $selectedCourse = null;

    //review and rating
    public $course_id;
    public $review;
    public $rating;
    public $user_id;
    public $isRated = false;

    protected $rules = [
        'course_id' => 'required|exists:courses,id',
        'review' => 'required|string',
        'rating' => 'required|integer|min:1|max:5',
    ];


    public function mount()
    {
        $this->user_id = Auth::id();
        $this->loadCourses();
        $this->initializeBatchSelections();
        $this->calculateProgress();
        $this->courses = auth()->user()->courses;
        foreach ($this->courses as $course) {
            $this->selectedBatch[$course->id] = $course->pivot->batch_id;
        }
    }

    #[On('getting-course')]
    public function courseId($id)
    {
        $this->course_id = $id;
        $this->showModal = true;
        $ratedCourse = CourseReview::where('user_id', $this->user_id)->where('course_id', $this->course_id)->first();
        if ($ratedCourse) {
            $this->rating = $ratedCourse->rating;
            $this->review = $ratedCourse->review;
        }
    }

    public function offModel(){
        $this->isRated=false;
    }

    public function addReview(): void
    {

        $this->validate();
        CourseReview::updateOrCreate(
            [
                'user_id' => $this->user_id,
                'course_id' => $this->course_id
            ],
            [
                'review' => $this->review,
                'rating' => $this->rating,
            ]
        );


    
        $this->reset(['course_id', 'review', 'rating']);

        $this->showModal = false;
        $this->isRated=true;

        session()->flash('message', 'Review submitted successfully!');
    }
    public function rate($value)
    {
        $this->rating = $value;
    }

    public function viewCourse($courseId)
    {
        $this->selectedCourse = $this->courses->find($courseId);
        $this->viewingCourse = true;
    }

    public function closeView()
    {
        $this->viewingCourse = false;
        $this->selectedCourse = null;
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
            $this->course_id = $this->courses->id;
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

    private function calculateProgress()
    {
        foreach ($this->courses as $course) {
            $this->progress[$course->id] = $course->course_progress ?? 0;
        }
    }

    public function toggleEdit($courseId)
    {
        $this->editingCourseId = $this->editingCourseId === $courseId ? null : $courseId;
    }

    public function updateBatch($courseId)
    {
        $this->validate([
            "selectedBatch.$courseId" => 'required|exists:batches,id'
        ]);

        try {
            auth()->user()->courses()->updateExistingPivot($courseId, [
                'batch_id' => $this->selectedBatch[$courseId]
            ]);

            $this->editingCourseId = null;
            $this->dispatch('alert', [
                'type' => 'success',
                'message' => 'Batch updated successfully!'
            ]);
        } catch (\Exception $e) {
            $this->dispatch('alert', [
                'type' => 'error',
                'message' => 'Failed to update batch. Please try again.'
            ]);
        }
    }

    #[Layout('components.layouts.student')]
    public function render()
    {
        return view('livewire.student.my-course', [
            'progress' => $this->progress,
        ]);
    }
}
