<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AssignmentsController;
use App\Http\Controllers\AssignmentUploadController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BatchController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PlacedStudentController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\WorkshopController;
use App\Livewire\Admin\Assignment\AssignmentCourse;
use App\Livewire\Admin\Assignment\CreateAssignment;
use App\Livewire\Admin\Assignment\EditAssignment;
use App\Livewire\Admin\Assignment\ManageAssignment;
use App\Livewire\Admin\Assignment\SingleViewAssignment;
use App\Livewire\Admin\Student\ManageStudent;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\PostChapterController;
use App\Http\Controllers\PostCourseController;
use App\Http\Controllers\PostMyPostController;
use App\Http\Controllers\PostTopicPostController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\QuizController;
use App\Livewire\Admin\Category\ManageCategory;
use App\Livewire\Admin\PlacedStudent\InsertPlacedStudent;
use App\Livewire\Admin\Student\ViewStudent;
use App\Livewire\Admin\PlacedStudent\CallingPlacedStudent;
use App\Livewire\Admin\Course\InsertCourse;
use App\Livewire\Admin\Course\UpdateCourse;
use App\Livewire\Student\ExploreCourse;
    use App\Livewire\Student\ViewCourse;
    use App\Livewire\Student\MyCourse;
    use App\Livewire\Admin\Portfolio\CreatePortfolio;
    use App\Livewire\Admin\Portfolio\ManagePortfolio;
    use App\Livewire\Admin\Message\CreateMessage;
use App\Livewire\Admin\Workshops\CreateWorkshop;
use App\Livewire\Admin\Workshops\ManageWorkshop;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Public\Contact\ContactPage;
use App\Livewire\Public\Course\Ourcourses;
use App\Livewire\Public\Header;
use App\Livewire\Public\Home;
use App\Livewire\Public\Portfolio\OurPortfolio;
use App\Livewire\Public\Viewallcourses\AllCourses;
use App\Livewire\Public\Workshops\Workshop;

// v3
use App\Livewire\V3\Admin\Dashboard;
use App\Livewire\V3\Public\NewHome;
use App\Models\Portfolio;

Route::prefix("student")->group(function () {
    Route::controller(StudentController::class)->group(function () {
        Route::get('/dashboard', 'dashboard')->name('student.dashboard');
        Route::get('/billing', 'billing')->name('student.billing');
        Route::get('/viewbilling/{paymentId}', 'viewbilling')->name('student.viewbilling');
        Route::get('course/quiz', 'courseQuiz')->name('student.course.quiz');
        Route::get('/quiz/{courseId}', 'showquiz')->name('student.quiz');
        Route::post('/quiz/submit', 'storeAnswer')->name('student.storeAnswer');
        Route::get('quiz/result/{exam_id}', 'showResults')->name('student.examResult');
        Route::get('course/result', 'courseResult')->name('student.course.result');
        Route::get('quiz/all_attempts/{course_id}', 'showAllAttempts')->name('student.allAttempts');
        Route::get('/edit-profile', 'editProfile')->name('student.editProfile');
        Route::post('/update-profile', 'updateProfile')->name('student.updateProfile');
        Route::get('/coursePurchase', 'coursePurchase')->name('student.coursePurchase');
        Route::put('/courses/{course}/update-batch', 'updateBatch')->name('course.updateBatch');
        Route::get('/course/{id}', 'buyCourse')->name('student.buyCourse');
        Route::get('/course', 'course')->name('student.course');
        Route::post('/course/{courseId}', 'enrollCourse')->name('course.enroll');
        Route::get('/assignments/view', 'assignmentList')->name('student.assignments-view');
        Route::get('/assignments/upload/{id}', 'viewAssignments')->name('student.assignment-upload');
        Route::get('/viewCertificate/{userId}', 'showCertificate')->name('student.viewCertificate');
        Route::get('/certificate/{userId}', 'Certificate')->name('student.certificate');
    });
});

Route::get('/student/messages', [MessageController::class, 'studentMessages'])->name('user.messages');
Route::get('/student/messages/{message}', [MessageController::class, 'showMessage'])->name('student.messages.show');



// Route::get('/quiz_instruction', function () {
//     return view('studentdashboard.quiz_instruction');
// })->name('quiz_instruction');

// });

//routes for the course
Route::get('/course/show', [PostCourseController::class, 'index'])->name('allcourses.show');
Route::get('/course/{course_id}/chapter/show', [PostChapterController::class, 'index'])->name('courses.show');
Route::get('/course/chapter/{chapter_id}/show', [PostTopicPostController::class, 'index'])->name('chapters.show');
Route::get('/course/chapter/topics/{topic_id}/show', [PostMyPostController::class, 'index'])->name('topics.show');


Route::get('/get-access-token', [StudentController::class, 'store']);
Route::post('/student/assignments/upload/{assignment_id}', [StudentController::class, 'store'])->name('assignments.store');


// Route::post('save-course-payment', [PaymentController::class, 'saveCoursePayment'])->name('save.course.payment');
// Route::post('save-workshop-payment', [PaymentController::class, 'saveWorkshopPayment'])->name('save.workshop.payment');

// Route::get('payment/refresh/{paymentId}', [PaymentController::class, 'refreshPayment'])->name('payment.refresh');

//razorpay routes
Route::post('/initiate-payment', [PaymentController::class, 'initiatePayment'])->name('store.payment.initiation');
Route::post('/payment-response', [PaymentController::class, 'handlePaymentResponse'])->name('handle.payment.response');
Route::post('/refresh-payment-status', [PaymentController::class, 'refreshPaymentStatus'])->name('refresh.payment.status');
Route::post('/update-payment-status', [PaymentController::class, 'updatePaymentStatus'])->name('update.payment.status');
Route::post('/create-razorpay-order', [PaymentController::class, 'createRazorpayOrder'])->name('create.razorpay.order');
Route::get('/process-overdue-payments', [PaymentController::class, 'processOverduePayments']);

Route::middleware([AdminMiddleware::class, 'auth'])->group(function () {
    Route::prefix('admin')->group(function () {
        // Dashboard and General Admin Routes
        Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/manage-payment', [AdminController::class, 'managePayment'])->name('admin.manage-payment');
        Route::get('/payment/{id}', [AdminController::class, 'viewPayment'])->name('admin.payment.view');
        Route::get('/search', [AdminController::class, 'searchCourse'])->name('course.search');
        Route::get('/enquiry', [AdminController::class, 'searchEnquiry'])->name('admin.manage.enquiry');
        Route::get('/enquiry-view/{enquiry}', [AdminController::class, 'editEnquiry'])->name('admin.enquiry.show');
        Route::put('/enquiry-view/{enquiry}', [AdminController::class, 'updateEnquiry'])->name('admin.enquiry.update');

        // Student Management
        Route::prefix('student')->group(function () {
            Route::get('/', [StudentController::class, 'index'])->name('student.manage');
            Route::get('/edit/{id}', [StudentController::class, 'edit'])->name('student.edit');
            Route::patch('/edit/{student}/{field}', [StudentController::class, 'update'])->name('student.update');
            Route::get('/search', [StudentController::class, 'search'])->name('student.search');
            Route::post('/{student}/assign-course', [StudentController::class, 'assignCourse'])->name('students.assignCourse');
            Route::delete('/{student}/remove-course/{course}', [StudentController::class, 'removeCourse'])->name('students.removeCourse');
            Route::post('/{student}/process-payment', [StudentController::class, 'processPayment'])->name('students.processPayment');
        });

        // Course Management
        Route::resource('course', CourseController::class);
        Route::post('/courses/{id}/features', [CourseController::class, 'addFeature'])->name('course.addFeature');
        Route::post('/courses/{course}/publish', [CourseController::class, 'publish'])->name('course.publish');
        Route::post('/course/{id}/unpublish', [CourseController::class, 'unpublish'])->name('course.unpublish');
        Route::patch('/courses/{course}/{field}', [CourseController::class, 'update'])->name('course.update');

        // Chapter Management
        Route::get('/courses/{course_id}/chapters/create', [ChapterController::class, 'create'])->name('chapter.create');
        Route::post('/courses/{course_id}/chapters', [ChapterController::class, 'store'])->name('chapter.store');
        Route::get('/chapters/{chapter}/edit', [ChapterController::class, 'edit'])->name('chapter.edit');
        Route::patch('/chapters/{chapter}', [ChapterController::class, 'update'])->name('chapter.update');
        Route::delete('/chapters/{id}', [ChapterController::class, 'destroy'])->name('chapter.destroy');

        // Lesson Management
        Route::get('/chapters/{chapter}/lessons/create', [LessonController::class, 'create'])->name('lessons.create');
        Route::post('/chapters/{chapter}/lessons', [LessonController::class, 'store'])->name('lessons.store');

        // Category Management
        Route::resource('category', CategoryController::class)->except(['create', 'show']);

        // Batch Management
        Route::get('/batches', [BatchController::class, 'index'])->name('batches.index');
        Route::post('/batches', [BatchController::class, 'store'])->name('batches.store');
        Route::put('/batches/update/{batch}', [BatchController::class, 'update'])->name('batches.update');
        Route::delete('/batches/{batch}/disable', [BatchController::class, 'destroy'])->name('batches.destroy');

        // Assignment Management
        Route::resource('assignment', AssignmentsController::class);
        Route::patch('/assignment/{assignment}/toggle-status', [AssignmentsController::class, 'toggleStatus'])->name('assignment.toggleStatus');
        Route::resource('assignment-submit', AssignmentUploadController::class);
        Route::get('/assignments/review/{id}', [AssignmentUploadController::class, 'assignmentReviewWork'])->name('assignment.reviewWork');
        Route::post('/assignments/{assignmentId}/students/{studentId}/grade', [AssignmentUploadController::class, 'insertGrade'])->name('assignments.insertGrade');
        Route::get('/assignments/download/{fileId}', [AssignmentUploadController::class, 'downloadFile'])->name('assignments.download');
        Route::get('/assignments/course', [AssignmentUploadController::class, 'assignmentCourse'])->name('assignments.course');
        Route::get('/assignments/course/assignment-review/{slug}', [AssignmentUploadController::class, 'assignmentReview'])->name('assignments.review');
        Route::get('/assignments/single-student/{id}', [AssignmentUploadController::class, 'manageSingleStudentAssignment'])->name('assignments.singleStudent.assignment');

        // Exam Management
        Route::prefix('exam')->group(function () {
            Route::get('/create', [ExamController::class, 'create'])->name('exam.create');
            Route::post('/store', [ExamController::class, 'store'])->name('exam.store');
            Route::get('/show', [ExamController::class, 'show'])->name('exam.show');
            Route::get('/show/{exam}/{course_title}/{exam_name}/questions', [ExamController::class, 'showQuestions'])->name('exam.showQuestions');
            Route::get('/view/{exam}', [ExamController::class, 'view'])->name('exam.view');
            Route::patch('/{exam}/toggle-status', [ExamController::class, 'toggleStatus'])->name('exam.toggleStatus');
            Route::get('/{exam}/edit', [ExamController::class, 'edit'])->name('exam.edit');
            Route::put('/{exam}/update', [ExamController::class, 'update'])->name('exam.update');
            Route::delete('/{exam}', [ExamController::class, 'destroy'])->name('exam.destroy');
        });

        // Quiz Management
        Route::prefix('quiz')->group(function () {
            Route::get('/create/{exam_id?}', [QuizController::class, 'create'])->name('quiz.create');
            Route::post('/store', [QuizController::class, 'store'])->name('quiz.store');
            Route::get('/show', [QuizController::class, 'show'])->name('quiz.show');
            Route::get('/view/{quiz}', [QuizController::class, 'view'])->name('quiz.view');
            Route::patch('/{quiz}/toggle-status', [QuizController::class, 'toggleStatus'])->name('quiz.toggleStatus');
            Route::get('/{quiz}/edit', [QuizController::class, 'edit'])->name('quiz.edit');
            Route::put('/{quiz}/update', [QuizController::class, 'update'])->name('quiz.update');
            Route::delete('/question/{question_id}', [QuizController::class, 'quizQuestionDestroy'])->name('quizQuestion.destroy');
            Route::delete('/{quiz}', [QuizController::class, 'destroy'])->name('quiz.destroy');
            Route::get('/answer', [QuizController::class, 'answerShow'])->name('answer.results');
        });

        // Results Management
        Route::prefix('results')->group(function () {
            Route::get('/exam', [ResultController::class, 'showExam'])->name('exam.results');
            Route::get('/exam/{exam}/users', [ResultController::class, 'showExamUser'])->name('exam.user.results');
            Route::get('/exams/{examId}/user/{userId}/attempts', [ResultController::class, 'getResultsByAttempts'])->name('attempt.results');
            Route::get('/{examId}/{userId}/attempt/{attempt}', [ResultController::class, 'getAttemptDetails'])->name('attempt.details');
            Route::get('/certificate', [ResultController::class, 'Certificate'])->name('admin.certificate');
            Route::get('/viewCertificate/{userId}', [ResultController::class, 'index'])->name('admin.viewCertificate');
        });

        // Message Management
        Route::prefix('message')->group(function () {
            Route::get('/create', [MessageController::class, 'create'])->name('messages.create');
            Route::post('/store', [MessageController::class, 'store'])->name('messages.store');
            Route::get('/manage', [MessageController::class, 'index'])->name('messages.manage');
            Route::get('/show/{message}', [MessageController::class, 'show'])->name('messages.show');
            Route::delete('/delete/{message}', [MessageController::class, 'destroy'])->name('messages.delete');
        });

        // Portfolio Management
        Route::prefix('portfolio')->group(function () {
            Route::get('/create', [PortfolioController::class, 'create'])->name('portfolio.create');
            Route::post('/store', [PortfolioController::class, 'store'])->name('portfolio.store');
            Route::get('/', [PortfolioController::class, 'show'])->name('portfolio.admin.index');
            Route::get('/{id}/edit', [PortfolioController::class, 'edit'])->name('portfolio.admin.edit');
            Route::put('/{id}', [PortfolioController::class, 'update'])->name('portfolio.admin.update');
            Route::delete('/{id}', [PortfolioController::class, 'destroy'])->name('portfolio.admin.destroy');
        });

        // Workshop Management
        Route::prefix('workshops')->group(function () {
            Route::get('/create', [WorkshopController::class, 'create'])->name('workshops.create');
            Route::post('/store', [WorkshopController::class, 'store'])->name('workshops.store');
            Route::get('/', [WorkshopController::class, 'show'])->name('workshops.admin.index');
            Route::patch('/{id}/toggle-status', [WorkshopController::class, 'toggleStatus'])->name('workshops.toggleStatus');
            Route::get('/{id}/edit', [WorkshopController::class, 'edit'])->name('admin.workshops.edit');
            Route::put('/{id}', [WorkshopController::class, 'update'])->name('admin.workshops.update');
            Route::delete('/{id}', [WorkshopController::class, 'destroy'])->name('admin.workshops.destroy');
        });

        // Placed Students
        Route::resource('placedStudent', PlacedStudentController::class);
        Route::post('/placed-students/{placedStudent}/toggle-status', [PlacedStudentController::class, 'toggleStatus'])->name('placedStudent.toggleStatus');
    });

    // Version 2 Routes (Livewire)
    Route::prefix('v2/admin')->group(function () {
        Route::get('/category', ManageCategory::class)->name('admin.category');
        Route::get('/student', ManageStudent::class)->name('admin.student');
        Route::get('/student/{id}', ViewStudent::class)->name('admin.student.view');
        Route::get('/course', InsertCourse::class)->name('admin.course');
        Route::get('/course/update/{courseId}', UpdateCourse::class)->name('admin.course.update');
        
        // Assignment Routes
        Route::get('/assignment', CreateAssignment::class)->name('admin.assignment');
        Route::get('/assignment/manage', ManageAssignment::class)->name('admin.assignment.manage');
        Route::get('/singleViewAssignment/{assignment}', SingleViewAssignment::class)->name('admin.assignment.view');
        Route::get('/assignment/course', AssignmentCourse::class)->name('admin.assignment.course');
        Route::get('/assignment/{assignment}/edit', CreateAssignment::class)->name('admin.assignment.edit');

        // Workshop Routes
        Route::get('/workshops', CreateWorkshop::class)->name('admin.workshops.create');
        Route::get('/workshops/{id}', CreateWorkshop::class)->name('admin.workshops.edit');
        Route::get('/workshops/manage', ManageWorkshop::class)->name('admin.workshops.index');

        // Placed Student Routes
        Route::get('/placedstudent', InsertPlacedStudent::class)->name('admin.placedstudent.create');
        Route::get('/placedstudent/{placedStudent}', InsertPlacedStudent::class)->name('admin.placedstudent.edit');
        Route::get('/placedstudent/manage', CallingPlacedStudent::class)->name('admin.placedstudent.index');

        // Portfolio Routes
        Route::get('/portfolio', CreatePortfolio::class)->name('admin.portfolio.create');
        Route::get('/portfolio/manage', ManagePortfolio::class)->name('admin.portfolio.index');
       
        });
    });
});

Route::prefix('v2')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::get('/register', Register::class)->name('v2.auth.register');
        Route::get('/login', Login::class)->name('v2.auth.login');
        Route::get('/logout', Header::class)->name('v2.auth.logout');
        Route::get('/portfolio', OurPortfolio::class)->name('v2.public.portfolio');
    });

    Route::prefix("student")->group(function(){
        Route::get('/explore-courses', ExploreCourse::class)->name('student.exploreCourses');
        Route::get('/view-courses/{courseId}', ViewCourse::class)->name('student.viewCourses');
        Route::get('/my-courses', MyCourse::class)->name('student.myCourses');

    });
    //working here for public routes
    Route::prefix("public")->group(function () {
        Route::get('/', Home::class)->name('v2.public.homepage');
        Route::get('/viewallcourses', AllCourses::class)->name('v2.public.viewallcourses.all-courses');
        Route::get('/courses/{slug}', Ourcourses::class)->name('v2.public.courseDetail');
        Route::get('/contact', ContactPage::class)->name('v2.public.contactUs');
        Route::get('/workshops', Workshop::class)->name('v2.public.workshop');
    });
});

// public routes here:
Route::controller(PublicController::class)->group(function () {

    Route::get("/", "index")->name('public.index');
    Route::prefix('training')->group(function () {
        Route::get("/", "training")->name('public.training');
        Route::get("/register/success", "success")->name('public.success');
        Route::get('/courses/{category_slug}/{slug}', 'courseDetails')->name('public.courseDetails');
        Route::post('/courses/{courseId}', 'enrollCourse')->name('public.enrollCourse');
    });
    Route::get('/about', 'aboutPage')->name('public.about');
    Route::get('/contact', 'contactUsPage')->name('public.contact');
    Route::get('/privacy-policy', 'privacyAndPolicy')->name('public.privacy');
    Route::get('/terms-conditions', 'termsAndConditions')->name('public.terms-conditions');
    Route::post('/enquiry-store', 'storeEnquiry')->name('enquiry.store');
});


Route::get('generate', function () {
    \Illuminate\Support\Facades\Artisan::call('storage:link');
    echo 'ok';
});

// Authentication route's group here
Route::prefix('auth')->controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('auth.login');
    Route::post('/login', 'login')->name('auth.login.post');
    Route::get('/verify-otp', 'showOtpForm')->name('show.otp.form');
    Route::post('/resend-otp', 'resendOtp')->name('auth.resend-otp');

    // OTP verification handling route (POST request to verify OTP)
    Route::post('verify-otp', 'verifyOtp')->name('verify.otp');
    Route::post('send-otp', 'sendOtp')->name('auth.sendOtp');

    Route::get('/register', 'showRegistrationForm')->name('auth.register');
    Route::post('/register', 'register')->name('auth.register.post');
    Route::post('/verify-otp-register', [AuthController::class, 'verifyOtpRegister'])->name('auth.verifyOtp.register');
    Route::get('/logout', 'logout')->name('auth.logout');
});

Route::get('/launch', function () {
    return view('public.launch');
});


Route::get('/portfolio', [PortfolioController::class, 'index'])->name('public.portfolio');
Route::get('/workshops', [WorkshopController::class, 'index'])->name('public.workshops');
Route::get('/workshop/{id}/enroll', [WorkshopController::class, 'buyWorkshop'])->name('workshop.enroll');






Route::prefix("v3")->group(function () {
    // homepage
    // view Paid Course
    // view tutorial online Course
    // view tutorial online Course Topics
    // Workshops
    // view Workshops
    // Auth works
    Route::get('/', NewHome::class)->name('public.homepage');

});
