<?php

namespace App\Livewire\Admin\Exam;

use App\Jobs\SendExamNotification;
use App\Models\Batch;
use App\Models\Course;
use App\Models\Exam;
use App\Models\Quiz;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

#[Layout('components.layouts.admin')]
#[Title('Manage Exams')]
class ManageExam extends Component
{
    use WithPagination;

    public $search = '';
    public $exam_name;
    public $course_id = '';
    public $batch_id = '';
    public $exam_date;
    public $status = false;
    public $courses;
    public $batches = [];
    public $showForm = false;
    public $isEditing = false;
    public $editingExamId;
    public $showPasscodeModal = false;
    public $selectedExamId;
    public $generatedPasscode;
    public $filters = [
        'course' => '',
        'batch' => '',
        'status' => '',
        'date' => ''
    ];

    public $showJsonModal = false;
    public $jsonData = '';

    protected $rules = [
        'exam_name' => 'required|string',
        'course_id' => 'required|exists:courses,id',
        'batch_id' => 'required|exists:batches,id',
        'exam_date' => 'required|date|after_or_equal:today',
        'status' => 'nullable|boolean'
    ];

    // Enforce one exam per course-batch combination
    protected function validateUniqueExam()
    {
        $query = Exam::where('course_id', $this->course_id)
            ->where('batch_id', $this->batch_id);

        if ($this->isEditing) {
            $query->where('id', '!=', $this->editingExamId);
        }

        return !$query->exists();
    }

    public function mount()
    {
        $this->courses = Course::orderBy('title')->get();
    }

    public function toggleForm()
    {
        $this->showForm = !$this->showForm;
        if (!$this->showForm) {
            $this->reset(['exam_name', 'course_id', 'batch_id', 'exam_date', 'status', 'isEditing', 'editingExamId']);
        }
    }

    public function updatedCourseId($value)
    {
        if ($value) {
            $this->batch_id = ''; // Reset batch selection
            $this->batches = Batch::where('course_id', $value)
                ->orderBy('batch_name')
                ->get();
        } else {
            $this->batches = [];
        }
    }

    public function create()
    {
        $this->validate();

        if (!$this->validateUniqueExam()) {
            $this->dispatch('notice', type: 'error', text: 'An exam already exists for this course and batch combination!');
            return;
        }

        $exam = Exam::create([
            'exam_name' => $this->exam_name,
            'course_id' => $this->course_id,
            'batch_id' => $this->batch_id,
            'exam_date' => $this->exam_date,
            'status' => $this->status,
            'passcode' => null 
        ]);

        $this->reset(['exam_name', 'course_id', 'batch_id', 'exam_date', 'status']);
        $this->dispatch('notice', type: 'info', text: 'Exam created successfully!');
    }

    public function edit(Exam $exam)
    {
        $this->isEditing = true;
        $this->showForm = true;
        $this->editingExamId = $exam->id;
        $this->exam_name = $exam->exam_name;
        $this->course_id = $exam->course_id;
        $this->batches = Batch::where('course_id', $exam->course_id)
            ->orderBy('batch_name')
            ->get();
        $this->batch_id = $exam->batch_id;
        $this->exam_date = $exam->exam_date;
        $this->status = $exam->status;
    }

    public function update()
    {
        $this->validate();

        if (!$this->validateUniqueExam()) {
            $this->dispatch('notice', type: 'error', text: 'An exam already exists for this course and batch combination!');
            return;
        }

        $exam = Exam::find($this->editingExamId);
        $exam->update([
            'exam_name' => $this->exam_name,
            'course_id' => $this->course_id,
            'batch_id' => $this->batch_id,
            'exam_date' => $this->exam_date,
            'status' => $this->status
        ]);

        $this->reset(['exam_name', 'course_id', 'batch_id', 'exam_date', 'status', 'isEditing', 'editingExamId']);
        $this->dispatch('notice', type: 'info', text: 'Exam updated successfully!');
    }

    public function delete(Exam $exam)
    {
        $exam->delete();
        $this->dispatch('notice', type: 'info', text: 'Exam deleted successfully!');
    }
 
    public function toggleStatus(Exam $exam)
    {
        $exam->status = !$exam->status;
        $exam->save();

        if ($exam->status) {
            $this->notifyUsers($exam);
        }
        $this->dispatch('notice', type: 'success', text: 'Exam status updated successfully!');
    }

    private function notifyUsers(Exam $exam)
    {
        $users = User::whereHas('batches', function ($query) use ($exam) {
            $query->where('batch_id', $exam->batch_id);
        })->get();
        foreach ($users as $user) {
            dispatch(new SendExamNotification($user, $exam)); 
        }
    }

    public function generatePasscode($examId)
    {
        $exam = Exam::find($examId);
        
        if (!$exam->passcode) {
            $passcode = Str::random(8);
            $exam->update(['passcode' => $passcode]);
        }
        
        $this->selectedExamId = $examId;
        $this->generatedPasscode = $exam->passcode;
        $this->showPasscodeModal = true;
    }

    public function showPasscode($examId)
    {
        $exam = Exam::find($examId);
        if ($exam->passcode && Carbon::now()->greaterThan($exam->updated_at->addHour())) {
            $exam->update([
                'passcode' => null,
            ]);
            $this->dispatch('notice', type: 'info', text: 'The passcode has expired and has been reset.');
            $this->generatedPasscode = null;
        } else {
            $this->generatedPasscode = $exam->passcode;
            
        }
        
        $this->selectedExamId = $examId;
        $this->showPasscodeModal = true;
    }

    public function closePasscodeModal()
    {
        $this->showPasscodeModal = false;
        $this->selectedExamId = null;
        $this->generatedPasscode = null;
    }

    public function resetFilters()
    {
        $this->reset('filters');
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
    
            // Define validation rules for the exam data from JSON
            $examRules = [
                'exam_name' => 'required|string',
                'course_id' => 'required|exists:courses,id',
                'batch_id' => 'required|exists:batches,id',
                'exam_date' => 'required|date|after_or_equal:today',
                'status' => 'nullable|boolean',
                'passcode' => 'nullable|string',
            ];
    
            // Extract exam data from JSON
            $examData = [
                'exam_name' => $data['exam_name'] ?? null,
                'course_id' => $data['course_id'] ?? null,
                'batch_id' => $data['batch_id'] ?? null,
                'exam_date' => $data['exam_date'] ?? null,
                'status' => $data['status'] ?? false,
                'passcode' => $data['passcode'] ?? null,
            ];
    
            // Validate the exam data
            $validator = \Validator::make($examData, $examRules);
            if ($validator->fails()) {
                throw new \Exception('Validation failed: ' . implode(', ', $validator->errors()->all()));
            }
    
            // Check for existing exam for this course-batch combination
            if (Exam::where('course_id', $examData['course_id'])
                ->where('batch_id', $examData['batch_id'])
                ->exists()) {
                throw new \Exception('An exam already exists for this course and batch combination!');
            }
    
            // Create the exam
            $exam = Exam::create([
                'exam_name' => $examData['exam_name'],
                'course_id' => $examData['course_id'],
                'batch_id' => $examData['batch_id'],
                'exam_date' => $examData['exam_date'],
                'status' => $examData['status'],
                'passcode' => $examData['passcode'],
            ]);
    
            // Handle questions if present
            if (!isset($data['questions']) || !is_array($data['questions']) || empty($data['questions'])) {
                $this->showJsonModal = false;
                $this->jsonData = '';
                $this->dispatch('notice', type: 'success', text: 'Exam imported successfully without questions!');
                return;
            }
    
            // Define validation rules for each question
            $questionRules = [
                'question' => 'required|string',
                'options' => 'required|array|size:4',
                'options.*' => 'required|string',
                'correct_answer' => 'required|string',
                'status' => 'nullable|boolean',
            ];
    
            // Validate and create questions
            foreach ($data['questions'] as $index => $questionData) {
                $questionInput = [
                    'question' => $questionData['question'] ?? null,
                    'options' => $questionData['options'] ?? [],
                    'correct_answer' => $questionData['correct_answer'] ?? null,
                    'status' => $questionData['status'] ?? true,
                ];
    
                $questionValidator = \Validator::make($questionInput, $questionRules);
                if ($questionValidator->fails()) {
                    throw new \Exception("Question #$index validation failed: " . implode(', ', $questionValidator->errors()->all()));
                }
    
                Quiz::create([
                    'exam_id' => $exam->id,
                    'question' => $questionInput['question'],
                    'option1' => $questionInput['options'][0],
                    'option2' => $questionInput['options'][1],
                    'option3' => $questionInput['options'][2],
                    'option4' => $questionInput['options'][3],
                    'correct_answer' => $questionInput['correct_answer'],
                    'status' => $questionInput['status'],
                ]);
            }
    
            $this->showJsonModal = false;
            $this->jsonData = '';
            $this->dispatch('notice', type: 'success', text: 'Exam and questions imported successfully!');
    
        } catch (\Exception $e) {
            $this->dispatch('notice', type: 'error', text: 'Error: ' . $e->getMessage());
        }
    }

    public function render()
    {
        $exams = Exam::with(['course', 'batch'])
            ->when($this->search, function($query) {
                $query->where('exam_name', 'like', '%' . $this->search . '%');
            })
            ->when($this->filters['course'], function($query) {
                $query->where('course_id', $this->filters['course']);
            })
            ->when($this->filters['batch'], function($query) {
                $query->where('batch_id', $this->filters['batch']);
            })
            ->when($this->filters['status'] !== '', function($query) {
                $query->where('status', $this->filters['status']);
            })
            ->when($this->filters['date'], function($query) {
                $query->whereDate('exam_date', $this->filters['date']);
            })
            ->latest()
            ->paginate(10);

        return view('livewire.admin.exam.manage-exam', [
            'exams' => $exams,
            'batches' => $this->batches
        ]);
    }
}