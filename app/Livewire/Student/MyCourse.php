<?php

namespace App\Livewire\Student;

use App\Models\CourseReview;
use Illuminate\Support\Facades\DB;
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
    public $studentUpdatedBatch = [];



    public $showModal = false;

    public $viewingCourse = false;
    public $selectedCourse = null;

    //review and rating
    public $course_id;
    public $review;
    public $rating;
    public $user_id;
    public $isRated = false;

    public $hasAccess = false;
    public $showAccessModal = false;

    protected $rules = [
        'course_id' => 'required|exists:courses,id',
        'review' => 'required|string',
        'rating' => 'required|integer|min:1|max:5',
    ];


    public function mount()
    {
        $this->user_id = Auth::id();
        $this->hasAccess = auth()->user()->hasAccess();
        
        if (!$this->hasAccess) {
            $this->showAccessModal = true;
        }
        
        $this->loadCourses();
        $this->initializeBatchSelections();
        $this->calculateProgress();
        
        // Initialize batch update tracking
        foreach ($this->courses as $course) {
            $this->selectedBatch[$course->id] = $course->pivot->batch_id;
            
            // Check if student previously updated this batch
            $this->studentUpdatedBatch[$course->id] = (bool) $course->pivot->batch_updated;
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

    public function offModel()
    {
        $this->isRated = false;
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
        $this->isRated = true;

        session()->flash('message', 'Review submitted successfully!');
    }
    public function rate($value)
    {
        $this->rating = $value;
    }

    public function viewCourse($courseId)
    {
        if (!$this->hasAccess) {
            $this->showAccessModal = true;
            return;
        }
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
                ->with([
                    'batches' => function ($query) {
                        $query->orderBy('batch_name');
                    }
                ])
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
    $currentDate = now();
    
    foreach ($this->courses as $course) {
        $this->progress[$course->id] = 0;

        if (!$course->pivot || empty($course->pivot->batch_id)) {
            continue;
        }

        $batch = Batch::where('id', $course->pivot->batch_id)
            ->where('course_id', $course->id)
            ->first();

        if (!$batch || !$batch->start_date || !$batch->end_date) {
            continue;
        }

        $startDate = $batch->start_date;
        $endDate = $batch->end_date;

        if (!$startDate instanceof \DateTime || !$endDate instanceof \DateTime) {
            continue;
        }

        $totalDays = $startDate->diffInDays($endDate);

        if ($totalDays == 0) {
            continue;
        }

        $daysElapsed = $startDate->diffInDays($currentDate);

        if ($currentDate->greaterThan($endDate)) {
            $this->progress[$course->id] = 100;
        } elseif ($currentDate->lessThan($startDate)) {
            $this->progress[$course->id] = 0;
        } else {
            $progressPercentage = ($daysElapsed / $totalDays) * 100;
            $this->progress[$course->id] = min(100, max(0, round($progressPercentage)));
        }
    }
}
    public function toggleEdit($courseId)
    {
        $this->editingCourseId = $this->editingCourseId === $courseId ? null : $courseId;
    }

    public function updateBatch($courseId)
    {
        if (!$this->hasAccess) {
            $this->showAccessModal = true;
            return;
        }
    
        try {
            DB::beginTransaction();
    
            $enrollment = auth()->user()->courses()
                ->where('course_id', $courseId)
                ->firstOrFail();
    
            if (empty($this->selectedBatch[$courseId])) {
                throw new \Exception('Please select a batch');
            }
    
            $batch = Batch::where('id', $this->selectedBatch[$courseId])
                ->where('course_id', $courseId)
                ->firstOrFail();
    
            auth()->user()->courses()->updateExistingPivot($courseId, [
                'batch_id' => $batch->id,
                'batch_updated' => true
            ]);
    
            $this->studentUpdatedBatch[$courseId] = true;
            $this->editingCourseId = null;
            $this->viewingCourse = false;
            $this->selectedCourse = null;
    
            $this->loadCourses();
            $this->initializeBatchSelections();
    
            DB::commit();
    
            $this->dispatch('notify', [
                'type' => 'success',
                'message' => 'Batch selection updated successfully!',
                'timeout' => 3000
            ]);
    
        } catch (\Exception $e) {
            DB::rollBack();
            
            $this->dispatch('notify', [
                'type' => 'error',
                'message' => $e->getMessage(),
                'timeout' => 5000
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
