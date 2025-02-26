<?php
namespace App\Livewire\Admin\Certificate;
use Livewire\Component;
use App\Models\User;
use App\Models\ExamUser;
use App\Models\Assignment_upload;
use Illuminate\Support\Facades\Route;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
#[Layout('components.layouts.admin')]
#[Title('certificate')]

class CertificateEligibility extends Component
{
    public $userData = [];
    public $search = '';

    public function mount()
    {
        $this->loadEligibleUsers();
    }

    public function updatedSearch()
    {
        $this->loadEligibleUsers();
    }

    private function loadEligibleUsers()
    {
        $users = User::where('isadmin', 0)->get();
        $this->userData = [];

        foreach ($users as $user) {
            $examUser = ExamUser::where('user_id', $user->id)->first();
            $examTotal = $examUser ? $examUser->total_marks : 0;
            $assignmentTotal = Assignment_upload::where('student_id', $user->id)->sum('grade') ?? 0;

            $examName = $examUser ? $examUser->exam->exam_name : 'N/A';

            $maxAssignmentMarks = 100;
            $maxExamMarks = 20;

            $assignmentPercentage = ($assignmentTotal / $maxAssignmentMarks) * 100;
            $examPercentage = ($examTotal / $maxExamMarks) * 100;

            $percentage = ($assignmentPercentage + $examPercentage) / 2;

            if ($this->search && (
                stripos($user->name, $this->search) === false &&
                stripos($examName, $this->search) === false
            )) {
                continue;
            }

            if ($percentage >= 75) {
                $this->userData[] = [
                    'name' => $user->name,
                    'examName' => $examName,
                    'assignmentTotal' => $assignmentTotal,
                    'examTotal' => $examTotal,
                    'percentage' => $percentage,
                    'id' => $user->id
                ];
            }
        }
    }
    public function render()
    {
        return view('livewire.admin.certificate.certificate-eligibility');
    }
  
}