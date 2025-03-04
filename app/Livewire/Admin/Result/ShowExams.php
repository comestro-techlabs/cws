<?php

namespace App\Livewire\Admin\Result;

use Livewire\Component;
use App\Models\Exam;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;


#[Layout('components.layouts.admin')]
#[Title('Manage Exam Results')]
class ShowExams extends Component
{
    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    private function getExams()
    {
        return Exam::with('course')
            ->where('exam_name', 'like', '%' . $this->search . '%')
            ->paginate(10);
    }
    public function render()
    {
        return view('livewire.admin.result.show-exams', [
            'exams' => $this->getExams()
        ]);
    }
}
