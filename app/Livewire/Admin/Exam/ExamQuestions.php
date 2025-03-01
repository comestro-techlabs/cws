<?php

namespace App\Livewire\Admin\Exam;

use App\Models\Exam;
use App\Models\Quiz;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.admin')]
#[Title('Manage Exam Questions')]
class ExamQuestions extends Component
{
    use WithPagination;

    public $exam;
    public $search = '';

    public function mount($examId)
    {
        $this->exam = Exam::with('course')->findOrFail($examId);
    }

    public function render()
    {
        $questions = Quiz::where('exam_id', $this->exam->id)
            ->when($this->search, function($query) {
                $query->where('question', 'like', '%' . $this->search . '%');
            })
            ->paginate(10);

        return view('livewire.admin.exam.exam-questions', [
            'questions' => $questions
        ]);
    }
}
