<?php

namespace App\Http\Controllers;

use App\Models\Assignment_upload;
use App\Models\Assignments;
use App\Models\Course;
use App\Models\Payment;
use App\Models\User;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

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

    public function coursePurchase()
    {
        $studentId = User::findOrFail(Auth::id())->id;
        $data = [

            'courses' => User::find(Auth::id())->courses()->get(),
        ];
        return view('studentDashboard.course.purchaseCourse', $data);
    }
    public function course()
    {
        $studentId = User::findOrFail(Auth::id())->id;

        $data = [
            'courses' => Course::paginate(4),
        ];
        return view('studentDashboard.course.course', $data);
    }


    public function billing()
    {

        $studentId = User::findOrFail(Auth::id())->id;
        $datas = [
            'courses' => User::find(Auth::id())->courses()->get(),
            'payments' => Payment::where('student_id', $studentId)->orderBy('created_at', 'ASC')->get(),
        ];
        return view("studentdashboard.billing",$datas);
    }
    
    public function quiz(){
        
    // $studentId = Auth::id(); // Get the logged-in student's ID
    
    // // Fetch the courses the student is enrolled in
    // $courses = User::findOrFail($studentId)->courses()->get();
    
    // // Fetch quizzes related to the student's courses
    // $quizzes = Quiz::whereIn('course_id', $courses->pluck('id'))->get();

    // // Pass the data to the view
    // $data = [
    //     'courses' => $courses,
    //     'quizzes' => $quizzes,
    //     'payments' => Payment::where('student_id', $studentId)->orderBy('created_at', 'ASC')->get(),
    // ];

    return view("studentdashboard.quiz");

    }
    // public function buyCourse($id){
    //     $data['course']= Course::findOrFail($id);
        
    //     return view("studentDashboard.course.viewCourse",$data);
    //     return view("studentdashboard.billing", $datas);
    // }
    public function buyCourse($id)
    {
        $studentId = User::findOrFail(Auth::id())->id;

        $data['course'] = Course::findOrFail($id);

        return view("studentDashboard.course.viewCourse", $data);
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
    public function assignmentupload()
    {
        $studentId = Auth::id(); // Logged-in user's ID

        $assignments = Assignments::whereHas('course', function ($query) use ($studentId) {
            $query->whereHas('students', function ($q) use ($studentId) {
                $q->where('user_id', $studentId);
            });
        })->get();

        // Return assignments to the view
        return view('studentDashboard.assignments.studentAssignment', ['assignments' => $assignments]);
    }
    // private function token()
    // {
    //     $client_id = \config('services.google.client_id');
    //     $client_secret = \config('services.google.client_secret');
    //     $refresh_token = \config('services.google.refresh_token');
    //     $response = Http::post('https://oauth2.googleapis.com/token', [
    //         'client_id' => $client_id,
    //         'client_secret' => $client_secret,
    //         'refresh_token' => $refresh_token,
    //         'grant_type' => 'refresh_token',

    //     ]);
    //     // dd($response);

    //     $accessToken = json_decode((string)$response->getBody(), true)['access_token'];
    //     return $accessToken;
    // }
    // public function store(Request $request)
    // {
    //     $validation = $request->validate([
    //         'file_path' => 'file|required',
    //     ]);
    //     $accessToken = $this->token();
    //     // dd($accessToken);

    //     $mime = $request->file_path->getClientMimeType();
    //     // $path = $request->file_path->getRealPath();
    //     // dd($path);

    //     // $response=Http::withToken($accessToken)
    //     // ->attach('data',file_get_contents($path))
    //     // ->post('https://www.googleapis.com/upload/drive/v3/files',
    //     // [
    //     //     'content-Type'=>'application/octet-stream',
    //     // ]
    //     // );
    //     $response = Http::withHeaders([
    //         'authorization' => 'Bearer ' . $accessToken,
    //         'Content-Type' => 'Application/json',
    //     ])->post('https://www.googleapis.com/drive/v3/files', [

    //         'mimeType' => $mime,
    //         'uploadType' => 'resumable',
    //         'parents' => [\config('services.google.folder_id')],
    //     ]);

    //     if ($response->successful()) {
    //         $file_id = json_decode($response->body())->id;

    //         $uploadedFile = new Assignment_upload();
    //         $uploadedFile->student_id = auth()->id();
    //         // $uploadedFile->assignment_id = $assignmentId; 
    //         $uploadedFile->file_path = $file_id;
    //         $uploadedFile->submitted_at = now();
    //         $uploadedFile->status = 'submitted';
    //         $uploadedFile->save();
    //         return response('file uploaded to google drive');
    //     } else {
    //         return response('failed to  uploaded to google drive ');
    //     }
    // }
    private function token()
{
    $client_id = config('services.google.client_id');
    $client_secret = config('services.google.client_secret');
    $refresh_token = config('services.google.refresh_token');
 
    $response = Http::post('https://oauth2.googleapis.com/token', [
        'client_id' => $client_id,
        'client_secret' => $client_secret,
        'refresh_token' => $refresh_token,
        'grant_type' => 'refresh_token',
    ]);
 
    if ($response->successful()) {
        return json_decode($response->body(), true)['access_token'];
    }
 
    throw new \Exception('Failed to fetch access token');
}
 
public function store(Request $request)
{
    $validation = $request->validate([
        'file_path' => 'file|required',
        'assignment_id' => 'required',

    ]);
 
    $accessToken = $this->token();
 
    $file = $request->file('file_path');
    $mimeType = $file->getMimeType();
    $fileName = $file->getClientOriginalName();
    $fileContent = file_get_contents($file->getRealPath());
 
    // Step 1: Metadata request
    $metadataResponse = Http::withHeaders([
        'Authorization' => 'Bearer ' . $accessToken,
        'Content-Type' => 'application/json',
    ])->post('https://www.googleapis.com/upload/drive/v3/files?uploadType=resumable', [
        'name' => $fileName,
        'mimeType' => $mimeType,
        'parents' => [config('services.google.folder_id')],
    ]);
 
    if (!$metadataResponse->successful()) {
        return response('Failed to initialize upload', 500);
    }
 
    $uploadUrl = $metadataResponse->header('Location');
 
    // Step 2: Upload file content
    $uploadResponse = Http::withHeaders([
        'Authorization' => 'Bearer ' . $accessToken,
        'Content-Type' => $mimeType,
    ])->withBody($fileContent, $mimeType)->put($uploadUrl);
 
    if ($uploadResponse->successful()) {
        $fileId = json_decode($uploadResponse->body())->id;
 
        $uploadedFile = new Assignment_upload();
        $uploadedFile->student_id = auth()->id();
        $uploadedFile->file_path = $fileId;
        $uploadedFile->assignment_id = $request->assignment_id;
        $uploadedFile->submitted_at = now();
        $uploadedFile->status = 'submitted';
        $uploadedFile->save();
 
        return response('File uploaded to Google Drive', 200);
    } else {
        return response('Failed to upload file to Google Drive', 500);
    }
}
}
