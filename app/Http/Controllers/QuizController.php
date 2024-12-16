<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = Course::all();
        return view('admin.quiz.create_quiz', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([

            'course_id' =>'required|exists:courses,id',
            'question' => 'required|string',
        ]);

        $quiz = new Quiz();
        $quiz->course_id = $request->input('course_id');
        $quiz->question = $request->input('question');
        $quiz->save();

     

        return redirect()->route('quiz.show',$quiz->course_id)->with('success', 'Quiz question added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Quiz $quiz )
    {
        $quizzes = Quiz::with('course')->get(); 
        return view('admin.quiz.show_quiz', compact('quizzes'));

      
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Quiz $quiz)
    {
        $courses = Course::all();
        return view('admin.quiz.edit_quiz',compact('quiz','courses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Quiz $quiz)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'question' => 'required|string',
        ]);

        $quiz->course_id = $request->input('course_id');
        $quiz->question = $request->input('question');
        $quiz->save();

        return redirect()->route('quiz.show')->with('success','Quiz upadted successfullyy');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quiz $quiz)
    {
        $quiz->delete();
        return redirect()->route('quiz.show')->with('success','Quiz deleted successfully');
    }
}
