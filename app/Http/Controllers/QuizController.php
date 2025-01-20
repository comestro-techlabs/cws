<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Course;
use App\Models\Exam;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $exams = Exam::all();
        return view('admin.quiz.create_quiz',compact('exams'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([

            'exam_id' =>'required|exists:exams,id',
            'question' => 'required|string',
            'option1' => 'required|string',
            'option2' => 'required|string',
            'option3' => 'required|string',
            'option4' => 'required|string',
            'correct_answer' => 'required|in:option1,option2,option3,option4',
            'status' => 'nullable|boolean',
        ]);

        Quiz::create($request->all());
        return redirect()->route('quiz.create')->with('success', 'Quiz question added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request )
    {
        $query = Quiz::with('exam');

        // Search functionality
        if ($request->has('search')) {
            $query->where('question', 'like', '%' . $request->input('search') . '%');
        }

        $quizzes = $query->paginate(10);

        return view('admin.quiz.show_quiz', compact('quizzes'));
  
    }

    public function toggleStatus(Request $request, Quiz $quiz)
    {
        $quiz->status = !$quiz->status;
        $quiz->save();

        return redirect()->back()->with('success', 'Quiz status updated successfully!');
    }


    public function view(Quiz $quiz){
        return view('admin.quiz.view_quiz',compact('quiz'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Quiz $quiz)
    {
        $exams = Exam::all();
        return view('admin.quiz.edit_quiz', compact('quiz', 'exams'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Quiz $quiz)
    {
        $request->validate([
         'exam_id' =>'required|exists:exams,id',
            'question' => 'required|string',
            'option1' => 'required|string',
            'option2' => 'required|string',
            'option3' => 'required|string',
            'option4' => 'required|string',
            'correct_answer' => 'required|in:option1,option2,option3,option4',
            'status' => 'nullable|boolean',
            'time' => 'required|date_format:H:i:s',
        ]);

        $quiz->update($request->all());

        return redirect()->route('quiz.show', ['quiz' => $quiz->id])->with('success', 'Quiz question updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quiz $quiz)
    {
        $quiz->delete();
        return redirect()->route('quiz.show')->with('success','Quiz deleted successfully');
    }


    

    public function results(Quiz $quiz)
    {
        dd($quiz);
        $answers = Answer::with('user')
        ->where('quiz_id', $quiz->id)
        ->get();

        return view('admin.quiz.result', compact('quiz', 'answers'));
    }

}
