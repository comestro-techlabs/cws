<?php

namespace App\Livewire\Admin\Certificate;

use Livewire\Component;
use App\Models\Course;
use App\Models\Certificate;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use Illuminate\Pagination\LengthAwarePaginator;

#[Layout('components.layouts.admin')]
class ManageCertificate extends Component
{
    use WithPagination;
    public $courses;
    public $selectedCourse = null;
    public $selectedCertificate = null;
    public $perPage = 10;
    public $searchTerm = '';
    public $activeTab = 'eligible';

    public function mount()
    {
        $this->loadCourses();
    }

    public function loadCourses()
    {
        $this->courses = Course::whereHas('exams')
            ->whereHas('assignments')
            ->with(['students', 'exams.quizzes', 'assignments.uploads', 'certificates'])
            ->get();
    }

    public function selectCourse($courseId)
    {
        $this->selectedCourse = $courseId;
    }

    public function getAssignmentPercentage($user, $course)
    {
        $uploads = $course->assignments()
            ->with(['uploads' => function($query) use ($user) {
                $query->where('student_id', $user->id);
            }])
            ->get()
            ->pluck('uploads')
            ->flatten();

        if ($uploads->isEmpty()) return 0;

        $totalGrade = $uploads->sum('grade');
        $maxPossibleGrade = $uploads->count() * 100;
        
        return $maxPossibleGrade > 0 ? ($totalGrade / $maxPossibleGrade) * 100 : 0;
    }

    public function getExamPercentage($user, $course)
    {
        $exam = $course->exams()->first();
        if (!$exam) return 0;

        $examUser = $user->exams()
            ->where('exam_id', $exam->id)
            ->latest()
            ->first();

        if (!$examUser) return 0;

        $totalQuestions = $exam->quizzes->count();
        return $totalQuestions > 0 ? ($examUser->total_marks / 10) * 100 : 0;
    }

    public function calculatePercentage($user, $course)
    {
        $assignmentPercentage = $this->getAssignmentPercentage($user, $course);
        $examPercentage = $this->getExamPercentage($user, $course);
        
        // Only calculate overall if exam percentage is at least 60%
        if ($examPercentage < 60) {
            return null;
        }

        return ($assignmentPercentage * 0.5) + ($examPercentage * 0.5);
    }

    public function approveCertificate($userId, $courseId)
    {
        $course = Course::find($courseId);
        $overallPercent = $this->calculatePercentage(
            $course->students->find($userId), 
            $course
        );

        if ($overallPercent && $overallPercent >= 60) {
            $year = Carbon::now()->format('Y');
            $certificate = Certificate::create([
                'user_id' => $userId,
                'course_id' => $courseId,
                'certificate_no' => "LS/{$course->course_code}/{$year}/{$userId}",
                'overall_percentage' => $overallPercent,
                'admin_approve' => false,
                'date' => Carbon::now(),
            ]);
            
            $this->selectedCertificate = $certificate->id;
        }
        
        $this->loadCourses();
    }

    public function approvePendingCertificate($certificateId)
    {
        Certificate::where('id', $certificateId)->update([
            'admin_approve' => true
        ]);
        $this->loadCourses();
    }

    public function getStudentsForTable($courseId)
    {
        $course = $this->courses->find($courseId);
        if (!$course) return collect();

        return $course->students->map(function($student) use ($course) {
            $examPercent = $this->getExamPercentage($student, $course);
            $assignmentPercent = $this->getAssignmentPercentage($student, $course);
            $overallPercent = $this->calculatePercentage($student, $course);
            $certificate = Certificate::where('user_id', $student->id)
                ->where('course_id', $course->id)
                ->first();

            return [
                'id' => $student->id,
                'name' => $student->name,
                'exam_percent' => $examPercent,
                'assignment_percent' => $assignmentPercent,
                'overall_percent' => $overallPercent,
                'certificate' => $certificate,
                'is_eligible' => $overallPercent && $overallPercent >= 60
            ];
        });
    }

    protected function paginateCollection($items, $perPage)
    {
        $page = request()->get('page', 1);
        $offset = ($page * $perPage) - $perPage;

        return new LengthAwarePaginator(
            $items->slice($offset, $perPage),
            $items->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );
    }

    public function switchTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function clearSelection()
    {
        $this->selectedCourse = null;
        $this->selectedCertificate = null;
    }

    public function render()
    {
        $students = collect();
        if ($this->selectedCourse) {
            $students = $this->getStudentsForTable($this->selectedCourse);
            
            if ($this->searchTerm) {
                $students = $students->filter(function($student) {
                    return str_contains(strtolower($student['name']), strtolower($this->searchTerm));
                });
            }
        }

        $eligibleStudents = $students->where('is_eligible', true)->values();
        $nonEligibleStudents = $students->where('is_eligible', false)->values();

        return view('livewire.admin.certificate.manage-certificate', [
            'eligibleStudents' => $this->paginateCollection($eligibleStudents, $this->perPage),
            'nonEligibleStudents' => $this->paginateCollection($nonEligibleStudents, $this->perPage)
        ]);
    }
}