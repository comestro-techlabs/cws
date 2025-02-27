<?php

namespace App\Livewire\Admin\Result;

use Livewire\Component;
use App\Models\Exam;
use App\Models\User;
use App\Models\Answer;
use Illuminate\Support\Facades\DB;

class AttemptResults extends Component
{
    public $examId, $userId;

    public function mount($examId, $userId)
    {
        $this->examId = $examId;
        $this->userId = $userId;
    }

    private function getExam()
    {
        return Exam::findOrFail($this->examId);
    }

    private function getUser()
    {
        return User::findOrFail($this->userId);
    }

    private function getAttempts()
    {
        return Answer::where('exam_id', $this->examId)
            ->where('user_id', $this->userId)
            ->select('attempt', DB::raw('SUM(obtained_marks) as total_marks'))
            ->groupBy('attempt')
            ->orderBy('attempt', 'asc')
            ->get();
    }
    public function render()
    {
        return view('livewire.admin.result.attempt-results', [
            'attempts' => $this->getAttempts(),
            'user' => $this->getUser(),
            'exam' => $this->getExam()
        ]);
    }
}
