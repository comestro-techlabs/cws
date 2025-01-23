    <?php

    use App\Http\Controllers\AdminController;
    use App\Http\Controllers\AnswerController;
    use App\Http\Controllers\AssignmentsController;
    use App\Http\Controllers\AssignmentUploadController;
    use App\Http\Controllers\AuthController;
    use App\Http\Controllers\BatchController;
    use App\Http\Controllers\CategoryController;
    use App\Http\Controllers\ChapterController;
    use App\Http\Controllers\CourseController;
    use App\Http\Controllers\EnquiryController;
    use App\Http\Controllers\LessonController;
    use App\Http\Controllers\OptionController;
    use App\Http\Controllers\PhonepeController;
    use App\Http\Controllers\PublicController;
    use App\Http\Controllers\ResultController;
    use App\Http\Controllers\StudentController;
    use App\Http\Controllers\PaymentController;
    use App\Http\Controllers\PortfolioController;
    use App\Http\Controllers\WorkshopController;
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\Auth\SocialiteController;
    use App\Http\Controllers\ExamController;
    use App\Http\Middleware\AdminMiddleware;
    use App\Http\Controllers\QuizController;

use App\Models\Workshop;


    Route::prefix("student")->group(function () {
        Route::controller(StudentController::class)->group(function () {
            Route::get('/dashboard', 'dashboard')->name('student.dashboard');
            Route::get('/billing', 'billing')->name('student.billing');
            Route::get('course/quiz', 'courseQuiz')->name('student.course.quiz');
            Route::get('/quiz/{courseId}', 'showquiz')->name('student.quiz');
            Route::post('/quiz/submit',  'storeAnswer')->name('student.storeAnswer');
            Route::get('quiz/result/{exam_id}',  'showResults')->name('student.examResult');
            Route::get('course/result', 'courseResult')->name('student.course.result');
            Route::get('quiz/all_attempts/{course_id}',  'showAllAttempts')->name('student.allAttempts');
            Route::get('/edit-profile',  'editProfile')->name('student.editProfile');
            Route::post('/update-profile', 'updateProfile')->name('student.updateProfile');
            Route::get('/coursePurchase', 'coursePurchase')->name('student.coursePurchase');
            Route::put('/courses/{course}/update-batch', 'updateBatch')->name('course.updateBatch');

            Route::get('/course/{id}', 'buyCourse')->name('student.buyCourse');
            Route::get('/course', 'course')->name('student.course');
            Route::get('/assignments/view', 'assignmentList')->name('student.assignments-view');
            Route::get('/assignments/upload/{id}', 'viewAssignments')->name('student.assignment-upload');

         });    
    });
   
          
        // Route::get('/quiz_instruction', function () {
        //     return view('studentdashboard.quiz_instruction');
        // })->name('quiz_instruction');  

       // });


        

    Route::get('/get-access-token', [StudentController::class, 'store']);
    Route::post('/student/assignments/upload/{assignment_id}', [StudentController::class, 'store'])->name('assignments.store');


    Route::post('save-course-payment', [PaymentController::class, 'saveCoursePayment'])->name('save.course.payment');
     Route::post('save-workshop-payment', [PaymentController::class, 'saveWorkshopPayment'])->name('save.workshop.payment');
  

    Route::middleware([AdminMiddleware::class, "auth"])->group(function () {

        Route::prefix('admin')->group(function () {
            Route::get("/", [AdminController::class, "dashboard"])->name('admin.dashboard');
            Route::get('/manage-payment', [AdminController::class, "managePayment"])->name('admin.manage-payment');
            Route::get('/payment/{id}', [AdminController::class, "viewPayment"])->name('admin.payment.view');
            Route::get('/assignments/review/{id}', [AssignmentUploadController::class, 'assignmentReviewWork'])->name('assignment.reviewWork');
            Route::post('/assignments/{assignmentId}/students/{studentId}/grade', [AssignmentUploadController::class, 'insertGrade'])->name('assignments.insertGrade');


            Route::prefix('student')->group(function () {
                Route::get('/', [StudentController::class, 'index'])->name('student.manage');
                Route::get("/edit/{id}", [StudentController::class, "edit"])->name('student.edit');
                Route::patch('edit/{student}/{field}', [StudentController::class, 'update'])->name('student.update');
                Route::get("/search", [StudentController::class, "search"])->name('student.search');
                Route::post('/{student}/assign-course', [StudentController::class, 'assignCourse'])->name('students.assignCourse');
                Route::delete('/{student}/remove-course/{course}', [StudentController::class, 'removeCourse'])->name('students.removeCourse');
                Route::post('/students/{student}/process-payment', [StudentController::class, 'processPayment'])->name('students.processPayment');
            });

            Route::resource('course', CourseController::class);
            Route::get('/courses/{course_id}/chapters/create', [ChapterController::class, 'create'])->name('chapter.create');
            Route::post('/courses/{course_id}/chapters', [ChapterController::class, 'store'])->name('chapter.store');
            Route::get('/chapters/{chapter}/edit', [ChapterController::class, 'edit'])->name('chapter.edit');
            Route::delete('/chapters/{id}', [ChapterController::class, 'destroy'])->name('chapter.destroy');
            Route::patch('/chapters/{chapter}', [ChapterController::class, 'update'])->name('chapter.update');
            Route::post('/courses/{id}/features', [CourseController::class, 'addFeature'])->name('course.addFeature');
            Route::post('/courses/{course}/publish', [CourseController::class, 'publish'])->name('course.publish');
            Route::post('/course/{id}/unpublish', [CourseController::class, 'unpublish'])->name('course.unpublish');


            Route::get('/chapters/{chapter}/lessons/create', [LessonController::class, 'create'])->name('lessons.create');
            Route::post('/chapters/{chapter}/lessons', [LessonController::class, 'store'])->name('lessons.store');

            Route::patch('courses/{course}/{field}', [CourseController::class, 'update'])->name('course.update');
            Route::resource("category", CategoryController::class)->except(['create', 'show']);
            Route::get('/batches', [BatchController::class, 'index'])->name('batches.index');
            Route::post('/batches', [BatchController::class, 'store'])->name('batches.store');
            Route::delete('batches/{batch}/disable', [BatchController::class, 'destroy'])->name('batches.destroy');

            Route::get("/search", [AdminController::class, "searchCourse"])->name('course.search');

            Route::get("/search-enq", [AdminController::class, "searchEnquiry"])->name('enquiry.search');

            Route::get('/enquiry', [AdminController::class, 'indexEnquiry'])->name('admin.manage.enquiry');
            Route::get('/enquiry-view/{enquiry}', [AdminController::class, 'editEnquiry'])->name('admin.enquiry.show');
            Route::put('/enquiry-view/{enquiry}', [AdminController::class, 'updateEnquiry'])->name('admin.enquiry.update');
            Route::resource('assignment', AssignmentsController::class);
            Route::resource('assignment-submit', AssignmentUploadController::class);
            Route::get('/assignments/download/{fileId}', [AssignmentUploadController::class, 'downloadFile'])->name('assignments.download');

            Route::resource('assignment-submit', AssignmentUploadController::class);
            Route::get('/assignments/download/{fileId}', [AssignmentUploadController::class, 'downloadFile'])->name('assignments.download');
            Route::get('/assignments/course', [AssignmentUploadController::class, 'assignmentCourse'])->name('assignments.course');
            Route::get('/assignments/course/assignment-review/{slug}', [AssignmentUploadController::class, 'assignmentReview'])->name('assignments.review');
            Route::get('/assignments/single-student/{id}', [AssignmentUploadController::class, 'manageSingleStudentAssignment'])->name('assignments.singleStudent.assignment');

            Route::patch('/assignment/{assignment}/toggle-status', [AssignmentsController::class, 'toggleStatus'])->name('assignment.toggleStatus');


            //exam
            Route::get('/exam/create', [ExamController::class, 'create'])->name('exam.create');
            Route::post('/exam/store', [ExamController::class, 'store'])->name('exam.store');
            Route::get('/exam/show', [ExamController::class, 'show'])->name('exam.show');
            Route::get('/exam/show/{exam}/{course_title}/{exam_name}/questions', [ExamController::class, 'showQuestions'])->name('exam.showQuestions');

            Route::get('/exam/view/{exam}', [ExamController::class, 'view'])->name('exam.view');
            Route::patch('/exam/{exam}/toggle-status', [ExamController::class, 'toggleStatus'])->name('exam.toggleStatus');
            Route::get('/exam/{exam}/edit', [ExamController::class, 'edit'])->name('exam.edit');
            Route::put('/exam/{exam}/update', [ExamController::class, 'update'])->name('exam.update');
            Route::delete('/exam/{exam}', [ExamController::class, 'destroy'])->name('exam.destroy');
            //quiz
            // Route::resource('quiz', QuizController::class);

            Route::get('/quiz/create', [QuizController::class, 'create'])->name('quiz.create');
            Route::post('/quiz/store', [QuizController::class, 'store'])->name('quiz.store');
            Route::get('/quiz/show', [QuizController::class, 'show'])->name('quiz.show');
            Route::get('/quiz/view/{quiz}', [QuizController::class, 'view'])->name('quiz.view');
            Route::patch('/quiz/{quiz}/toggle-status', [QuizController::class, 'toggleStatus'])->name('quiz.toggleStatus');
            Route::get('/quiz/{quiz}/edit', [QuizController::class, 'edit'])->name('quiz.edit');
            Route::put('/quiz/{quiz}/update', [QuizController::class, 'update'])->name('quiz.update');
            Route::delete('/quiz/question/{question_id}', [QuizController::class, 'quizQuestionDestroy'])->name('quizQuestion.destroy');
            Route::delete('/quiz/{quiz}', [QuizController::class, 'destroy'])->name('quiz.destroy');


            //result
            // Route::get('/quiz/{quiz}/results', [QuizController::class, 'results'])->name('quiz.results');

            Route::get('/answer',[AnswerController::class,'show'])->name('answer.results');
            Route::get('/exam/result',[ResultController::class,'showExam'])->name('exam.results');
            Route::get('/exam/{exam}/users',[ResultController::class,'showExamUser'])->name('exam.user.results');
            
            // Route::get('/results/{examId}/{userId}/attempts', [ResultController::class, 'getResultsByAttempts'])->name('attempt.results');
            Route::get('/exams/{examId}/user/{userId}/attempts', [ResultController::class, 'getResultsByAttempts'])
    ->name('attempt.results');
            Route::get('/results/{examId}/{userId}/attempt/{attempt}', [ResultController::class, 'getAttemptDetails'])->name('attempt.details');
            Route::get('certificate/{userId}', [ResultController::class, 'Certificate'])
            ->name('admin.certificate');
            Route::get('viewCertificate/{userId}', [ResultController::class, 'index'])
            ->name('admin.viewCertificate');
          
            
            Route::get('/answer',[AnswerController::class,'show'])->name('answer.results');
                  
    Route::get('/portfolio/create', [PortfolioController::class, 'create'])->name('portfolio.create');
    Route::post('/portfolio/store', [PortfolioController::class, 'store'])->name('portfolio.store');
    Route::get('/admin/portfolio', [PortfolioController::class, 'show'])->name('portfolio.admin.index');
    Route::get('/portfolio/{id}/edit', [PortfolioController::class, 'edit'])->name('portfolio.admin.edit');
    Route::put('/portfolio/{id}', [PortfolioController::class, 'update'])->name('portfolio.admin.update');
    Route::delete('/portfolio/{id}', [PortfolioController::class, 'destroy'])->name('portfolio.admin.destroy');

    Route::get('/workshops/create', [WorkshopController::class, 'create'])->name('workshops.create');
    Route::post('/workshops/store', [WorkshopController::class, 'store'])->name('workshops.store');
    Route::get('/admin/workshops', [WorkshopController::class, 'show'])->name('workshops.admin.index');
    Route::patch('/workshops/{id}/toggle-status', [WorkshopController::class, 'toggleStatus'])->name('workshops.toggleStatus');
    Route::get('/admin/workshops/{id}/edit', [WorkshopController::class, 'edit'])->name('admin.workshops.edit');
    Route::put('/admin/workshop/{id}', [WorkshopController::class, 'update'])->name('admin.workshops.update');
    Route::delete('admin/workshop/{id}', [WorkshopController::class, 'destroy'])->name('admin.workshops.destroy');

        });
    });



    Route::get('auth/google', [SocialiteController::class, 'redirectToGoogle'])->name('auth.google');
    Route::get('auth/google/callback', [SocialiteController::class, 'handleGoogleCallback']);

    // public routes here:
    Route::controller(PublicController::class)->group(function () {

        Route::get("/", "index")->name('public.index');
        Route::prefix('training')->group(function () {
            Route::get("/", "training")->name('public.training');
            Route::get("/register/success", "success")->name('public.success');
            Route::get('/courses/{category_slug}/{slug}', 'courseDetails')->name('public.courseDetails');
        });
        Route::get('/about', 'aboutPage')->name('public.about');
        Route::get('/contact', 'contactUsPage')->name('public.contact');
        Route::get('/privacy-policy', 'privacyAndPolicy')->name('public.privacy');
        Route::get('/terms-conditions', 'termsAndConditions')->name('public.terms-conditions');

        // service's routes here:
        Route::prefix("services")->group(function () {
            Route::get('/coaching', 'coachingPage')->name('public.services.coaching');
            Route::get('/ecommerce', 'ecommercePage')->name('public.services.ecommerce');
            Route::get('/seo-services', 'seoServices')->name('public.services.seo-services');
            Route::get('/web-development', 'webDevPage')->name('public.services.web-dev');
            Route::get('/mobile-app', 'mobileAppPage')->name('public.services.mobile-app');
            Route::get('/web-design', 'webDesignPage')->name('public.services.web-design');
            Route::get('/software-development', 'softwareDev')->name('public.services.software-dev');
            Route::get('/native-app', 'nativeApp')->name('public.services.native-app');
            Route::get('/inventory-solution', 'inventorySolution')->name('public.services.invent-sol');
            Route::get('/', 'servicePage')->name('public.services.services');
        });
    });

    Route::post('/enquiry-store', [EnquiryController::class, 'storeEnquiry'])->name('enquiry.store');

    Route::get('generate', function () {
        \Illuminate\Support\Facades\Artisan::call('storage:link');
        echo 'ok';
    });

    // Authentication route's group here
    Route::prefix('auth')->controller(AuthController::class)->group(function () {
        Route::get('/login', 'showLoginForm')->name('auth.login');
        Route::post('/login', 'login')->name('auth.login.post');
        Route::get('/verify-otp',  'showOtpForm')->name('show.otp.form');
        
        // OTP verification handling route (POST request to verify OTP)
        Route::post('verify-otp',  'verifyOtp')->name('verify.otp');
        Route::post('send-otp', 'sendOtp')->name('auth.sendOtp');

        Route::get('/register', 'showRegistrationForm')->name('auth.register');
        Route::post('/register', 'register')->name('auth.register.post');
        Route::post('/verify-otp-register', [AuthController::class, 'verifyOtpRegister'])->name('auth.verifyOtp.register');
        Route::get('/logout', 'logout')->name('auth.logout');
    });

    Route::get('/launch', function () {
        return view('public.launch');
    });

   

    Route::get('/phonepe/payment', [PhonepeController::class, 'index'])->name('phonepe.payment');
    Route::post('/phonepe/initiate', [PhonepeController::class, 'initiatePayment'])->name('phonepe.initiate');
    Route::post('/phonepe/callback', [PhonePeController::class, 'callback'])->name('phonepe.callback');
    Route::get('/phonepe/status/{transactionId}', [PhonePeController::class, 'checkStatus'])->name('phonepe.status');
    // Route::post('/phonepe/refund', [PhonePeController::class, 'refund'])->name('phonepe.refund');
    Route::get('/phonepe/redirect', [PhonePeController::class, 'redirect'])->name('phonepe.redirect');

    Route::get('/portfolio', [PortfolioController::class, 'index'])->name('public.portfolio');
    Route::get('/workshops', [WorkshopController::class, 'index'])->name('public.workshops');
   


  
