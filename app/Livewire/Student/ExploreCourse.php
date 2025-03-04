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
        $this->enrolledCourses = Auth::user()
            ->courses()
            ->pluck('courses.id')
            ->toArray();
    }

    public function enroll($courseId)
    {
        try {
            $user = auth()->user();
            
            if (!$user || !$user->is_active) {
                $this->showAlert('error', 'Account Issue', 'Your account is inactive. Please contact support.');
                return;
            }

            $coursesWithoutBatch = $user->courses()
                ->wherePivot('batch_id', null)
                ->exists();

            if ($coursesWithoutBatch) {
                $this->showAlert('error', 'Enrollment Error', 'Please update the batch for your existing course before enrolling in a new one.');
                return;
            }

            if ($user->courses()->where('course_id', $courseId)->exists()) {
                $this->showAlert('error', 'Enrollment Error', 'You are already enrolled in this course.');
                return;
            }

            if ($user->is_member) {
                $activeFreeCourse = $user->courses()
                    ->whereHas('batches', function ($query) {
                        $query->whereDate('end_date', '>=', now());
                    })
                    ->whereNotNull('pivot.batch_id')
                    ->exists();

                if ($activeFreeCourse) {
                    $this->showAlert('error', 'Enrollment Limit', 'You can only have one active free course at a time. Complete your current course or purchase this one.', 
                        route('student.viewCourses', ['courseId' => $courseId]));
                    return;
                }

                $batch = Batch::where('course_id', $courseId)
                    ->whereDate('end_date', '>=', now())
                    ->first();

                if (!$batch) {
                    $this->showAlert('error', 'Batch Error', 'No active batch available for this course.');
                    return;
                }

                $user->courses()->attach($courseId, ['batch_id' => $batch->id]);
                $this->enrolledCourses[] = $courseId;
                
                $this->showAlert('success', 'Success', 'You have successfully enrolled in the course.', 
                    route('v2.student.dashboard'));
            } else {
                $this->redirect(route('student.viewCourses', ['courseId' => $courseId]));
            }
        } catch (\Exception $e) {
            $this->showAlert('error', 'System Error', 'An error occurred: ' . $e->getMessage());
        }
    }

    private function showAlert($icon, $title, $text, $redirect = null)
    {
        $this->dispatch('alert', $icon, $title, $text, $redirect);
    }

    public function render()
    {
        $courses = Course::query()
            ->whereNotIn('id', $this->enrolledCourses)
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(8);

        return view('livewire.student.explore-course', [
            'courses' => $courses
        ]);
    }
}