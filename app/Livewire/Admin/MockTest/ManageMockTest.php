<?php

namespace App\Livewire\Admin\MockTest;

use Livewire\Component;
use App\Models\MockTest;
use App\Models\MockTestQuestion;
use App\Models\Course;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
#[Title('Manage Mocktest')]
class ManageMockTest extends Component
{
    use WithPagination;
    // Mock Test Properties
    #[Rule('required|string|max:255')]
    public $test_title;

    #[Rule('required|exists:courses,id')]
    public $course_id;

    #[Rule('required|in:beginners,intermediate,hard')]
    public $level = 'beginners';

    #[Rule('boolean')]
    public $status = true;

    // Question Properties
    public $question;
    public $options = ['', '', '', ''];
    public $correct_answer;
    public $currentMockTestId;

    public $courses;
    public $editingId = null;
    public $showModal = false;
    public $showQuestionForm = false;
    public $showQuestionsModal = false;
    public $viewQuestionsId = null;
    public $deleteId = null;
    
    public $deleteQuestionId = null;
    public $editingQuestionId = null;
    protected $rules = [
        'question' => 'required|string',
        'options' => 'required|array|min:2',
        'options.*' => 'required|string',
        'correct_answer' => 'required|in_array:options.*',
    ];

    public $activeTab = 'tests';
    public $showJsonModal = false;
    public $jsonData = '';
    public $allQuestions;

    protected $loadingStates = [
        'saving' => false,
        'deleting' => false,
        'importing' => false,
        'toggling' => false
    ];

    public function mount()
    {
        $this->courses = Course::all();
    }

    public function resetForm()
    {
        $this->reset(['test_title', 'course_id', 'level', 'editingId', 'question', 'options', 'correct_answer']);
        $this->status = true;
        $this->level = 'beginners';
        $this->options = ['', '', '', ''];
        $this->showModal = false;
        $this->showQuestionForm = false;
        $this->showQuestionsModal = false;
    }

    public function save()
    {
        $this->loadingStates['saving'] = true;
        $this->validateOnly('test_title');
        $this->validateOnly('course_id');
        $this->validateOnly('level');
        $this->validateOnly('status');

        if ($this->editingId) {
            MockTest::find($this->editingId)->update([
                'test_title' => $this->test_title,
                'course_id' => $this->course_id,
                'level' => $this->level,
                'status' => $this->status,
            ]);
            $this->resetForm();
        } else {
            $mockTest = MockTest::create([
                'test_title' => $this->test_title,
                'course_id' => $this->course_id,
                'level' => $this->level,
                'status' => $this->status,
            ]);
            $this->currentMockTestId = $mockTest->id;
            $this->showModal = false;
            $this->showQuestionForm = true;
            $this->reset(['test_title', 'course_id', 'level', 'editingId']);
        }
        $this->loadingStates['saving'] = false;
    }

    public function saveQuestion()
    {
        $this->validate([
            'question' => 'required|string',
            'options' => 'required|array|min:4|max:4',
            'options.*' => 'required|string|distinct',
            'correct_answer' => 'required|string|in:' . implode(',', $this->options),
        ]);

        try {
            if ($this->editingQuestionId) {
                $question = MockTestQuestion::findOrFail($this->editingQuestionId);
                $question->update([
                    'question' => $this->question,
                    'options' => json_encode($this->options),
                    'correct_answer' => $this->correct_answer,
                    'marks' => 1,
                ]);
                $this->dispatch('notice', type: 'success', text: 'Question updated successfully!');
            } else {
                MockTestQuestion::create([
                    'mocktest_id' => $this->currentMockTestId,
                    'question' => $this->question,
                    'options' => json_encode($this->options),
                    'correct_answer' => $this->correct_answer,
                    'marks' => 1,
                ]);
                $this->dispatch('notice', type: 'success', text: 'Question added successfully!');
            }

            $this->reset(['question', 'options', 'correct_answer']);
            $this->options = ['', '', '', ''];
            
            if ($this->editingQuestionId) {
                $this->editingQuestionId = null;
                $this->showQuestionForm = false;
                $this->viewQuestionsId = $this->currentMockTestId;
                $this->showQuestionsModal = true;
            }
        } catch (\Exception $e) {
            $this->dispatch('notice', type: 'error', text: 'Error: ' . $e->getMessage());
        }
    }

    public function finishQuestions()
    {
        $this->resetForm();
        $this->currentMockTestId = null;
    }

    public function edit($id)
    {
        $test = MockTest::findOrFail($id);
        $this->editingId = $id;
        $this->test_title = $test->test_title;
        $this->course_id = $test->course_id;
        $this->level = $test->level;
        $this->status = (bool) $test->status;
        $this->showModal = true;
    }

    public function addQuestions($id)
    {
        $this->currentMockTestId = $id;
        $this->showQuestionForm = true;
    }

    public function viewQuestions($id)
    {
        return redirect()->route('admin.mock-test.questions', ['mockTestId' => $id]);
    }

    public function editQuestion($id)
    {
        try {
            $question = MockTestQuestion::findOrFail($id);
            $this->editingQuestionId = $id;
            $this->currentMockTestId = $question->mocktest_id;
            $this->question = $question->question;
            $this->options = json_decode($question->options, true) ?: ['', '', '', ''];
            $this->correct_answer = $question->correct_answer;
            $this->showQuestionsModal = false;
            $this->showQuestionForm = true;
        } catch (\Exception $e) {
            $this->dispatch('notice', type: 'error', text: 'Error loading question: ' . $e->getMessage());
        }
    }

    public function confirmDeleteQuestion($id)
    {
        $this->deleteQuestionId = $id;
    }

    public function deleteQuestion()
    {
        try {
            if ($this->deleteQuestionId) {
                $question = MockTestQuestion::findOrFail($this->deleteQuestionId);
                $question->delete();
                $this->dispatch('notice', type: 'success', text: 'Question deleted successfully!');
            }
        } catch (\Exception $e) {
            $this->dispatch('notice', type: 'error', text: 'Error deleting question: ' . $e->getMessage());
        } finally {
            $this->deleteQuestionId = null;
            $this->showQuestionsModal = false;
            $this->reset(['question', 'options', 'correct_answer']);
        }
    }

    public function toggleStatus($id)
    {
        $this->loadingStates['toggling'] = true;
        $test = MockTest::findOrFail($id);
        $test->update(['status' => !$test->status]);
        $this->loadingStates['toggling'] = false;
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
    }

    public function delete()
    {
        $this->loadingStates['deleting'] = true;
        MockTest::find($this->deleteId)->delete();
        $this->deleteId = null;
        $this->loadingStates['deleting'] = false;
    }

    public function importJson()
    {
        $this->loadingStates['importing'] = true;
        try {
            $data = json_decode($this->jsonData, true);
            
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \Exception('Invalid JSON format');
            }

            $this->validate([
                'jsonData' => 'required|json',
            ]);

            // Create mock test
            $mockTest = MockTest::create([
                'test_title' => $data['test_title'],
                'course_id' => $data['course_id'],
                'level' => $data['level'],
                'status' => $data['status'] ?? true,
            ]);

            // Create questions
            foreach ($data['questions'] as $questionData) {
                MockTestQuestion::create([
                    'mocktest_id' => $mockTest->id,
                    'question' => $questionData['question'],
                    'options' => json_encode($questionData['options']),
                    'correct_answer' => $questionData['correct_answer'],
                    'marks' => $questionData['marks'] ?? 1,
                ]);
            }

            $this->showJsonModal = false;
            $this->jsonData = '';
            $this->dispatch('notice', type: 'success', text: 'Mock test imported successfully!');

        } catch (\Exception $e) {
            $this->dispatch('notice', type: 'error', text: 'Error: ' . $e->getMessage());
        } finally {
            $this->loadingStates['importing'] = false;
        }
    }

    public function render()
    {
        $tests = MockTest::with('course')->latest()->paginate(10);
        $questions = $this->viewQuestionsId ? MockTestQuestion::where('mocktest_id', $this->viewQuestionsId)->get() : [];
        $allQuestions = $this->activeTab === 'questions' 
            ? MockTestQuestion::with('mockTest')->latest()->paginate(12)
            : collect();

        return view('livewire.admin.mock-test.manage-mock-test', compact('tests', 'questions', 'allQuestions'));
    }
}
