<?php

namespace App\Livewire\Public;

use App\Models\Course;
use App\Models\PlacedStudent;
use App\Models\PostCourse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Str;

class Home extends Component
{
    public $courses, $placedStudents, $title;
    public $blogCourses;
    public $shareMessage = '';

    public function mount()
    {
        $this->title = "Homepage";
        $this->blogCourses = PostCourse::take(9)->get();
        $this->courses = Course::where("published", true)->latest()->take(6)->get();
        $this->placedStudents = Cache::remember('placed_students_active_homepage', 60, function () {
            return PlacedStudent::where('status', 1)
                ->inRandomOrder()
                ->take(6)
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

    public function share($courseId)
{
    $course = Course::find($courseId);
    
    if ($course && $course->published) {
        $shareUrl = route('public.courseDetail', ['slug' => $course->slug]);            
        $imageUrl = asset('storage/course_images/' . $course->course_image);
        $title = $course->title ?? 'Untitled Course';
        $description = $course->description 
            ? Str::limit($course->description, 100) 
            : "{$course->duration} Weeks • " . ucfirst($course->course->course_type);
            
        $data = [
            'url' => $shareUrl,
            'title' => $title,
            'image' => $imageUrl, 
            'description' => $description,
        ];

        \Log::info('Dispatching shareCourse event', $data);

        $this->dispatch('shareCourse', $data);
        $this->shareMessage = "Link for '{$title}' ready to share!";
    } else {
        $this->shareMessage = 'Course not found or unpublished.';
    }
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