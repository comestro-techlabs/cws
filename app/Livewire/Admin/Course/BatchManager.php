<?php

namespace App\Livewire\Admin\Course;

use App\Models\Batch;
use App\Models\Course;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.admin')]
class BatchManager extends Component
{
    public $course;
    public $batchName;
    public $startDate;
    public $endDate;
    public $editingBatchId = null;
    public $isEditing = false;

    protected $rules = [
        'batchName' => 'required|string|max:255',
        'startDate' => 'required|date|after_or_equal:today',
    ];

    public function mount(Course $course)
    {
        $this->course = $course;
    }

    public function updatedStartDate()
    {
        if ($this->startDate) {
            $this->calculateEndDate();
        }
    }

    private function calculateEndDate()
    {
        if (!$this->startDate || !$this->course->duration) {
            return;
        }
        
        $startDate = new \DateTime($this->startDate);
        $endDate = clone $startDate;
        $endDate->modify('+' . $this->course->duration . ' weeks');
        $this->endDate = $endDate->format('Y-m-d');
    }

    public function editBatch($batchId)
    {
        $batch = Batch::find($batchId);
        if ($batch) {
            $this->editingBatchId = $batchId;
            $this->batchName = $batch->batch_name;
            $this->startDate = $batch->start_date;
            $this->endDate = $batch->end_date;
            $this->isEditing = true;
        }
    }

    public function cancelEdit()
    {
        $this->reset(['editingBatchId', 'batchName', 'startDate', 'endDate', 'isEditing']);
    }

    public function updateBatch()
    {
        $this->validate();
        
        $batch = Batch::find($this->editingBatchId);
        if ($batch) {
            $this->calculateEndDate();
            
            $batch->update([
                'batch_name' => $this->batchName,
                'start_date' => $this->startDate,
                'end_date' => $this->endDate,
            ]);

            $this->cancelEdit();
            $this->dispatch('notice', type: 'success', text: 'Batch updated successfully!');
        }
    }

    public function addBatch()
    {
        $this->validate();
        
        $this->calculateEndDate();

        $this->course->batches()->create([
            'batch_name' => $this->batchName,
            'start_date' => $this->startDate,
            'end_date' => $this->endDate,
        ]);

        $this->reset(['batchName', 'startDate', 'endDate']);
        $this->dispatch('notice', type: 'success', text: 'Batch added successfully!');
    }

    public function deleteBatch($batchId)
    {
        $batch = Batch::find($batchId);
        if (!$batch) {
            $this->dispatch('notice', type: 'error', text: 'Batch not found!');
            return;
        }

        $hasEnrolledStudents = DB::table('course_student')
            ->where('batch_id', $batch->id)
            ->exists();

        if ($hasEnrolledStudents) {
            $this->dispatch('notice', type: 'error', text: 'Cannot delete batch with enrolled students.');
            return;
        }

        $batch->delete();
        $this->dispatch('notice', type: 'success', text: 'Batch deleted successfully!');
    }

    public function render()
    {
        return view('livewire.admin.course.batch-manager', [
            'batches' => $this->course->batches
        ]);
    }
}
