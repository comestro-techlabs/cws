<?php

namespace App\Livewire\Admin\Assignment;

use App\Models\Assignments;
use App\Models\Batch;
use App\Models\Course;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
#[Layout('components.layouts.admin')]
#[Title('Manage Assignments')]
class ManageAssignment extends Component
{
    public $course_id = '';
    public $search = '';
    public $perPage = 10 ;
    protected $paginationTheme = 'tailwind';
    public function render()
    {
        $assignments = Assignments::when($this->course_id, fn ($query) => 
            $query->where('course_id', $this->course_id)
        )->when($this->search, fn ($query) => 
        $query->where('title', 'like', '%' . $this->search . '%')
    )->with(['course', 'batch'])->paginate($this->perPage);

        $courses = Course::all();
        $batchs = Batch::all(); 

        return view('livewire.admin.assignment.manage-assignment', [
            'assignments' => $assignments,
            'courses' => $courses,
            'batchs' => $batchs
        ]);
    }

    public function toggleStatus($assignmentId)
    {
        $assignment = Assignments::findOrFail($assignmentId);
        $assignment->update(['status' => !$assignment->status]);

        if ($assignment->status) {
            $this->notifyStudents($assignment);
        }

        session()->flash('success', 'Assignment status updated successfully!');
    }

    public function delete($assignmentId)
    {
        try {
            Assignments::destroy($assignmentId);
            session()->flash('success', 'Assignment deleted successfully!');
        }
        catch (\Exception $e) {
            session()->flash('error', 'Failed to delete assignment!');
        }
    }

    public function clearFilter()
    {
        $this->course_id = '';
        $this->search = '';
    }

    private function notifyStudents(Assignments $assignment)
    {
        $students = User::whereHas('courses', fn ($query) => 
            $query->where('course_id', $assignment->course_id)
        )->get();

        foreach ($students as $student) {
            try {
                Mail::send('emails.assignment_notification', 
                    ['user' => $student, 'assignment' => $assignment],
                    function ($message) use ($student) {
                        $message->to($student->email, $student->name)
                               ->subject('New Assignment Available');
                    }
                );
            } catch (\Exception $e) {
                \Log::warning("Failed to send notification to {$student->email}: {$e->getMessage()}");
            }
        }
    }
}