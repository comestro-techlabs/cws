<?php

namespace App\Livewire\Public\Mocktest;

use App\Models\Course;
use App\Models\MockTest;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;


#[Title('Practice Tests')]
class SelectMockTest extends Component
{
    public $selectedCourseId = null;
    public $selectedLevel = null;
    public $courses;
    public $levels = ['beginners', 'intermediate', 'hard'];

    public function mount()
    {
        $this->courses = Course::whereHas('mockTests', function($query) {
            $query->public();
        })->get();
    }

    public function selectCourse($courseId)
    {
        if (!isset($courseId)) {
            throw new \InvalidArgumentException('Course ID is required.');
        }

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
        $mockTests = collect();
        if ($this->selectedCourseId && $this->selectedLevel) {
            $mockTests = MockTest::public()
                ->where('course_id', $this->selectedCourseId)
                ->where('level', $this->selectedLevel)
                ->with('questions')
                ->get()
                ->map(function($test) {
                    $test->attempted = session()->has("public_test_{$test->id}_completed");
                    $test->score = session()->get("public_test_{$test->id}_score");
                    $test->total_questions = session()->get("public_test_{$test->id}_total_questions", 0);
                    return $test;
                });
        }

        return view('livewire.public.mocktest.select-mock-test', [
            'mockTests' => $mockTests
        ]);
    }
}
