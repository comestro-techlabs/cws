<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Assignment_upload;
use App\Models\Assignments;
use App\Models\Course;
use App\Models\Payment;
use App\Models\User;
use App\Models\Quiz;
use App\Models\ExamUser;
use App\Models\Workshop;
use App\Models\Batch;
use App\Services\PaymentService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Http;


class StudentController extends Controller
{
    protected $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }


    public function index(Request $request){
        $query =user::where('isAdmin',false);
        if($request->has('filter')){
            $filter =$request->filter;
            if ($filter == 'member') {
                $query->where('is_member', 1);
            } elseif ($filter == 'user') {
                $query->where('is_member', 0);
            } elseif ($filter == 'status_active') {
                $query->where('is_active', 1); 
            } elseif ($filter == 'status_inactive') {
                $query->where('is_active', 0); 
            }
        }
    
    
        $data['students'] = $query->paginate(10);
        return view('admin.students.manage', $data);

        
    }
    public function search(Request $request)
    {
        $search = $request->search;
        $students = User::whereLike('name', "%$search%")
            ->orWhere('email', 'LIKE', "%$search%")
            ->paginate(10);
        return view("admin.students.manage", ['students' => $students]);
    }
    public function searchCourse(Request $request)
    {
        $search = $request->search;
        $students = User::whereLike('title', "%$search%")->paginate(10);
        return view("admin.students.manage", ['students' => $students]);
    }
    public function assignCourse(Request $request, $studentId)
    {
        if (!Auth::check()) {
            return redirect()->route('auth.login')->with('error', 'you must be logged in to access this page');
        }
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
        if (!Auth::check()) {
            return redirect()->route('auth.login')->with('error', 'you must be logged in to access this page');
        }
        $student->courses()->detach($course->id);

        return redirect()->back()->with('success', 'Course removed successfully!');
    }

    public function edit($id)
    {
        if (!Auth::check()) {
            return redirect()->route('auth.login')->with('error', 'you must be logged in to access this page');
        }
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
        if (!Auth::check()) {
            return redirect()->route('auth.login')->with('error', 'you must be logged in to access this page');
        }
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

    public function dashboard()
    {
        if (!Auth::check()) {
            return redirect()->route('auth.login')->with('error', 'You must be logged in to access this page');
        }

        $studentId = User::findOrFail(Auth::id())->id;
        $hasCompleted = $this->hasCompletedExamOrAssignment($studentId);

        // Get the first and second attempts
        $firstAttempts = Answer::where('user_id', $studentId)
            ->where('attempt', 1)
            ->with('exam')
            ->get()
            ->groupBy('exam_id')
            ->map(function ($answers) {
                return [
                    'exam_name' => $answers->first()->exam->exam_name,
                    'total_marks' => $answers->sum('obtained_marks'),
                ];
            });

        $secondAttempts = Answer::where('user_id', $studentId)
            ->where('attempt', 2)
            ->with('exam')
            ->get()
            ->groupBy('exam_id')
            ->map(function ($answers) {
                return [
                    'exam_name' => $answers->first()->exam->name,
                    'total_marks' => $answers->sum('obtained_marks'),
                ];
            });

        // Fetch user courses, payments, assignments, and exams
        $user = User::find(Auth::id());

        $courses = $user->courses()->take(2)->get();
        $payments = Payment::where('student_id', $studentId)->where('course_id', '!=', null)->orderBy('created_at', 'ASC')->with('course')->get();
        $assignments = Assignments::whereIn('course_id', $user->courses->pluck('id'))->latest()->take(4)->get();
        $exams = ExamUser::whereIn('exam_id', $user->courses->pluck('id'))->take(4)->get();

        // Calculate progress for each payment
        foreach ($payments as $payment) {
            $payment->progress = $payment->course_progress; // Access the computed attribute
        }

        // Prepare data for the view
        $datas = [
            'hasCompleted' => $hasCompleted,
            'courses' => $courses,
            'payments' => $payments,
            'assignments' => $assignments,
            'exams' => $exams,
            'first_attempts' => $firstAttempts,
            'second_attempts' => $secondAttempts,
        ];

        return view('studentdashboard.dashboard', $datas);
    }

    public function coursePurchase()
    {
        if (!Auth::check()) {
            return redirect()->route('auth.login')->with('error', 'You must be logged in to access this page');
        }
        $user = Auth::user();
        $courses = $user->courses()->with(['batches'])->get();
        $coursesWithoutBatch = $courses->filter(function ($course) use ($user) {
            $pivotData = $course->pivot;
            return empty($pivotData->batch_id);
        });

        return view('studentdashboard.course.purchaseCourse', [
            'courses' => $courses,
            'coursesWithoutBatch' => $coursesWithoutBatch,
        ]);
    }

    public function updateBatch(Request $request, $courseId)
    {
        $request->validate([
            'batch_id' => 'required|exists:batches,id',
        ]);
        $user = auth()->user();
        $course = Course::findOrFail($courseId);
        $course->users()->updateExistingPivot($user->id, [
            'batch_id' => $request->batch_id,
        ]);

        return redirect()->back()->with('success', 'Batch updated successfully!');
    }
    public function course()
    {
        $userId = auth()->id();

        $enrolledCourses = DB::table('course_user')
            ->where('user_id', $userId)
            ->pluck('course_id');
        $data = [
            'courses' => Course::whereNotIn('id', $enrolledCourses)->paginate(4),
        ];

        return view('studentdashboard.course.course', $data);
    }
    public function enrollCourse($courseId)
    {
        $user = auth()->user();
        if (!$user->is_active) {
            return redirect()->back()->with('error', 'Your account is inactive. Please contact support.');
        }

        $coursesWithoutBatch = $user->courses()->wherePivot('batch_id', null)->exists();

        if ($coursesWithoutBatch) {
            return redirect()->back()->with('error', 'Please update the batch for your existing course before enrolling in a new one.');
        }
        if ($user->courses()->where('course_id', $courseId)->exists()) {
            return redirect()->back()->with('error', 'You are already enrolled in this course.');
        }

        if ($user->is_member) {
            $activeFreeCourse = $user->courses()
                ->whereHas('batches', function ($query) {
                    $query->whereDate('end_date', '>=', now());
                })
                ->withPivot('batch_id')
                ->get()
                ->pluck('pivot.batch_id')
                ->filter()
                ->isNotEmpty();

            if ($activeFreeCourse) {
                // Redirect the member to payment if they have an ongoing free course
                return redirect()->route('student.buyCourse', ['id' => $courseId])
                    ->with('error', 'You can only have one active free course at a time. Complete your current course before enrolling in another for free. You can buy this course now.');
            }

            // Find an active batch for the course the member wants to enroll in
            $batch = Batch::where('course_id', $courseId)
                ->whereDate('end_date', '>=', now())
                ->first();

            if (!$batch) {
                return redirect()->back()->with('error', 'No active batch available for this course.');
            }
            $user->courses()->attach($courseId);
        } else {
            return redirect()->route('student.buyCourse', ['id' => $courseId]);
        }

        return redirect()->route('student.dashboard')->with('success', 'You have successfully enrolled in the course.');
    }
    public function billing()
    {
        if (!Auth::check()) {
            return redirect()->route('auth.login')->with('error', 'You must be logged in to access this page');
        }
        $studentId = Auth::id();
        $user = User::where('id', $studentId)->first();

        $hasCompleted = $this->hasCompletedExamOrAssignment($studentId);
        $today = Carbon::now(); // Define the current date
        // $today =\Carbon\Carbon::parse('2025-07-15 00:00:00');
        $payments = Payment::where('student_id', $studentId)->orderBy('created_at', 'ASC')->get();

        $paymentsWithWorkshops = $payments->map(function ($payment) use ($today, $user) { // Pass $today inside use()
            $workshopTitle = null;

            // Check if the payment has a workshop_id and fetch the workshop title
            if ($payment->workshop_id) {
                $workshop = Workshop::find($payment->workshop_id);
                $workshopTitle = $workshop ? $workshop->title : null;
            }

            // Update status to "due" if unpaid and past due date
            if ($payment->status === 'unpaid' && Carbon::parse($payment->transaction_date)->lt($today)) {
                $payment->status = 'due';
                $payment->save();

                if ($user) {
                    $user->is_active = 0;
                    $user->save();
                }
            }
            $payment->workshop_title = $workshopTitle;
            return $payment;
        });



        $courses = User::find($studentId)->courses()->get();

        $overdueCount = $this->paymentService->processOverduePayments();
        
        return view('studentdashboard.billing', compact('hasCompleted', 'courses', 'paymentsWithWorkshops','overdueCount'));
    }

    public function viewbilling()
    {
        if (!Auth::check()) {
            return redirect()->route('auth.login')->with('error', 'you must be logged in to access this page');
        }
        $studentId = User::findorFail(Auth::id())->id;

        $datas = [
            'courses' => User::find(Auth::id())->courses()->get(),
            'payments' => Payment::where('student_id', $studentId)->orderBy('created_at', 'ASC')->get(),
        ];
        return view("studentdashboard.viewbilling", $datas);
    }


    public function courseQuiz()
    {
        if (!Auth::check()) {
            return redirect()->route('auth.login')->with('error', 'You must be logged in to access this page');
        }

        $user = Auth::user();

        // Get the batch IDs for the courses the user is enrolled in
        $batchIds = DB::table('course_user')
            ->where('user_id', $user->id)
            ->pluck('batch_id', 'course_id'); // Fetch batch_id mapped by course_id

        // Fetch courses and filter exams based on the user's batch
        $courses = $user->courses()
            ->with([
                'users',
                'exams' => function ($query) use ($batchIds) {
                    $query->whereIn('batch_id', $batchIds); // Only show exams for the user's batch
                }
            ])
            ->get();

        return view('studentdashboard.quiz.course', compact('courses'));
    }


    public function showquiz($courseId)
    {
        if (!Auth::check()) {
            return redirect()->route('auth.login');
        }

        $user = Auth::user();
        $courses = $user->courses()->where('courses.id', $courseId)->with([
            'exams' => function ($query) {
                $query->where('status', true);
            },
            'exams.quizzes' => function ($query) {
                $query->where('status', true);
            }
        ])->first();

        if (!$courses) {
            return redirect()->route('student.course.quiz')->with('error', 'Course not found or you do not have access to it.');
        }

        // Check if the user has already attempted the exam more than 2 times
        $attempt = ExamUser::where('user_id', $user->id)
            ->whereHas('exam', function ($query) use ($courseId) {
                $query->where('course_id', $courseId);
            })
            ->first();

        $value = $attempt ? $attempt->attempts : 0;

        // Allow a maximum of 2 attempts
        if ($value >= 2) {
            return redirect()->route('student.course.quiz')->with('error', 'You have reached the maximum number of attempts.');
        }

        // Fetch quizzes and check if there are enough questions
        $quizzes = $courses->exams->flatMap(function ($exam) {
            return $exam->quizzes->where('status', true);
        })->shuffle()->take(10);



        return view("studentdashboard.quiz.quiz", compact('courses', 'quizzes'));
    }

    public function storeAnswer(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('auth.login')->with('error', 'you must be logged in to access this page');
        }
        $total_marks = 0;
        $obtained_marks = 0;

        $exam_user = ExamUser::where('user_id', Auth::id())
            ->where('exam_id', $request->exam_id)
            ->first();

        if ($exam_user) {
            $exam_user->attempts += 1;
        } else {
            $exam_user = ExamUser::create([
                "user_id" => Auth::id(),
                "exam_id" => $request->exam_id,
                "attempts" => 1,
            ]);
        }

        // Store the attempt count in the answers table
        $current_attempt = $exam_user->attempts;

        if ($request->selected_option) {
            foreach ($request->selected_option as $quiz_id => $selected_option) {
                $quiz = Quiz::find($quiz_id);

                if ($quiz) {
                    $total_marks += $quiz->marks;

                    if ($selected_option == $quiz->correct_answer) {
                        $obtained_marks += $quiz->marks;
                    }

                    Answer::create([
                        'user_id' => Auth::id(),
                        'quiz_id' => $quiz_id,
                        'exam_id' => $request->exam_id,
                        'selected_option' => $selected_option,
                        'obtained_marks' => ($selected_option == $quiz->correct_answer) ? $quiz->marks : 0,
                        'attempt' => $current_attempt,  // Store the current attempt number
                    ]);
                }
            }

            // Update total marks for the exam user
            $exam_user->total_marks = $obtained_marks;
            $exam_user->save();

            session()->flash('obtained_marks', $obtained_marks);
            session()->flash('exam_id', $request->exam_id);

            return redirect()->route('student.examResult', $request->exam_id)->with([
                'success' => 'Answer submitted successfully!',
                'exam_id' => $request->exam_id,
            ]);
        } else {
            return redirect()->route('student.examResult', $request->exam_id)->with([
                'success' => 'Answer submitted successfully!',
                'exam_id' => $request->exam_id,
            ]);
        }
    }
    public function showResults($exam_id)
    {
        if (!Auth::check()) {
            return redirect()->route('auth.login')->with('error', 'you must be logged in to access this page');
        }
        $user = Auth::user();

        $results = Answer::where('user_id', $user->id)
            ->where('exam_id', $exam_id)
            ->get();

        $exam_user = ExamUser::where('user_id', $user->id)
            ->where('exam_id', $exam_id)
            ->first();

        if (!$exam_user) {
            return redirect()->route('student.showquiz')->with('error', 'No attempt found for this exam.');
        }

        $totalMarks = $exam_user->total_marks;
        $attempt = $exam_user->attempts;

        return view('studentdashboard.quiz.results', compact('results', 'totalMarks', 'attempt'));
    }

    public function courseResult()
    {
        if (!Auth::check()) {
            return redirect()->route('auth.login')->with('error', 'you must be logged in to access this page');
        }
        $user = Auth::user();
        $courses = $user->courses()->with('users')->get();

        return view('studentdashboard.quiz.course', compact('courses'));
    }
    public function showAllAttempts($course_id)
    {
        if (!Auth::check()) {
            return redirect()->route('auth.login')->with('error', 'you must be logged in to access this page');
        }
        $user_id = Auth::id();

        // Get all exams related to the selected course
        $course = Course::with('exams')->findOrFail($course_id);
        $exam_ids = $course->exams->pluck('id');

        // Retrieve all answers for the user and exams in the selected course, grouped by attempts
        $attempts = Answer::where('user_id', $user_id)
            ->whereIn('exam_id', $exam_ids)
            ->orderBy('attempt')
            ->get()
            ->groupBy('attempt');

        // Calculate total marks for each attempt
        $attempts_data = [];
        foreach ($attempts as $attempt => $answers) {
            $total_marks = $answers->sum('obtained_marks');
            $attempts_data[] = [
                'attempt' => $attempt,
                'total_marks' => $total_marks,
            ];
        }

        return view('studentdashboard.quiz.all_attempts', compact('attempts_data', 'course'));
    }


    public function buyCourse($id)
    {
        if (!Auth::check()) {
            return redirect()->route('auth.login')->with('error', 'you must be logged in to access this page');
        }

        $course = Course::findOrFail($id);
        $course_id = $course->id;

        $payment_exist = Payment::where("student_id", Auth::id())->where("course_id", $course_id)->where("status", "captured")->exists();

        return view("studentdashboard.course.viewCourse", compact('course', 'payment_exist'));
    }
    public function editProfile()
    {
        $student = Auth::user();
        return view('studentdashboard.edit_profile', compact('student'));
    }


    public function updateProfile(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('auth.login')->with('error', 'you must be logged in to access this page');
        }
        $student = Auth::user();
        $data = [
            'name' => 'required|string|max:255',
            // 'email' => 'required|string|email|unique:users,email,' . $request->id . ',id',
            'contact' => 'required|digits:10',
            'gender' => 'required|in:male,female,other',
            'education_qualification' => 'required|in:BCA,MCA,BBA,B.COM,other',
            'dob' => 'required|date|before_or_equal:today',
        ];

        $validatedData = $request->validate($data);

        $student->update($validatedData);

        return redirect()->route('student.editProfile')->with('success', 'Profile updated successfully!');
    }

    public function assignmentList()
    {
        if (!Auth::check()) {
            return redirect()->route('auth.login')->with('error', 'You must be logged in to access this page');
        }

        $studentId = Auth::id();

        // Get the batch IDs for the courses the student is enrolled in
        $studentBatches = DB::table('course_user')
            ->where('user_id', $studentId)
            ->pluck('batch_id', 'course_id'); // Fetch batch_id mapped by course_id

        // Fetch courses and filter assignments based on the student's batch
        $data['courses'] = Course::whereHas('students', function ($query) use ($studentId) {
            $query->where('user_id', $studentId);
        })
            ->with([
                'assignments' => function ($query) use ($studentBatches) {
                    $query->where('status', 1)
                        ->whereIn('batch_id', $studentBatches); // Only show assignments for the student's batch
                },
                'assignments.uploads' => function ($query) use ($studentId) {
                    $query->where('student_id', $studentId); // Include uploads specific to the student
                }
            ])
            ->get();

        return view('studentdashboard.assignments.manageAssignments', $data);
    }



    public function viewAssignments($id)
    {
        if (!Auth::check()) {
            return redirect()->route('auth.login')->with('error', 'you must be logged in to access this page');
        }
        $studentId = Auth::id(); // Logged-in user's ID

        // Find the assignment with a relationship check for the student's course
        $assignment = Assignments::where('id', $id)
            ->whereHas('course', function ($query) use ($studentId) {
                $query->whereHas('students', function ($q) use ($studentId) {
                    $q->where('user_id', $studentId);
                });
            })->first();

        // Check if the assignment exists
        if (!$assignment) {
            return redirect()->back()->with('error', 'Assignment not found or access denied.');
        }

        // Check if the file has already been uploaded
        $uploadedFile = Assignment_upload::where('student_id', $studentId)
            ->where('assignment_id', $id)
            ->first();

        // Return assignment and uploaded file details to the view
        return view('studentdashboard.assignments.studentAssignment', [
            'assignment' => $assignment,
            'uploadedFile' => $uploadedFile,
        ]);
    }


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

    public function store(Request $request, $assignment_id)
    {
        $validation = $request->validate([
            'file_path' => 'file|required',
            'assignment_id' => 'required|exists:assignments,id',

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

            return redirect()->back()->with('msg', 'upload file to Google Drive successfully');
        } else {
            return response('Failed to upload file to Google Drive', 500);
        }
    }

    public function showCertificate($userId)
    {


        $user = User::find($userId);
        if (!$user) {
            return redirect()->route('student.dashboard')->with('error', 'User not found.');
        }

        $course = $user->courses()->first();
        $courseCode = $course ? $course->course_code : 'N/A';

        $examUser = ExamUser::where('user_id', $userId)->first();
        $examTotal = $examUser ? $examUser->total_marks : 0;
        $assignmentTotal = Assignment_upload::where('student_id', $userId)->sum('grade') ?? 0;

        $examName = $examUser ? $examUser->exam->exam_name : 'N/A';
        $maxAssignmentMarks = 100;
        $maxExamMarks = 20;


        $assignmentPercentage = ($assignmentTotal / $maxAssignmentMarks) * 100;
        $examPercentage = ($examTotal / $maxExamMarks) * 100;
        $percentage = ($assignmentPercentage + $examPercentage) / 2;

        $date = now()->toFormattedDateString();
        $year = now()->year;

        $certificateNumber = str_pad($userId, 4, '0', STR_PAD_LEFT);


        return view('studentdashboard.certificate.viewCertificate', compact(
            'user',
            'percentage',
            'assignmentPercentage',
            'examPercentage',
            'assignmentTotal',
            'examTotal',
            'examName',
            'date',
            'year',
            'courseCode',
            'certificateNumber'

        ));
    }

    public function Certificate($userId)
    {
        if (!Auth::check() || Auth::id() != $userId) {
            return redirect()->route('auth.login')->with('error', 'Access denied.');
        }
        $user = User::find($userId);
        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        $examUser = ExamUser::where('user_id', $userId)->first();
        $examTotal = $examUser ? $examUser->total_marks : 0;
        $assignmentTotal = Assignment_upload::where('student_id', $userId)->sum('grade') ?? 0;

        $examName = $examUser ? $examUser->exam->exam_name : 'N/A';

        $maxAssignmentMarks = 100;
        $maxExamMarks = 20;


        $assignmentPercentage = ($assignmentTotal / $maxAssignmentMarks) * 100;
        $examPercentage = ($examTotal / $maxExamMarks) * 100;


        $percentage = ($assignmentPercentage + $examPercentage) / 2;

        $date = now()->toFormattedDateString();

        return view('studentdashboard.certificate.certificate', compact(
            'user',
            'percentage',
            'assignmentPercentage',
            'examPercentage',
            'assignmentTotal',
            'examTotal',
            'examName',
            'date'
        ));
    }
    public function hasCompletedExamOrAssignment($userId)
    {
        $hasExam = ExamUser::where('user_id', $userId)->exists();
        $hasAssignment = Assignment_upload::where('student_id', $userId)->exists();
        return $hasExam || $hasAssignment;
    }
}
