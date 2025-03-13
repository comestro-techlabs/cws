<?php

namespace App\Livewire\Student\MockTest;

use App\Models\MockTest;
use Livewire\Component;
use App\Models\MockTestQuestion;
use App\Models\MockTestResult;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.student')]
#[Title('Mock Test')]
class ShowMockTest extends Component
{
    public $mockTestId;
    public $currentQuestionIndex = 0;
    public $questions = [];
    public $answers = [];
    public $mockTest;
    public $attempted = false;
    public $submitted = false;

    public function mount($mockTestId)
    {
        $this->mockTestId = $mockTestId;
        $this->mockTest = MockTest::findOrFail($mockTestId);
        $this->questions = MockTestQuestion::where('mocktest_id', $mockTestId)->get()->toArray();
        
        $existingResult = MockTestResult::where('user_id', auth()->id())
            ->where('mock_test_id', $mockTestId)
            ->first();
            
        if ($existingResult) {
            $this->attempted = true;
            $this->submitted = true;
            $this->answers = json_decode($existingResult->answers, true) ?? [];
        }
    }

    public function updateAnswer($questionId, $answer)
    {
        $this->answers[$questionId] = $answer;
    }

    public function nextQuestion()
    {
        if ($this->currentQuestionIndex < count($this->questions) - 1) {
            $this->currentQuestionIndex++;
        }
    }

    public function previousQuestion()
    {
        if ($this->currentQuestionIndex > 0) {
            $this->currentQuestionIndex--;
        }
    }

    public function goToQuestion($index)
    {
        if ($index >= 0 && $index < count($this->questions)) {
            $this->currentQuestionIndex = $index;
        }
    }

    public function submitTest()
    {
        if ($this->submitted) {
            return redirect()->route('v2.student.mocktest')
                ->with('error', 'You have already submitted this test');
        }

        $score = 0;
        foreach ($this->questions as $question) {
            if (isset($this->answers[$question['id']]) && 
                $this->answers[$question['id']] === $question['correct_answer']) {
                $score += $question['marks'];
            }
        }

        MockTestResult::create([
            'user_id' => auth()->id(),
            'mock_test_id' => $this->mockTestId,
            'answers' => json_encode($this->answers),
            'score' => $score,
            'total_questions' => count($this->questions),
            'completed_at' => now(),
        ]);

        $this->submitted = true;
        $this->attempted = true;

        return redirect()->route('v2.student.mocktest.result', ['mockTestId' => $this->mockTestId])
            ->with('success', 'Test submitted successfully');
    }

    public function render()
    {
        return view('livewire.student.mock-test.show-mock-test');
    }
}