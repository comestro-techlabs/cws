<?php
namespace App\Livewire\Student;

use App\Models\Payment;
use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ViewCourse extends Component
{
    public $course;
    public $payment_exist = false;

    #[Layout('components.layouts.student')]
    public function mount($courseId)
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('auth.login')->with('error', 'You must be logged in to access this page');
        }

        // Assign to public property instead of local variable
        $this->course = Course::with('features')->findOrFail($courseId);
        $course_id = $this->course->id;
        $user_id = Auth::id();

        // Check if payment exists with status "captured"
        $this->payment_exist = Payment::where("student_id", $user_id)
            ->where("course_id", $course_id)
            ->where("status", "captured")
            ->exists();

        if ($this->course->discounted_fees == 0) {
            $already_enrolled = DB::table('course_user')
                ->where('user_id', $user_id)
                ->where('course_id', $course_id)
                ->exists();

            if (!$already_enrolled) {
                try {
                    DB::table('course_user')->insert([
                        'user_id'    => $user_id,
                        'course_id'  => $course_id,
                        'batch_id'   => null,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    $this->payment_exist = true;
                } catch (\Exception $e) {
                    session()->flash('error', 'Failed to enroll in free course');
                }
            }
        }
    }

    public function render()
    {
        return view('livewire.student.view-course');
    }
}
