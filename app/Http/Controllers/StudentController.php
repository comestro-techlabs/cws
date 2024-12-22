<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Course;
use App\Models\Payment;
use App\Models\User;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{

    public function index()
    {
        $data['students'] = User::where('isAdmin', false)->paginate(10);
        return view('admin.students.manage', $data);
    }
    public function searchCourse(Request $request)
    {
        $search = $request->search;
        $students = User::whereLike('title', "%$search%")->paginate(10);
        return view("admin.students.manage", ['students' => $students]);
    }

    public function assignCourse(Request $request, $studentId)
    {
        $student = User::findOrFail($studentId);

        // Validate the request
        $request->validate([
            'course_id' => 'required|exists:courses,id',
        ]);

        // Check if the course is already assigned to the student
        if ($student->courses()->where('course_id', $request->input('course_id'))->exists()) {
            return redirect()->back()->with('error', 'This course is already assigned to the student.');
        }

        // Attach the course to the student
        $student->courses()->attach($request->input('course_id'));

        Payment::create([
            'student_id' => $studentId,
            'course_id' => $request->input('course_id'),
            'amount' => 0,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Course assigned successfully! & Payment Generated Success');
    }




    public function removeCourse(User $student, Course $course)
    {
        $student->courses()->detach($course->id);

        return redirect()->back()->with('success', 'Course removed successfully!');
    }

    public function edit($id)
    {
        // Retrieve the student by ID
        $student = User::findOrFail($id);

        // Retrieve only successful payments and load related course data
        // Assuming 'completed' means successful payment
        $purchasedCourses = Payment::with('course') // Eager load the course details
            ->where('student_id', $id)
            ->where('payment_status', 'captured') // Filter for successful payments
            ->get();

        // Group payments by course if needed
        $paymentsGroupedByCourse = Payment::where('student_id', $id)
            ->where('payment_status', 'captured') // Filter for successful payments
            // ->groupBy('course_id')
            ->get();

        // Pass the data to the view
        return view('admin.students.edit', compact('student', 'purchasedCourses', 'paymentsGroupedByCourse'));
    }



    public function update(Request $request, $id, $field)
    {
        $student = User::findOrFail($id);

        // Define validation rules
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'contact' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'dob' => 'nullable|date',
        ];

        // Validate the specific field being updated
        $validatedData = $request->validate([
            $field => $rules[$field]
        ]);

        // Handle file upload if updating the profile_image

        $student->$field = $request->input($field);


        // Save the student with the updated field
        $student->save();


        return redirect()->route('student.edit', $student->id)->with('success', ucfirst($field) . ' updated successfully!');
    }


    // public function dashboard()
    // {

    //     $studentId = User::findOrFail(Auth::id())->id;
    //     $datas = [
    //         'courses' => User::find(Auth::id())->courses()->get(),
    //         'payments' => Payment::where('student_id', $studentId)->orderBy('created_at', 'ASC')->get(),
    //     ];
    //     return view('student.dashboard');
    // }

    public function dashboard()
    {

        $studentId = User::findOrFail(Auth::id())->id;
        $datas = [
            'courses' => User::find(Auth::id())->courses()->get(),
            'payments' => Payment::where('student_id', $studentId)->orderBy('created_at', 'ASC')->get(),
        ];
        return view('studentDashboard.dashboard');
    }

    public function coursePurchase(){
        $studentId = User::findOrFail(Auth::id())->id;
        $data = [
            
            'courses' => User::find(Auth::id())->courses()->get(),
        ];
        return view('studentDashboard.course.purchaseCourse',$data);
    }
    public function course(){
        $data = [
            'courses' => Course::paginate(4),
        ];
        return view('studentDashboard.course.course',$data);
    }
    

    public function billing(){
        $studentId = User::findOrFail(Auth::id())->id;
        $datas = [
            'courses' => User::find(Auth::id())->courses()->get(),
            'payments' => Payment::where('student_id', $studentId)->orderBy('created_at', 'ASC')->get(),
        ];
        return view("studentdashboard.billing",$datas);
    }
    
    public function showquiz()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
    
        $user = Auth::user();
    
        $courses = $user->courses()->with([
            'exams' => function ($query) {
                $query->where('status', true);
            },
            'exams.quizzes' => function ($query) {
                $query->where('status', true);
            }
        ])->get();
    
    // dd($courses);

    return view("studentdashboard.quiz", compact('courses'));
    }

    public function storeAnswer(Request $request)
    {
        $total_marks = 0;
        $obtained_marks = 0;
    
        // Loop through each answer to calculate marks
        foreach ($request->selected_option as $quiz_id => $selected_option) {
            $quiz = Quiz::find($quiz_id);
            
            if ($quiz) {
                // Check if the answer is correct
                if ($selected_option == $quiz->correct_answer) {
                    $obtained_marks += $quiz->marks;
                }
                // Optionally store the student's answer in the database (Answer table)
                $answerRecord = new Answer();
                $answerRecord->user_id = Auth::id();
                $answerRecord->quiz_id = $quiz_id;
                $answerRecord->selected_option = $selected_option;
                $answerRecord->obtained_marks = ($selected_option == $quiz->correct_answer) ? $quiz->marks : 0;
                $answerRecord->save();
            }
        }
    
        // Store the total obtained marks in the session
        session()->flash('obtained_marks', $obtained_marks);

        return redirect()->route('student.quiz')->with('success', 'Answer submitted successfully!');
    }

    public function buyCourse($id){
        $data['course']= Course::findOrFail($id);
        
        return view("studentDashboard.course.viewCourse",$data);
    }
    public function editProfile()
    {
        $student = Auth::user();
        return view('studentdashboard.edit_profile', compact('student'));
    }


    public function updateProfile(Request $request)
    {
        $student = Auth::user(); 
        $data = [
            'name' => 'required|string|max:255',       
            'contact' => 'nullable|string|max:20',
            'dob' => 'nullable|date',
            'gender' => 'required|in:male,female,other',
            'password' => 'required|string|min:8',
            'education_qualification' => 'nullable|string|max:255',
        ];

        $validatedData = $request->validate($data);

        $student->update($validatedData);

        return redirect()->route('student.editProfile')->with('success', 'Profile updated successfully!');
    }



}