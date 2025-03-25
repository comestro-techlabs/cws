<?php

namespace App\Livewire\Public;

use App\Models\Course;
use App\Models\PlacedStudent;
use App\Models\PostCourse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Home extends Component
{
    public $courses, $placedStudents, $title;
    public $blogCourses;
    public function mount()
    {

        $this->title = "Homepage";
        $this->blogCourses = PostCourse::take(9)->get();
        $this->courses = Course::where("published", true)->latest()->take(6)->get();
        $this->placedStudents = Cache::remember('placed_students_active_homepage', 60, function () {
            return PlacedStudent::where('status', 1)
            ->inRandomOrder() // Fetch records in random order
            ->take(6) // Limit to 6 students
            ->get();
    });
        $this->title = "";
    }

    public function courseDetails($slug)
    {
        $user = auth()->user();

        if (Auth::check() && !$user->is_active) {
            return redirect()->back()->with('error', 'Your account is inactive. Please contact support.');
        }

        $this->redirect(route('public.courseDetail', ['slug' => $slug]), navigate: true);
    }

    #[Layout('components.layouts.app')]
    public function render()
    {
        return view('livewire.public.home', [
            'placedStudents' => $this->placedStudents,
            'courses' => $this->courses,
        ]);
    }
}
