<?php

namespace App\Livewire\Admin\MockTest;

use Livewire\Component;
use App\Models\MockTest;
use App\Models\MockTestQuestion;
use App\Models\Course;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;

#[Layout('components.layouts.admin')]
#[Title('Manage Mocktest')]
class ManageMockTest extends Component
{// Mock Test Properties
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
    }

    public function saveQuestion()
    {
        $this->validate($this->rules);

        if ($this->editingQuestionId) {
            $question = MockTestQuestion::find($this->editingQuestionId);
            $question->update([
                'question' => $this->question,
                'options' => json_encode($this->options),
                'correct_answer' => $this->correct_answer,
                'marks' => 1,
            ]);
            $this->editingQuestionId = null;
            $this->showQuestionForm = false;
            $this->showQuestionsModal = true;
        } else {
            MockTestQuestion::create([
                'mocktest_id' => $this->currentMockTestId,
                'question' => $this->question,
                'options' => json_encode($this->options),
                'correct_answer' => $this->correct_answer,
                'marks' => 1,
            ]);
        }
        $this->reset(['question', 'options', 'correct_answer']);
        $this->options = ['', '', '', ''];
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
        $this->viewQuestionsId = $id;
        $this->showQuestionsModal = true;
    }
    public function editQuestion($id)
    {
        $question = MockTestQuestion::findOrFail($id);
        $this->editingQuestionId = $id;
        $this->currentMockTestId = $question->mocktest_id;
        $this->question = $question->question;
        $this->options = json_decode($question->options, true);
        $this->correct_answer = $question->correct_answer;
        $this->showQuestionsModal = false;
        $this->showQuestionForm = true;
    }
    public function confirmDeleteQuestion($id)
    {
        $this->deleteQuestionId = $id;
    }
    public function deleteQuestion()
    {
        if ($this->deleteQuestionId) {
            MockTestQuestion::find($this->deleteQuestionId)->delete();
            $this->deleteQuestionId = null;
        }
    }
    public function toggleStatus($id)
    {
        $test = MockTest::findOrFail($id);
        $test->update(['status' => !$test->status]);
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
    }

    public function delete()
    {
        MockTest::find($this->deleteId)->delete();
        $this->deleteId = null;
    }
           public function render()
    {
        $tests = MockTest::with('course')->latest()->get();
        $questions = $this->viewQuestionsId ? MockTestQuestion::where('mocktest_id', $this->viewQuestionsId)->get() : [];
        return view('livewire.admin.mock-test.manage-mock-test', compact('tests', 'questions'));
    }
}
