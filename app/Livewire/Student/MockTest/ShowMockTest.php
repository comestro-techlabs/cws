<?php

namespace App\Livewire\Student\MockTest;

use App\Models\MockTest;
use Livewire\Component;
use App\Models\MockTestQuestion;
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

    public function mount($mockTestId){
        $this->mockTestId = $mockTestId;
        $this->mockTest = MockTest::findOrFail($mockTestId);
        $this->questions = MockTestQuestion::where('mocktest_id', $mockTestId)->get()->toArray();
        $attempts = session()->get('test_attempts', []);
        $this->attempted = in_array($mockTestId, $attempts);
        $this->submitted = $this->attempted;
       
    }

    public function nextQuestion()
    {
        if ($this->currentQuestionIndex < count($this->questions) - 1) {
            $this->currentQuestionIndex++;
        }
        
    }

    public function previousQuestion(){
        if ($this->currentQuestionIndex > 0) {
            $this->currentQuestionIndex--;
        }
    }

    public function goToQuestion($index){
        if ($index >= 0 && $index < count($this->questions)) {
            $this->currentQuestionIndex = $index;
        }
    }

    public function submitTest()
    {
        if ($this->submitted) {
            return redirect()->route('student.tests')->with('error', 'You have already submitted this test');
        }

        $score = 0;
        foreach ($this->questions as $question) {
            if (isset($this->answers[$question['id']]) && 
                $this->answers[$question['id']] === $question['correct_answer']) {
                $score += $question['marks'];
            }
        }

        // Store attempt in session
        $attempts = session()->get('test_attempts', []);
        $attempts[] = $this->mockTestId;
        session()->put('test_attempts', array_unique($attempts));
        
        // Store results in session (optional, if you want to show results later)
        session()->put("test_result_{$this->mockTestId}", [
            'score' => $score,
            'total' => count($this->questions),
            'answers' => $this->answers,
        ]);

        $this->submitted = true;
        $this->attempted = true;

        return redirect()->route('v2.student.mocktest.course')->with('success', 'Test submitted successfully');
    }
    public function render()
    {
        return view('livewire.student.mock-test.show-mock-test');
    }
}
