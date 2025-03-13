<?php

namespace App\Livewire\Student\MockTest;

use Livewire\Component;
use App\Models\MockTestQuestion;
use App\Models\MockTest;
use App\Models\MockTestResult as ModelsMockTestResult;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.student')]
#[Title('Mock Test Result')]
class MockTestResult extends Component
{
    public $mockTestId;
    public $result;
    public $questions = [];
    public $mockTest;
    public $answers = [];

    public function mount($mockTestId)
    {
        $this->mockTestId = $mockTestId;
        $this->result = ModelsMockTestResult::where('user_id', auth()->id())
            ->where('mock_test_id', $mockTestId)
            ->firstOrFail();
        $this->questions = MockTestQuestion::where('mocktest_id', $mockTestId)->get()->toArray();
        $this->mockTest = MockTest::findOrFail($mockTestId);
        $this->answers = json_decode($this->result->answers, true) ?? [];
    }

    public function render()
    {
        return view('livewire.student.mock-test.mock-test-result');
    }
}