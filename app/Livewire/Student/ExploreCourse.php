<?php
namespace App\Livewire\Student;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Course;
use App\Models\Batch;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

    public function enroll($courseId)
    {
        $user = Auth::user();
        if (!$user->is_member) {
            return redirect()->route('student.viewCourse', ['courseId' => $courseId]);
        }

        try {
            $this->enrollCourse($courseId);
        } catch (\Exception $e) {
            $this->dispatch('show-alert', [
                'title' => 'Error!',
                'message' => 'Failed to enroll: ' . $e->getMessage(),
                'type' => 'error'
            ]);
        }
    }

    public function mount()
    {
        $this->enrolledCourses = Auth::user()
            ->courses()
            ->pluck('courses.id') 
            ->toArray();
    }

    public function enrollCourse($courseId)
    {
        $user = Auth::user();

        if (!$user->is_active) {
            $this->dispatch('show-alert', [
                'title' => 'Error!',
                'message' => 'Your account is inactive. Please contact support.',
                'type' => 'error'
            ]);
            return;
        }

        if ($user->courses()->wherePivot('batch_id', null)->exists()) {
            $this->dispatch('show-alert', [
                'title' => 'Error!',
                'message' => 'Please update the batch for your existing course before enrolling in a new one.',
                'type' => 'error'
            ]);
            return;
        }

        if ($user->courses()->where('course_id', $courseId)->exists()) {
            $this->dispatch('show-alert', [
                'title' => 'Error!',
                'message' => 'You are already enrolled in this course.',
                'type' => 'error'
            ]);
            return;
        }

        if ($user->is_member) {
            $activeFreeCourse = $user->courses()
                ->whereHas('batches', function ($query) {
                    $query->whereDate('end_date', '>=', now());
                })
                ->withPivot('batch_id')
                ->get()
                ->pluck('pivot.batch_id')
                ->filter()
                ->isNotEmpty();

            if ($activeFreeCourse) {
                $this->dispatch('show-alert', [
                    'title' => 'Error!',
                    'message' => 'You can only have one active free course at a time. Complete your current course or buy this one.',
                    'type' => 'error'
                ]);
                return redirect()->route('student.buyCourse', ['id' => $courseId]);
            }

            $batch = Batch::where('course_id', $courseId)
                ->whereDate('end_date', '>=', now())
                ->first();

            if (!$batch) {
                $this->dispatch('show-alert', [
                    'title' => 'Error!',
                    'message' => 'No active batch available for this course.',
                    'type' => 'error'
                ]);
                return;
            }

            $user->courses()->attach($courseId, ['batch_id' => $batch->id]);
            $this->enrolledCourses[] = $courseId; // Update enrolled courses locally
            $this->dispatch('show-alert', [
                'title' => 'Success!',
                'message' => 'You have successfully enrolled in the course.',
                'type' => 'success'
            ]);
            return redirect()->route('student.dashboard');
        }

        return redirect()->route('student.buyCourse', ['id' => $courseId]);
    }

    public function render()
    {
        $courses = Course::whereNotIn('id', $this->enrolledCourses)
            ->where('title', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate(8);

        return view('livewire.student.explore-course', compact('courses'));
    }
}