<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{

    public function index(){
        $data['students'] = User::where('isAdmin',false)->paginate(10);
        return view('admin.students.manage',$data);
    }
    public function searchCourse(Request $request){
        $search = $request->search;
        $students = User::whereLike('title', "%$search%")->paginate(10);
        return view("admin.students.manage",['students' => $students]);
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

    public function edit($id){
        $student = User::find($id);
        $courses = Course::where('published',true)->get();
        $paymentsGroupedByCourse = $student->payments->groupBy('course_id');

        return view('admin.students.edit',compact('student','courses','paymentsGroupedByCourse'));
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
    

    public function dashboard(){

        $studentId = User::findOrFail(Auth::id())->id;
        $datas = [
            'courses' => User::find(Auth::id())->courses()->get(),
            'payments' => Payment::where('student_id',$studentId)->orderBy('created_at', 'ASC')->get(),
        ];
        return view('student.dashboard', $datas);
    }
   
}
