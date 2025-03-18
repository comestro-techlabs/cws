<?php

namespace App\Livewire\Admin\Certificate;

use Livewire\Component;
use App\Models\Course;
use App\Models\Certificate;
use App\Models\Assignment_upload;
use App\Models\ExamUser;
use App\Models\User;
use App\Models\Exam;
use App\Models\Quiz;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.admin')]
class ManageCertificate extends Component
{
    public $selectedCourse;
    public $activeTab = 'eligible';

    public function calculateExamPercentage($userId, $courseId)
    {
        $exam = Exam::where('course_id', $courseId)->first();
        if (!$exam) return null;

        $examUser = ExamUser::where('user_id', $userId)
            ->where('exam_id', $exam->id)
            ->first();

        if (!$examUser) return null;

        $totalPossibleMarks = Quiz::where('exam_id', $exam->id)->sum('marks');
        return $totalPossibleMarks > 0 ? ($examUser->total_marks / $totalPossibleMarks) * 100 : 0;
    }

    public function calculateOverallPercentage($userId, $courseId)
    {
        $examPercentage = $this->calculateExamPercentage($userId, $courseId);
        $assignments = Assignment_upload::where('student_id',$userId)
            ->whereHas('assignment', fn($q) => $q->where('course_id', $courseId))
            ->get();
       
        $avgAssignment = $assignments->avg('grade') ?? 0;

        if (is_null($examPercentage) && $avgAssignment == 0) {
            return null; // No exam or assignments
        }

        $examPercentage = $examPercentage ?? 0;
        return ($examPercentage + $avgAssignment) / 2;
    }

    public function approveCertificate($userId)
    {
        $course = Course::find($this->selectedCourse);
        $examPercentage = $this->calculateExamPercentage($userId, $this->selectedCourse);

        if ($examPercentage >= 70) {
            $certificate = Certificate::where('user_id', $userId)
                ->where('course_id', $this->selectedCourse)
                ->first();

            if (!$certificate) {
                Certificate::create([
                    'user_id' => $userId,
                    'course_id' => $this->selectedCourse,
                    'certificate_no' => "LS/{$course->course_code}/" . date('Y') . "/{$userId}",
                    'date' => now(),
                    'overall_percentage' => $this->calculateOverallPercentage($userId, $this->selectedCourse),
                    'admin_approve' => true
                ]);
            } else {
                $certificate->update(['admin_approve' => true]);
            }
        }
    }

    public function render()
    {
        $courses = Course::all();
        $eligibleStudents = [];
        $notEligibleStudents = [];

        if ($this->selectedCourse) {
            // Get all users enrolled in the course (assuming a relationship exists)
            $users = User::whereHas('exams', fn($q) => $q->where('course_id', $this->selectedCourse))
                ->orWhereHas('Assignment_uploads', fn($q) => $q->whereHas('assignment', fn($a) => $a->where('course_id', $this->selectedCourse)))
                ->get();

            foreach ($users as $user) {
                $examPercentage = $this->calculateExamPercentage($user->id, $this->selectedCourse);
                $overallPercentage = $this->calculateOverallPercentage($user->id, $this->selectedCourse);
                $certificate = Certificate::where('user_id', $user->id)
                    ->where('course_id', $this->selectedCourse)
                    ->first();

                $assignments = Assignment_upload::where('student_id', $user->id)
                    ->whereHas('assignment', fn($q) => $q->where('course_id', $this->selectedCourse))
                    ->get();

                $data = [
                    'user' => $user,
                    'exam_percentage' => $examPercentage,
                    'overall_percentage' => $overallPercentage,
                    'certificate' => $certificate,
                    'assignments' => $assignments
                ];

                if ($examPercentage >= 70) {
                    $eligibleStudents[] = $data;
                } else {
                    $notEligibleStudents[] = $data;
                }
            }
        }

        return view('livewire.admin.certificate.manage-certificate', [
            'courses' => $courses,
            'eligibleStudents' => $eligibleStudents,
            'notEligibleStudents' => $notEligibleStudents
        ]);
    }
}