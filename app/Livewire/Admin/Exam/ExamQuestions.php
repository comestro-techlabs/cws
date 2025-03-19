<?php

namespace App\Livewire\Admin\Exam;

use App\Models\Exam;
use App\Models\Quiz;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use App\Models\Question;

#[Layout('components.layouts.admin')]
#[Title('Manage Exam Questions')]
class ExamQuestions extends Component
{
    use WithPagination;

    public $exam;
    public $search = '';
    public $selectedQuestions = [];
    public $editingQuestion = null;
    public $showEditModal = false;

    protected $listeners = ['questionDeleted' => '$refresh'];

    public function mount($examId)
    {
        $this->exam = Exam::with('course')->findOrFail($examId);
    }

    public function deleteSelected()
    {
        Quiz::whereIn('id', $this->selectedQuestions)->delete();
        $this->selectedQuestions = [];
        session()->flash('message', 'Selected questions deleted successfully');
    }

    public function delete($id)
    {
        Quiz::findOrFail($id)->delete();
        session()->flash('message', 'Question deleted successfully');
    }

    public function editQuestion($id)
    {
        $this->editingQuestion = Quiz::findOrFail($id);
        $this->showEditModal = true;
    }

    public function render()
    {
        $questions = Quiz::where('exam_id', $this->exam->id)
            ->when($this->search, function($query) {
                $query->where('question', 'like', '%' . $this->search . '%');
            })
            ->paginate(12);

        return view('livewire.admin.exam.exam-questions', [
            'questions' => $questions
        ]);
    }
}
