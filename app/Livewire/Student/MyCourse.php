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
        $this->courses = Auth::user()->courses()->with('batches')->get();
        $this->coursesWithoutBatch = $this->courses->filter(function ($course) {
            return !$course->pivot->batch_id;
        });
    }

    public function updateBatch($courseId, $batchId)
    {
        $user = Auth::user();
        $user->courses()->updateExistingPivot($courseId, ['batch_id' => $batchId]);

        $this->mount(); 
        session()->flash('success', 'Batch updated successfully!');
    }
    #[Layout('components.layouts.student')]
    public function render()
    {
        return view('livewire.student.my-course');
    }
}
