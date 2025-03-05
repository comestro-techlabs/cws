<?php

namespace App\Livewire\Student\Dashboard\Takeexam;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Answer;
use App\Models\ExamUser;

class Result extends Component
{
    public $results;
    public $totalMarks;
    public $attempt;

    // Show results for a specific exam
    public function showResults($exam_id)
    {
        if (!Auth::check()) {
            return redirect()->route('auth.login')->with('error', 'You must be logged in to access this page.');
        }
        
        $user = Auth::user();

        // Get the results for the user and exam
        $results = Answer::where('user_id', $user->id)
            ->where('exam_id', $exam_id)
            ->get();

        // Check if an attempt was made
        $exam_user = ExamUser::where('user_id', $user->id)
            ->where('exam_id', $exam_id)
            ->first();

        // Handle case if no attempt was found
        if (!$exam_user) {
            return redirect()->route('student.showquiz')->with('error', 'No attempt found for this exam.');
        }

        // Store data to pass to the view
        $this->results = $results;
        $this->totalMarks = $exam_user->total_marks;
        $this->attempt = $exam_user->attempts;

        return view('studentdashboard.quiz.results', [
            'results' => $this->results,
            'totalMarks' => $this->totalMarks,
            'attempt' => $this->attempt,
        ]);
    }

    // Show course results
    public function courseResult()
    {
        if (!Auth::check()) {
            return redirect()->route('auth.login')->with('error', 'You must be logged in to access this page.');
        }

        $user = Auth::user();
        $courses = $user->courses()->with('users')->get();

        return view('studentdashboard.quiz.course', compact('courses'));
    }

    // Render method for Livewire component
    public function render()
    {
        return view('livewire.student.dashboard.takeexam.result');
    }
}
