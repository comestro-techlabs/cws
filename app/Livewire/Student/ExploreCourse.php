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

        if (!$user->is_active) {
            return redirect()->back()->with('error', 'Your account is inactive. Please contact support.');
        }

        $coursesWithoutBatch = $user->courses()->wherePivot('batch_id', null)->exists();
        if ($coursesWithoutBatch) {
            return redirect()->back()->with('error', 'Please update the batch for your existing course before enrolling in a new one.');
        }

        if ($user->courses()->where('course_id', $courseId)->exists()) {
            return redirect()->back()->with('error', 'You are already enrolled in this course.');
        }

        $batch = Batch::where('course_id', $courseId)
            ->whereDate('end_date', '>=', now())
            ->first();

        if (!$batch) {
            return redirect()->back()->with('error', 'No active batch available for this course.');
        }

        $activeCourseExists = $user->courses()
            ->whereHas('batches', function ($query) {
                $query->whereDate('end_date', '>=', now());
            })
            ->withPivot('batch_id')
            ->get()
            ->pluck('pivot.batch_id')
            ->filter()
            ->isNotEmpty();

        if ($user->hasActiveSubscription()) {
            if ($activeCourseExists) {
                return redirect()->route('student.viewCourses', ['courseId' => $courseId])
                    ->with('error', 'You can only enroll in one active course at a time with your subscription.');
            }

            $user->courses()->attach($courseId, ['batch_id' => $batch->id]);
        } else {
            return redirect()->route('student.viewCourses', ['courseId' => $courseId])
                ->with('error', 'You need an active subscription to enroll.');
        }

        return redirect()->route('student.dashboard')->with('success', 'You have successfully enrolled in the course.');
    }

    public function render()
    {
        $courses = Course::query()
            ->whereNotIn('id', $this->enrolledCourses)
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%');
            })
            ->with('batches')
            ->paginate(8);

        return view('livewire.student.explore-course', [
            'courses' => $courses
        ]);
    }
}
