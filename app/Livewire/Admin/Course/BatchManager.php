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
    public $totalSeats;
    public $availableSeats;

    protected $rules = [
        'batchName' => 'required|string|max:255',
        'startDate' => 'required|date|after_or_equal:today',
        'totalSeats' => 'required|integer|min:1',
        'availableSeats' => 'required|integer|min:0|lte:totalSeats',
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

    public function addBatch()
    {
        $this->validate();
        
        // Calculate end date before creating batch
        $this->calculateEndDate();

        $this->course->batches()->create([
            'batch_name' => $this->batchName,
            'start_date' => $this->startDate,
            'end_date' => $this->endDate,
            'total_seats' => $this->totalSeats,
            'available_seats' => $this->availableSeats,
        ]);

        $this->reset(['batchName', 'startDate', 'endDate', 'totalSeats', 'availableSeats']);
       
        $this->dispatch('notice', type: 'info', text: 'Batch added successfully!');

    }

    public function deleteBatch($batchId)
    {
        $batch = Batch::find($batchId);
        if (!$batch) {
            $this->dispatch('notice', type: 'info', text: 'Batch not found!');
            return;
        }

        // Check if any user is assigned to this batch
        $usersAssigned = DB::table('course_student')->where('batch_id', $batch->id)->exists();

        if ($usersAssigned) {
            $this->dispatch('notice',type:'info', text: 'This batch cannot be deleted because users are assigned to it.');
            return;
        }

        $batch->delete();
        $this->dispatch('notice',type:'info', text: 'Batch Updated Successfully!');
    }

    public function render()
    {
        return view('livewire.admin.course.batch-manager', [
            'batches' => $this->course->batches
        ]);
    }
}
