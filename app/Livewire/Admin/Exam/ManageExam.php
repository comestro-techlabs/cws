<?php

namespace App\Livewire\Admin\Exam;

use App\Models\Batch;
use App\Models\Course;
use App\Models\Exam;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

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
            'status' => $this->status
        ]);

        $this->reset(['exam_name', 'course_id', 'batch_id', 'exam_date', 'status']);
        
        $this->dispatch('notice', type: 'info', text: 'Exam created successfully!');

    }

    public function edit(Exam $exam)
    {
        $this->isEditing = true;
        $this->showForm=true;
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
        if ($exam->quizzes()->count() >= 10) {
            $exam->status = !$exam->status;
            $exam->save();

            if ($exam->status) {
                $this->notifyUsers($exam);
            }
            $this->dispatch('notice', type: 'info', text: 'Exam status updated successfully!');

        } else {
            $this->dispatch('notice', type: 'error', text: 'Exam must have at least 10 quizzes to activate.');
            session()->flash('error', 'Exam must have at least 10 quizzes to activate.');
        }
    }

    private function notifyUsers(Exam $exam)
    {
        $users = User::whereHas('batches', function ($query) use ($exam) {
            $query->where('batch_id', $exam->batch_id);
        })->get();

        foreach ($users as $user) {
            Mail::send(
                'emails.exam_notification',
                ['user' => $user, 'exam' => $exam],
                function ($message) use ($user) {
                    $message->to($user->email, $user->name)->subject('New Exam Available');
                }
            );
        }
    }

    public function render()
    {
        $exams = Exam::with(['course', 'batch'])
            ->when($this->search, function($query) {
                $query->where('exam_name', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(10);

        return view('livewire.admin.exam.manage-exam', [
            'exams' => $exams,
            'batches' => $this->batches
        ]);
    }

    // protected $listeners = ['refreshComponent' => '$refresh'];
}
