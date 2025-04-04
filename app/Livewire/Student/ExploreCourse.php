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
        if (Auth::check());
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
