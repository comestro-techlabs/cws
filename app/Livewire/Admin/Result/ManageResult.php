<?php

namespace App\Livewire\Admin\Result;

use Livewire\Component;
use App\Models\Answer;
use App\Models\Exam;
use App\Models\ExamUser;
use App\Models\User;
use App\Models\Assignment_upload;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.admin')]
#[Title('Manage Results')]
class ManageResult extends Component
{
    use WithPagination;

    public $search = '';
    public $selectedExamId;
    public $selectedUserId;
    public $selectedAttempt;
    public $viewMode = 'exams';
    
    public $examUsers;
    public $exam;
    public $user;
    public $attempts;
    public $answers;
    public $userData;

    protected $queryString = [
        'search' => ['except' => ''],
        'selectedExamId' => ['except' => null],
        'selectedUserId' => ['except' => null],
        'selectedAttempt' => ['except' => null],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function showExamUsers($examId)
    {
        $this->selectedExamId = $examId;
        $this->viewMode = 'examUsers';
    }

    public function showAttempts($examId, $userId)
    {
        $this->selectedExamId = $examId;
        $this->selectedUserId = $userId;
        $this->viewMode = 'attempts';
    }

    public function showAttemptDetails($examId, $userId, $attempt)
    {
        $this->selectedExamId = $examId;
        $this->selectedUserId = $userId;
        $this->selectedAttempt = $attempt;
        $this->viewMode = 'details';
    }


    public function goBack()
    {
        if ($this->viewMode === 'examUsers') {
            $this->viewMode = 'exams';
        } elseif ($this->viewMode === 'attempts') {
            $this->viewMode = 'examUsers';
        } elseif ($this->viewMode === 'details') {
            $this->viewMode = 'attempts';
        } 
        $this->selectedAttempt = null;
    }

    public function render()
    {
        $exams = null;
        
        switch ($this->viewMode) {
            case 'exams':
                $exams = Exam::with('course')
                    ->where('exam_name', 'like', '%' . $this->search . '%')
                    ->paginate(10);
                break;

            case 'examUsers':
                $this->examUsers = ExamUser::with('user', 'exam')
                    ->where('exam_id', $this->selectedExamId)
                    ->get();
                $this->exam = Exam::findOrFail($this->selectedExamId);
                break;

            case 'attempts':
                $this->exam = Exam::findOrFail($this->selectedExamId);
                $this->user = User::findOrFail($this->selectedUserId);
                $this->attempts = Answer::where('exam_id', $this->selectedExamId)
                    ->where('user_id', $this->selectedUserId)
                    ->select('attempt', DB::raw('SUM(obtained_marks) as total_marks'))
                    ->groupBy('attempt')
                    ->orderBy('attempt', 'asc')
                    ->get();
                break;

            case 'details':
                $this->exam = Exam::findOrFail($this->selectedExamId);
                $this->user = User::findOrFail($this->selectedUserId);
                $this->answers = Answer::with('quiz')
                    ->where('exam_id', $this->selectedExamId)
                    ->where('user_id', $this->selectedUserId)
                    ->where('attempt', $this->selectedAttempt)
                    ->get();
                break;

            
        }
        return view('livewire.admin.result.manage-result', [
            'exams' => $exams
        ]);
    }
}
