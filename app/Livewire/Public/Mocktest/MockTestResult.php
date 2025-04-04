<?php

namespace App\Livewire\Public\Mocktest;

use App\Models\MockTest;
use App\Models\MockTestQuestion;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;


#[Title('Test Results')]
class MockTestResult extends Component
{
    public $mockTestId;
    public $mockTest;
    public $questions;
    public $answers;
    public $score;
    public $totalMarks;
    public $percentage;
    public $correctAnswers = 0;

    public function mount($mockTestId)
    {
        $this->mockTestId = $mockTestId;
        $this->mockTest = MockTest::public()->findOrFail($mockTestId);
        $this->questions = MockTestQuestion::where('mocktest_id', $mockTestId)->get()->toArray();
        
        // Use session to get answers and score for public tests
        $this->answers = session("public_test_{$mockTestId}_answers", []);
        $this->score = session("public_test_{$mockTestId}_score", 0);
        
        $this->totalMarks = array_sum(array_column($this->questions, 'marks'));
        $this->percentage = $this->totalMarks > 0 ? round(($this->score / $this->totalMarks) * 100) : 0;
        
        // Calculate correct answers
        foreach ($this->questions as $question) {
            if (isset($this->answers[$question['id']]) && 
                $this->answers[$question['id']] === $question['correct_answer']) {
                $this->correctAnswers++;
            }
        }
    }

    public function render()
    {
        return view('livewire.public.mocktest.mock-test-result');
    }
}
