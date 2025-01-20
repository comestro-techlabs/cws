<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Exam;
use App\Models\ExamUser;
use App\Models\User;
use App\Models\Assignment_upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResultController extends Controller
{
    //

    public function showExam(Request $request )
    {
        //
        $query = Exam::with('course');

        // Search functionality
        if ($request->has('search')) {
            $query->where('exam_name', 'like', '%' . $request->input('search') . '%');
        }

        $exams = $query->paginate(10);

        return view('admin.result.exam', compact('exams'));
    }

    public function showExamUser($examId)
{
    $examuser = ExamUser::with('user', 'exam')
                ->where('exam_id', $examId)
                ->get();

    $exam = Exam::findOrFail($examId);

    return view('admin.result.examUser', compact('examuser', 'exam'));
}

public function getResultsByAttempts($examId, $userId)
{
    $exam = Exam::findOrFail($examId);
    $user = User::findOrFail($userId);

    // Fetch attempts and their total marks
    $attempts = Answer::where('exam_id', $examId)
        ->where('user_id', $userId)
        ->select('attempt', DB::raw('SUM(obtained_marks) as total_marks'))
        ->groupBy('attempt')
        ->orderBy('attempt', 'asc')
        ->get();

    return view('admin.result.attempt_results', compact('attempts', 'user', 'exam'));
}


public function getAttemptDetails($examId, $userId, $attempt)
{
    $exam = Exam::findOrFail($examId);
    $user = User::findOrFail($userId);

    // Fetch answers for the specific attempt
    $answers = Answer::with('quiz')
        ->where('exam_id', $examId)
        ->where('user_id', $userId)
        ->where('attempt', $attempt)
        ->get();

    return view('admin.result.attempt_details', compact('answers', 'user', 'exam', 'attempt'));
}



public function Certificate($userId)
{
    $user = User::find($userId);
    if (!$user) {
        return redirect()->back()->with('error', 'User not found.');
    }

    $examUser = ExamUser::where('user_id', $userId)->first();
    $examTotal = $examUser ? $examUser->total_marks : 0;
    $assignmentTotal = Assignment_upload::where('student_id', $userId)->sum('grade') ?? 0;

    $examName = $examUser ? $examUser->exam->exam_name : 'N/A';

    $maxAssignmentMarks = 50;
    $maxExamMarks = 20;
    $totalMarks = $assignmentTotal + $examTotal;
    $maxTotalMarks = $maxAssignmentMarks + $maxExamMarks;
    $percentage = ($totalMarks / $maxTotalMarks) * 100;

  
    return view('admin.certificate', compact('user', 'percentage', 'totalMarks', 'assignmentTotal', 'examTotal','examName'));
}



public function index($userId)
{
    $user = User::find($userId);
    if (!$user) {
        return redirect()->back()->with('error', 'User not found.');
    }

    $examUser = ExamUser::where('user_id', $userId)->first();
    $examTotal = $examUser ? $examUser->total_marks : 0;
    $assignmentTotal = Assignment_upload::where('student_id', $userId)->sum('grade') ?? 0;

    $examName = $examUser ? $examUser->exam->exam_name : 'N/A';

    $maxAssignmentMarks = 50;
    $maxExamMarks = 20;
    $totalMarks = $assignmentTotal + $examTotal;
    $maxTotalMarks = $maxAssignmentMarks + $maxExamMarks;
    $percentage = ($totalMarks / $maxTotalMarks) * 100;

    $date = now()->toFormattedDateString(); 
    return view('admin.viewCertificate', compact('user', 'percentage', 'totalMarks', 'assignmentTotal', 'examTotal','examName','date'));
}


}


