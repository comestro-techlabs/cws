<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Exam;
use App\Models\Course;
use App\Models\Quiz;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $courses = Course::with('batches')->get();
        $batches = [];
        if ($request->has('course_id')) {
            $batches = Batch::where('course_id', $request->course_id)->get();
        }

        return view('admin.exam.create_exam', compact('courses', 'batches'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'batch_id' => 'required|exists:batches,id',
            'exam_name' => 'required|string',
            'status' => 'nullable|boolean',
            'exam_date' => 'required|date|after_or_equal:today',
        ]);

        $exam = Exam::create($request->all());

        return redirect()
        ->route('exam.create')
        ->with([
            'success' => 'Your exam was inserted successfully.',
            'exam_id' => $exam->id
        ]);    }


    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        //
        $query = Exam::with('course', 'batch');

        // Search functionality
        if ($request->has('search')) {
            $query->where('exam_name', 'like', '%' . $request->input('search') . '%');
        }

        $exams = $query->paginate(10);

        return view('admin.exam.manage_exam', compact('exams'));
    }

    public function showQuestions(Exam $exam)
    {
        $examId = $exam->id;
        $exam_name = $exam->exam_name;
        $course_title = $exam->course->title;
        // dd($exam->course->title);
        $quizQuestions = Quiz::where('exam_id', $examId)->get();
        return view('admin.exam.view_questions', compact('quizQuestions', 'exam_name', 'course_title'));
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

    public function toggleStatus(Request $request, Exam $exam)
    {


        // $exam->status = !$exam->status;
        // $exam->save();
        if ($request->has('status') && $request->input('status') == 'on') {
        if ($exam->quizzes()->count() >= 10) {
            $exam->status = true;
            $exam->save();
            if ($exam->status) {
                $this->notifyUsers($exam);
            }
            return redirect()->back()->with('success', 'Exam status updated successfully!');
        }else{
            return redirect()->back()->with('error', 'Exam must have at least 10 quizzes to activate.');

        }
    }

       
        $exam->status = false;
        $exam->save();
        return redirect()->back()->with('success', 'Exam must have at least 10 quizzes to activate.');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Exam $exam)
    {
        $courses = Course::all();
        $batches = Batch::all();
        return view('admin.exam.edit_exam', compact('exam', 'courses', 'batches'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Exam $exam)
    {

        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'batch_id' => 'required|exists:batches,id',
            'exam_name' => 'required|string',
            'status' => 'nullable|boolean',
            'exam_date' => 'nullable|date|after_or_equal:today',
        ]);
        $exam->update($request->all());

        return redirect()->route('exam.show', ['exam' => $exam->id])->with('success', 'exam question updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exam $exam)
    {
        $exam->delete();
        return redirect()->route('exam.show')->with('success', 'exam deleted successfully');
    }
}
