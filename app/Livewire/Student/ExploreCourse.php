<?php
namespace App\Livewire\Student;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Course;
use App\Models\Batch;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.student')]
class ExploreCourse extends Component
{
    use WithPagination;

    public $search = '';
    public $courseTypeFilter = ''; // Added course type filter
    public $enrolledCourses = [];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function mount()
    {
        if (Auth::check()) {
            $this->enrolledCourses = Auth::user()
                ->courses()
                ->pluck('courses.id')
                ->toArray();
        }
    }
    public function enrollCourse($courseId)
    {
        $user = auth()->user();
    
        // Check if the user's account is active.
        if (!$user->is_active) {
            return redirect()->back()->with('error', 'Your account is inactive. Please contact support.');
        }
    
        // Check if the user is already enrolled in this specific course.
        if ($user->courses()->where('course_id', $courseId)->exists()) {
            return redirect()->back()->with('error', 'You are already enrolled in this course.');
        }
    
        // Check if the user has an active subscription.
        $hasSubscription = $user->hasActiveSubscription();
    
        $subscriptionCourseCount = $user->courses()
            ->whereHas('batches', function ($query) {
                $query->whereDate('end_date', '>=', now());
            })
            ->wherePivot('is_subs', 1) 
            ->count();
    
        if (!$hasSubscription) {
            return redirect()->route('student.viewCourses', ['courseId' => $courseId])
                ->with('warning', 'You need to purchase this course to enroll.');
        }
    
        if ($hasSubscription && $subscriptionCourseCount >= 1) {
            return redirect()->route('student.viewCourses', ['courseId' => $courseId])
                ->with('warning', 'You have already enrolled in one course with your subscription. Please purchase this course to enroll.');
        }
    
        $batch = Batch::where('course_id', $courseId)
            ->whereDate('end_date', '>=', now())
            ->first();
    
        if (!$batch) {
            return redirect()->back()->with('error', 'No active batch available for this course.');
        }
    
        $user->courses()->attach($courseId, [
            'batch_id' => $batch->id,
            'is_subs' => 1, 
        ]);
    
        $this->enrolledCourses[] = $courseId;
    
        return redirect()->route('student.dashboard')->with('success', 'You have successfully enrolled in the course.');
    }
    public function render()
    {
        $courses = Course::query()
            ->whereNotIn('id', $this->enrolledCourses)
            ->where('published', true)
            ->when($this->search, function ($query) {
                $query->where(function($q) {
                    $q->where('title', 'like', '%' . $this->search . '%')
                      ->orWhere('instructor', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->courseTypeFilter, function($query) {
                $query->where('course_type', $this->courseTypeFilter);
            })
            ->with(['batches' => function($query) {
                $query->whereDate('end_date', '>=', now())
                      ->select('id', 'course_id', 'batch_name', 'start_date', 'end_date');
            }])
            ->paginate(8);

        return view('livewire.student.explore-course', [
            'courses' => $courses,
            'courseTypes' => [
                'online' => 'Online Courses',
                'offline' => 'Offline Courses'
            ]
        ]);
    }
}
