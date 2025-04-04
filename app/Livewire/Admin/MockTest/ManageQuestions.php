<?php

namespace App\Livewire\Admin\MockTest;

use Livewire\Component;
use App\Models\MockTest;
use App\Models\MockTestQuestion;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')] 
class ManageQuestions extends Component
{
    use WithPagination;
    
    public $mockTestId;
    public $mockTest;
    public $question;
    public $options = ['', '', '', ''];
    public $correct_answer;
    public $editingQuestionId = null;
    public $showQuestionForm = false;
    public $deleteId = null;
    public $jsonData = '';
    public $showJsonModal = false;
    public $selectedQuestions = [];
    public $selectAll = false;
    public $bulkDeleteModal = false;

    protected $rules = [
        'question' => 'required|string',
        'options' => 'required|array|min:4|max:4',
        'options.*' => 'required|string|distinct',
        'correct_answer' => 'required|string|in_array:options.*',
    ];

    public function mount($mockTestId)
    {
        $this->mockTestId = $mockTestId;
        $this->mockTest = MockTest::findOrFail($mockTestId);
    }

    public function edit($id) 
    {
        $question = MockTestQuestion::findOrFail($id);
        $this->editingQuestionId = $id;
        $this->question = $question->question;
        $this->options = json_decode($question->options, true);
        $this->correct_answer = $question->correct_answer;
        $this->showQuestionForm = true;
        
        // Scroll to form
        $this->dispatch('scrollTo', selector: '#question-form');
    }

    public function delete($id)
    {
        try {
            $question = MockTestQuestion::findOrFail($id);
            $question->delete();
            $this->deleteId = null;
            $this->dispatch('notice', type: 'success', text: 'Question deleted successfully');
        } catch(\Exception $e) {
            $this->dispatch('notice', type: 'error', text: 'Error deleting question');
        }
    }

    public function update()
    {
        $this->validate();

        try {
            $question = MockTestQuestion::findOrFail($this->editingQuestionId);
            $question->update([
                'question' => $this->question, 
                'options' => json_encode($this->options),
                'correct_answer' => $this->correct_answer
            ]);

            $this->resetForm();
            $this->dispatch('notice', type: 'success', text: 'Question updated successfully');

        } catch(\Exception $e) {
            $this->dispatch('notice', type: 'error', text: 'Error updating question');
        }
    }

    public function importJson()
    {
        try {
            $data = json_decode($this->jsonData, true);
            
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \Exception('Invalid JSON format');
            }

            $this->validate([
                'jsonData' => 'required|json',
            ]);

            foreach ($data as $questionData) {
                MockTestQuestion::create([
                    'mocktest_id' => $this->mockTestId,
                    'question' => $questionData['question'],
                    'options' => json_encode($questionData['options']),
                    'correct_answer' => $questionData['correct_answer'],
                    'marks' => $questionData['marks'] ?? 1,
                ]);
            }

            $this->showJsonModal = false;
            $this->jsonData = '';
            $this->dispatch('notice', type: 'success', text: 'Questions imported successfully!');

        } catch (\Exception $e) {
            $this->dispatch('notice', type: 'error', text: 'Error: ' . $e->getMessage());
        }
    }

    public function resetForm()
    {
        $this->reset(['question', 'options', 'correct_answer', 'editingQuestionId']);
        $this->showQuestionForm = false;
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedQuestions = MockTestQuestion::where('mocktest_id', $this->mockTestId)
                ->pluck('id')
                ->map(fn($id) => (string) $id)
                ->toArray();
        } else {
            $this->selectedQuestions = [];
        }
    }

    public function showBulkDeleteModal()
    {
        if (empty($this->selectedQuestions)) {
            $this->dispatch('notice', type: 'error', text: 'Please select questions to delete');
            return;
        }
        $this->bulkDeleteModal = true;
    }

    public function bulkDelete()
    {
        try {
            MockTestQuestion::whereIn('id', $this->selectedQuestions)->delete();
            $this->selectedQuestions = [];
            $this->selectAll = false;
            $this->bulkDeleteModal = false;
            $this->dispatch('notice', type: 'success', text: 'Questions deleted successfully');
        } catch(\Exception $e) {
            $this->dispatch('notice', type: 'error', text: 'Error deleting questions');
        }
    }

    public function render()
    {
        return view('livewire.admin.mock-test.manage-questions', [
            'questions' => MockTestQuestion::where('mocktest_id', $this->mockTestId)
                ->paginate(10)
        ]);
    }
}
