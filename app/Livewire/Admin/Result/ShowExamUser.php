<?php

namespace App\Livewire\Admin\Result;

use Livewire\Component;
use App\Models\Exam;
use App\Models\ExamUser;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;


#[Layout('components.layouts.admin')]
#[Title('Manage Exam Users')]
class ShowExamUser extends Component
{
    public $examId;

    public function mount($examId)
    {
        $this->examId = $examId;
    }

    private function getExamUsers()
    {
        return ExamUser::with('user', 'exam')
            ->where('exam_id', $this->examId)
            ->get();
    }

    private function getExam()
    {
        return Exam::findOrFail($this->examId);
    }
    public function render()
    {
        return view('livewire.admin.result.show-exam-user', [
            'examuser' => $this->getExamUsers(),
            'exam' => $this->getExam()
        ]);
    }
}
