<?php

namespace App\Livewire\Student\MockTest;

use App\Models\MockTest;
use Livewire\Component;
use App\Models\Course;
use App\Models\MockTestResult;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.student')]
#[Title('Mock Test')]
class SelectMockTest extends Component
{
    public $selectedCourseId = null;
    public $selectedLevel = null;
    public $courses;
    public $levels = ['beginners', 'intermediate', 'hard'];

    public function mount()
    {
        $this->courses = Course::has('mockTests')->with(['mockTests'])->get();
    }

    public function selectCourse($courseId)
    {
        $this->selectedCourseId = $courseId;
        $this->selectedLevel = null;
    }

    public function selectLevel($level)
    {
        $this->selectedLevel = $level;
    }
    public function resetSelection()
    {
        $this->selectedCourseId = null;
        $this->selectedLevel = null;
    }
    public function render()
    {   
        $mockTests = [];
        if ($this->selectedCourseId && $this->selectedLevel) {
            $mockTests = MockTest::where('course_id', $this->selectedCourseId)
                ->where('level', $this->selectedLevel)
                ->where('status', true)
                ->get();
        }
        
        return view('livewire.student.mock-test.select-mock-test', [
            'mockTests' => $mockTests
        ]);
    }
}
