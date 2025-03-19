<?php

namespace App\Livewire\Admin\Exam;

use App\Jobs\SendExamNotification;
use App\Models\Batch;
use App\Models\Course;
use App\Models\Exam;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Str;

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

    protected $rules = [
        'exam_name' => 'required|string',
        'course_id' => 'required|exists:courses,id',
        'batch_id' => 'required|exists:batches,id',
        'exam_date' => 'required|date|after_or_equal:today',
        'status' => 'nullable|boolean'
    ];

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
            $this->batches = Batch::where('course_id', $value)->get();
        }
    }

    public function create()
    {
        $this->validate();

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
        $this->batch_id = $exam->batch_id;
        $this->exam_date = $exam->exam_date;
        $this->status = $exam->status;
    }

    public function update()
    {
        $this->validate();

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
            // here dispatching the job to notify the students about exam
            dispatch(new SendExamNotification($user, $exam)); 
        }
    }

    public function generatePasscode($examId)
    {
        $exam = Exam::find($examId);
        
        if (!$exam->passcode) {
            $passcode = Str::random(8); // Generate 8-character random passcode
            $exam->update(['passcode' => $passcode]);
        }
        
        $this->selectedExamId = $examId;
        $this->generatedPasscode = $exam->passcode;
        $this->showPasscodeModal = true;
    }

    public function showPasscode($examId)
    {
        $exam = Exam::find($examId);
        $this->selectedExamId = $examId;
        $this->generatedPasscode = $exam->passcode;
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