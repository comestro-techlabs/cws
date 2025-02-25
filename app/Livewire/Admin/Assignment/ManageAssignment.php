<?php

namespace App\Livewire\Admin\Assignment;

use App\Models\Assignments;
use App\Models\Batch;
use App\Models\Course;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ManageAssignment extends Component
{
    public $course_id = '';

    #[Layout('components.layouts.admin')]
    public function render()
    {
        $assignments = Assignments::when($this->course_id, fn ($query) => 
            $query->where('course_id', $this->course_id)
        )->with(['course', 'batch'])->get();

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