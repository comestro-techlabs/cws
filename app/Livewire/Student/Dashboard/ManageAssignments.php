<?php

namespace App\Livewire\Student\Dashboard;

use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ManageAssignments extends Component
{
    public $studentBatches;
    public $courses = []; // Store courses here so render() stays clean

    public $hasAccess = false; // Add property to track access status
    public $accessStatus = [];
    public $showAccessModal = false;

    public function mount()
    {
        $user = Auth::user();
        if (!Auth::check()) {
            redirect()->route('auth.login')->with('error', 'You must be logged in to access this page')->send();
            exit;
        }

        $studentId = Auth::id();

        // Check access status
        $this->hasAccess = $user->hasAccess();
        if (!$this->hasAccess) {
            $this->showAccessModal = true;
        }
        // dd($this->hasAccess);
        $this->accessStatus = $user->getAccessStatus();

        // Only load data if user has access

        $this->studentBatches = DB::table('course_student')
            ->where('user_id', $studentId)
            ->pluck('batch_id', 'course_id');

        $this->courses = Course::whereHas('users', function ($query) use ($studentId) {
            $query->where('user_id', $studentId);
        })
            ->with([
                'assignments' => function ($query) {
                    $query->where('status', 1)
                        ->whereIn('batch_id', $this->studentBatches);
                },
                'assignments.uploads' => function ($query) use ($studentId) {
                    $query->where('student_id', $studentId);
                }
            ])
            ->get();
    }

    #[Layout('components.layouts.student')]
    public function render()
    {
        return view('livewire.student.dashboard.manage-assignments', [
            'courses' => $this->courses,
            'hasAccess' => $this->hasAccess,
            'accessStatus' => $this->accessStatus
        ]);
    }
}
