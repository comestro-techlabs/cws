<?php

namespace App\Livewire\Public\Mocktest;

use App\Models\MockTest;
use Livewire\Component;
use App\Models\MockTestQuestion;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;


#[Layout('components.layouts.exam')]  // Changed from 'public' to 'exam' layout
#[Title('Practice Test')]
class ShowMockTest extends Component
{
    public $mockTestId;
    public $currentQuestionIndex = 0;
    public $questions = [];
    public $answers = [];
    public $mockTest;
    public $submitted = false;
    public $timeLeft;
    public $score = 0;
    public $attempted = false;

    public function mount($mockTestId)
    {
        $this->mockTestId = $mockTestId;
        $this->mockTest = MockTest::public()->findOrFail($mockTestId);
        
        // Check if user has already attempted this test
        if (session()->has("public_test_{$mockTestId}_completed")) {
            $this->attempted = true;
            return redirect()->route('public.mocktest.result', ['mockTestId' => $mockTestId]);
        }
        
        $this->questions = MockTestQuestion::where('mocktest_id', $mockTestId)->get()->toArray();
        $this->timeLeft = 60 * 60; // 60 minutes
    }

    public function decrementTime()
    {
        if ($this->timeLeft > 0) {
            $this->timeLeft--;
        } else {
            $this->submitTest();
        }
    }

    public function saveAnswer($questionId, $selectedOption)
    {
        $this->answers[$questionId] = $selectedOption;
        
        if ($this->currentQuestionIndex < count($this->questions) - 1) {
            $this->currentQuestionIndex++;
        }
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
        if ($this->submitted) return;

        $score = 0;
        foreach ($this->questions as $question) {
            if (isset($this->answers[$question['id']]) &&
                $this->answers[$question['id']] === $question['correct_answer']) {
                $score += $question['marks'];
            }
        }

        // Store test data in session
        session([
            "public_test_{$this->mockTestId}_answers" => $this->answers,
            "public_test_{$this->mockTestId}_score" => $score,
            "public_test_{$this->mockTestId}_completed" => true,
            "public_test_{$this->mockTestId}_completed_at" => now(),
            "public_test_{$this->mockTestId}_total_questions" => count($this->questions)
        ]);

        return redirect()->route('public.mocktest.result', ['mockTestId' => $this->mockTestId]);
    }

    public function render()
    {
        return view('livewire.public.mocktest.show-mock-test');
    }
}
