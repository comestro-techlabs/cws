<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Course;
use App\Models\Quiz;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $courses = Course::all();
        return view('admin.exam.create_exam', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'course_id'=>'required|exists:courses,id',
            'exam_name'=> 'required|string',
            'status' => 'nullable|boolean',
            'exam_date' => 'nullable|date',
        ]);

       $exam = Exam::create($request->all());

        if($exam->status ==1 && Quiz::where('exam_id',$exam->id)->count() >=3){
            $users = User::whereHas('courses', function ($query) use ($exam){
                $query->where('course_id',$exam->course_id);
            })->get();
            foreach($users as $user){
                Mail::send('emails.exam_notification',['user' => $user, 'exam'=>$exam],
                function ($message) use ($user){$message->to($user->email,$user->name)->subject('New Exam Available');
            });

        }
    }
        return redirect()->route('exam.create')->with('success','your exam inserted successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request )
    {
        //
        $query = Exam::with('course');

        // Search functionality
        if ($request->has('search')) {
            $query->where('exam_name', 'like', '%' . $request->input('search') . '%');
        }

        $exams = $query->paginate(10);

        return view('admin.exam.manage_exam', compact('exams'));
    }

    public function showQuestions(Exam $exam){
        $examId=$exam->id;
        $exam_name=$exam->exam_name;
        $course_title=$exam->course->title;
        // dd($exam->course->title);
        $quizQuestions = Quiz::where('exam_id',$examId)->get();
        return view('admin.exam.view_questions', compact('quizQuestions','exam_name','course_title'));
    }

    public function toggleStatus(Request $request, Exam $exam)
    {
        $exam->status = !$exam->status;
        $exam->save();

        if($exam->status ==1 && Quiz::where('exam_id',$exam->id)->count() >=3){
            $users = User::whereHas('courses', function ($query) use ($exam){
                $query->where('course_id',$exam->course_id);
            })->get();
            foreach($users as $user){
                Mail::send('emails.exam_notification',['user' => $user, 'exam'=>$exam],
                function ($message) use ($user){$message->to($user->email,$user->name)->subject('New Exam Available');
            });

        }
    }
        
        return redirect()->back()->with('success', 'Exam status updated successfully!');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Exam $exam)
    {
        $courses = Course::all();
        return view('admin.exam.edit_exam', compact('exam', 'courses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Exam $exam)
    {
        
        $request->validate([
            'course_id'=>'required|exists:courses,id',
            'exam_name'=> 'required|string',
            'status' => 'nullable|boolean',
            'exam_date' => 'nullable|date',
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
        return redirect()->route('exam.show')->with('success','exam deleted successfully');
    }
}
