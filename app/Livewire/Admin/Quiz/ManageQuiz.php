<?php

namespace App\Livewire\Admin\Quiz;

use App\Models\Quiz;
use App\Models\Exam;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;

#[Layout('components.layouts.admin')]
#[Title('Manage Quiz')]
class ManageQuiz extends Component
{
    use WithPagination;

    public $search = '';
    public $exam_id;
    public $exam_name;
    public $question;
    public $option1;
    public $option2;
    public $option3;
    public $option4;
    public $correct_answer;
    public $status = false;
    public $exams;
    public $isEditing = false;
    public $editingQuizId;
    public $showJsonModal = false;
    public $jsonData = '';

    protected $rules = [
        'exam_id' => 'required|exists:exams,id',
        'question' => 'required|string',
        'option1' => 'required|string',
        'option2' => 'required|string',
        'option3' => 'required|string',
        'option4' => 'required|string',
        'correct_answer' => 'required|in:option1,option2,option3,option4',
        'status' => 'nullable|boolean'
    ];

    public function mount($examId)
    {
        $exam = Exam::findOrFail($examId);
        $this->exams = $exam;
        $this->exam_id = $examId;
        $this->exam_name = $exam->name;
    }

    public function create()
    {
        $this->validate();

        Quiz::create([
            'exam_id' => $this->exam_id,
            'question' => $this->question,
            'option1' => $this->option1,
            'option2' => $this->option2,
            'option3' => $this->option3,
            'option4' => $this->option4,
            'correct_answer' => $this->correct_answer,
            'status' => $this->status
        ]);

        $this->reset(['question', 'option1', 'option2', 'option3', 'option4', 'correct_answer', 'status']);
        $this->dispatch('notice', type: 'info', text: 'Quiz question created successfully!');
    }

    public function edit(Quiz $quiz)
    {
        $this->isEditing = true;
        $this->editingQuizId = $quiz->id;
        $this->exam_id = $quiz->exam_id;
        $this->question = $quiz->question;
        $this->option1 = $quiz->option1;
        $this->option2 = $quiz->option2;
        $this->option3 = $quiz->option3;
        $this->option4 = $quiz->option4;
        $this->correct_answer = $quiz->correct_answer;
        $this->status = $quiz->status;
    }

    public function update()
    {
        $this->validate();

        $quiz = Quiz::find($this->editingQuizId);
        $quiz->update([
            'exam_id' => $this->exam_id,
            'question' => $this->question,
            'option1' => $this->option1,
            'option2' => $this->option2,
            'option3' => $this->option3,
            'option4' => $this->option4,
            'correct_answer' => $this->correct_answer,
            'status' => $this->status
        ]);

        $this->reset(['question', 'option1', 'option2', 'option3', 'option4', 'correct_answer', 'status', 'isEditing', 'editingQuizId']);
        $this->dispatch('notice', type: 'info', text: 'Quiz question updated successfully!');
    }

    public function delete(Quiz $quiz)
    {
        $quiz->delete();
        $this->dispatch('notice', type: 'info', text: 'Quiz question deleted successfully!');
    }

    public function toggleStatus(Quiz $quiz)
    {
        $quiz->status = !$quiz->status;
        $quiz->save();
        $this->dispatch('notice', type: 'info', text: 'Quiz status successfully!');
    }

    public function importJson()
    {
        try {
            $data = json_decode($this->jsonData, true);
            
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \Exception('Invalid JSON format');
            }

            $questions = is_array($data) ? $data : [];
            if (empty($questions)) {
                throw new \Exception('No questions found in JSON');
            }

            foreach ($questions as $questionData) {
                if (!isset($questionData['question']) || !isset($questionData['options']) || !isset($questionData['correct_answer'])) {
                    throw new \Exception('Each question must have question, options, and correct_answer fields');
                }

                if (count($questionData['options']) !== 4) {
                    throw new \Exception('Each question must have exactly 4 options');
                }

                Quiz::create([
                    'exam_id' => $this->exam_id,
                    'question' => $questionData['question'],
                    'option1' => $questionData['options'][0],
                    'option2' => $questionData['options'][1],
                    'option3' => $questionData['options'][2],
                    'option4' => $questionData['options'][3],
                    'correct_answer' => $questionData['correct_answer'],
                    'status' => $questionData['status'] ?? true,
                ]);
            }

            $this->showJsonModal = false;
            $this->jsonData = '';
            $this->dispatch('notice', type: 'success', text: count($questions) . ' questions imported successfully!');

        } catch (\Exception $e) {
            $this->dispatch('notice', type: 'error', text: 'Error: ' . $e->getMessage());
        }
    }

    public function render()
    {
        $quizzes = Quiz::where('exam_id', $this->exam_id)
            ->when($this->search, function($query) {
                $query->where('question', 'like', '%' . $this->search . '%');
            })
            ->paginate(10);

        return view('livewire.admin.quiz.manage-quiz', compact('quizzes'));
    }
}
