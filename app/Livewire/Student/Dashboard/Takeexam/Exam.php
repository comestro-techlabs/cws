<?php

namespace App\Livewire\Student\Dashboard\Takeexam;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Exam extends Component
{
    public $courses;

    public function mount(){
        if (!Auth::check()) {
            return redirect()->route('auth.login')->with('error', 'You must be logged in to access this page');
        }

        $user = Auth::user();

        // Get the batch IDs for the courses the user is enrolled in
        $batchIds = DB::table('course_user')
            ->where('user_id', $user->id)
            ->pluck('batch_id', 'course_id'); // Fetch batch_id mapped by course_id

        // Fetch courses and filter exams based on the user's batch
        $this->courses = $user->courses()
            ->with([
                'users',
                'exams' => function ($query) use ($batchIds) {
                    $query->whereIn('batch_id', $batchIds); // Only show exams for the user's batch
                }
            ])
            ->get();
    }
    #[Layout('components.layouts.student')]
    public function render()
    {
        return view('livewire.student.dashboard.takeexam.exam');
    }
}
