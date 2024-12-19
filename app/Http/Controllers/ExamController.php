<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Course;
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
        ]);

        Exam::create($request->all());
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

    public function toggleStatus(Request $request, Exam $exam)
    {
        $exam->status = !$exam->status;
        $exam->save();

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
