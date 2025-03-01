<?php

namespace App\Livewire\Admin\Result;

use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\Answer;
use App\Models\Exam;
use App\Models\User;
use Livewire\Attributes\Title;


#[Layout('components.layouts.admin')]
#[Title('Manage Attempt Results Details')]
class AttemptDetails extends Component
{
    public $examId, $userId, $attempt;
    #[Layout('components.layouts.admin')]

    public function mount($examId, $userId, $attempt)
    {
        $this->examId = $examId;
        $this->userId = $userId;
        $this->attempt = $attempt;
    }

    private function getExam()
    {
        return Exam::findOrFail($this->examId);
    }

    private function getUser()
    {
        return User::findOrFail($this->userId);
    }

    private function getAnswers()
    {
        return Answer::with('quiz')
            ->where('exam_id', $this->examId)
            ->where('user_id', $this->userId)
            ->where('attempt', $this->attempt)
            ->get();
    }
    public function render()
    {
        return view('livewire.admin.result.attempt-details', [
            'answers' => $this->getAnswers(),
            'user' => $this->getUser(),
            'exam' => $this->getExam(),
            'attempt' => $this->attempt
        ]);
    }
}
