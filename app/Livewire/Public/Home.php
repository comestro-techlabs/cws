<?php

namespace App\Livewire\Public;

use App\Models\Course;
use App\Models\Payment;
use App\Models\PlacedStudent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Home extends Component
{
    public $courses, $placedStudents, $title;


    public function mount()
    {

        $this->courses = Course::where("published", true)->latest()->take(6)->get();
        $this->placedStudents = Cache::remember('placed_students_active', 60, function () {
            return PlacedStudent::where('status', 1)->get();
        });
        $this->title = "";
    }
   

    public function courseDetails($slug)
    {
        $user = auth()->user();

        if (Auth::check()) {
            if (!$user->is_active) {
                return redirect()->back()->with('error', 'Your account is inactive. Please contact support.');
            }
        } 
        $this->redirect(route('v2.public.courseDetail', ['slug' => $slug]), navigate: true);
    }




    #[Layout('components.layouts.app')]
    public function render()
    {
        return view('livewire.public.home');
    }
}
