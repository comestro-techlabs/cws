<?php

namespace App\Livewire\Admin\Certificate;

use Livewire\Component;
use App\Models\User;
use App\Models\Course;
use App\Models\Certificate;
use App\Models\ExamUser;
use App\Models\Assignment_upload;
use App\Models\MockTestResult;
use Carbon\Carbon;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.admin')]
class ViewDetail extends Component
{
    public $studentId;
    public $courseId;
    public $activeTab = 'exam';
    public $student;
    public $course;

    public function mount($studentId, $courseId)
    {
        $this->studentId = $studentId;
        $this->courseId = $courseId;
        $this->student = User::find($studentId);
        $this->course = Course::find($courseId);
    }

    public function switchTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function generateCertificate()
    {
        $overallPercent = (new ManageCertificate)->calculatePercentage($this->student, $this->course);

        if ($overallPercent && $overallPercent >= 60) {
            $year = Carbon::now()->format('Y');
            $certificate = Certificate::create([
                'user_id' => $this->studentId,
                'course_id' => $this->courseId,
                'certificate_no' => "LS/{$this->course->course_code}/{$year}/{$this->studentId}",
                'overall_percentage' => $overallPercent,
                'admin_approve' => true,
                'date' => Carbon::now(),
            ]);

            // Refresh the certificate property after generation
            $this->dispatch('refresh')->self();
        }
    }

    public function toggleApproval($certificateId)
    {
        $certificate = Certificate::find($certificateId);
        if ($certificate) {
            $certificate->update([
                'admin_approve' => !$certificate->admin_approve
            ]);
        }
    }

    public function getCertificateProperty()
    {
        return Certificate::where('user_id', $this->studentId)
            ->where('course_id', $this->courseId)
            ->first();
    }

    public function getExamDetails()
    {
        return ExamUser::where('user_id', $this->studentId)
            ->whereHas('exam', function($query) {
                $query->where('course_id', $this->courseId);
            })
            ->with('exam')
            ->get();
    }

    public function getAssignmentDetails()
    {
        return Assignment_upload::where('student_id', $this->studentId)
            ->whereHas('assignment', function($query) {
                $query->where('course_id', $this->courseId);
            })
            ->with('assignment')
            ->get();
    }

    public function getMockTestDetails()
    {
        return MockTestResult::where('user_id', $this->studentId)
        
            ->with('mockTest')
            ->get();
    }

    public function render()
    {
        $certificate = $this->getCertificateProperty();

        return view('livewire.admin.certificate.view-detail', [
            'examDetails' => $this->getExamDetails(),
            'assignmentDetails' => $this->getAssignmentDetails(),
            'mockTestDetails' => $this->getMockTestDetails(),
            'certificate' => $certificate
        ]);
    }
}
