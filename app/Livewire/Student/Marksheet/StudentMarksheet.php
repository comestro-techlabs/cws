<?php

namespace App\Livewire\Student\Marksheet;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.student')]
class StudentMarksheet extends Component
{
    public $selectedCourse = null;

    public function selectCourse($courseId)
    {
        $this->selectedCourse = $courseId;
    }

    public function getAssignmentGrades($course)
    {
        return $course->assignments()
            ->with(['uploads' => function($query) {
                $query->where('student_id', Auth::id());
            }])
            ->get()
            ->map(function($assignment) {
                $uploads = $assignment->uploads;
                return [
                    'title' => $assignment->title,
                    'grade' => $uploads->isNotEmpty() ? $uploads->first()->grade : null,
                    'submission_date' => $uploads->isNotEmpty() ? $uploads->first()->submitted_at : null,
                    'status' => $uploads->isNotEmpty() ? 'Submitted' : 'Pending'
                ];
            });
    }

    public function getExamResults($course)
    {
        $exams = $course->exams()
            ->with(['quizzes', 'examUser' => function($query) {
                $query->where('user_id', Auth::id());
            }])
            ->get();

        return $exams->map(function($exam) {
            $examUser = $exam->examUser->first();
            $totalQuestions = $exam->quizzes->count();
            $maxMarks =  10;

            return [
                'title' => $exam->exam_name,
                'marks' => $examUser ? $examUser->total_marks : 0,
                'total_marks' => $maxMarks,
                'percentage' => $maxMarks > 0 ? (($examUser ? $examUser->total_marks : 0) / $maxMarks) * 100 : 0,
                'status' => $examUser ? 'Completed' : 'Not Attempted'
            ];
        });
    }

    public function calculateOverallPercentage($assignmentGrades, $examResults)
    {
        $assignmentPercentage = collect($assignmentGrades)->avg('grade') ?: 0;
        $examPercentage = $examResults->avg('percentage') ?: 0;

        if ($examPercentage < 60) {
            return [
                'percentage' => null,
                'status' => 'Exam score below required 60%'
            ];
        }

        return [
            'percentage' => ($assignmentPercentage * 0.5) + ($examPercentage * 0.5),
            'status' => 'Pass'
        ];
    }

    public function render()
    {
        $courses = Auth::user()->courses()
            ->with(['assignments.uploads', 'exams.quizzes', 'exams.examUser'])
            ->get();
        
        $marksheetData = null;
        if ($this->selectedCourse) {
            $course = $courses->find($this->selectedCourse);
            if ($course) {
                $assignmentGrades = $this->getAssignmentGrades($course);
                $examResults = $this->getExamResults($course);
                $overall = $this->calculateOverallPercentage($assignmentGrades, $examResults);
                
                $marksheetData = [
                    'course_name' => $course->title,
                    'assignments' => $assignmentGrades,
                    'exams' => $examResults,
                    'assignment_avg' => collect($assignmentGrades)->avg('grade') ?: 0,
                    'exam_avg' => $examResults->avg('percentage') ?: 0,
                    'overall_percentage' => $overall['percentage'],
                    'status' => $overall['status']
                ];
            }
        }

        return view('livewire.student.marksheet.student-marksheet', [
            'courses' => $courses,
            'marksheetData' => $marksheetData
        ]);
    }
}
