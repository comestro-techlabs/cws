<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AssignmentsController;
use App\Http\Controllers\AssignmentUploadController;
use App\Http\Controllers\BatchController;

use App\Http\Controllers\CourseController;
use App\Http\Controllers\PlacedStudentController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\WorkshopController;

use App\Livewire\Admin\Assignment\AssignmentCourse;
use App\Livewire\Admin\Assignment\CreateAssignment;
use App\Livewire\Admin\Assignment\ManageAssignment;
use App\Livewire\Admin\Assignment\ReviewWork;
use App\Livewire\Admin\Assignment\AssignmentReview;
use App\Livewire\Admin\Assignment\SingleViewAssignment;

use App\Livewire\Admin\Dashboad;
use App\Livewire\Admin\ManageEnquiry;
use App\Livewire\Admin\Student\AttendanceCalendar;
use App\Livewire\Admin\Student\ManageStudent;
use App\Livewire\Auth\Facebook;
use App\Livewire\Auth\Github;
use App\Livewire\Auth\LinkedinLogin;
use App\Livewire\Student\Dashboard\Takeexam\Result;
use App\Livewire\Student\Dashboard\Takeexam\ShowAllAttempt;
use App\Livewire\Student\Dashboard\Takeexam\ShowQuiz;
use App\Livewire\Student\MyAttendance;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExamController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\QuizController;
use App\Livewire\Admin\Blog\PostCourse;
use App\Livewire\Admin\Blog\ManageChapter;
use App\Livewire\Admin\Blog\ManagePost;
use App\Livewire\Admin\Blog\ManageTopic;
use App\Livewire\Admin\Category\ManageCategory;
use App\Livewire\Admin\PlacedStudent\InsertPlacedStudent;
use App\Livewire\Admin\Student\ViewStudent;
use App\Livewire\Admin\PlacedStudent\CallingPlacedStudent;
use App\Livewire\Admin\Course\InsertCourse;
use App\Livewire\Admin\Course\UpdateCourse;
use App\Livewire\Student\ExploreCourse;
use App\Livewire\Student\ViewCourse;
use App\Livewire\Student\MyCourse;
use App\Livewire\Student\EditProfile;
use App\Livewire\Student\Dashboard\ViewAssigment;
use App\Livewire\Admin\Workshops\ManageWorkshop;
use App\Livewire\Admin\Course\ManageCourse;
use App\Livewire\Admin\Course\ShowCourse;
use App\Livewire\Admin\Certificate\CertificateEligibility;
use App\Livewire\Admin\Exam\ManageExam;
use App\Livewire\Admin\Exam\ExamQuestions;
use App\Livewire\Admin\Quiz\ManageQuiz;
use App\Livewire\Admin\Result\ManageResult;
use App\Livewire\Admin\MockTest\ManageMockTest;

use App\Livewire\Admin\Student\AttendanceScanner;
use App\Livewire\Auth\Login;
use App\Livewire\Public\Blog\CourseWithChapterAndTopic;
use App\Livewire\Public\Blog\TopicWithPostContent;
use App\Livewire\Public\Contact\ContactPage;
use App\Livewire\Public\Course\Ourcourses;
use App\Livewire\Public\Header;
use App\Livewire\Public\Home;
use App\Livewire\Public\Viewallcourses\AllCourses;
use App\Livewire\Public\Workshops\Workshop;
use App\Livewire\Student\Billing\ViewBilling;
use App\Livewire\Student\Dashboard\ManageAssignments;
use App\Livewire\Student\Dashboard\Product\OurProducts;
use App\Livewire\Student\Dashboard\StudentDashboard;
use App\Livewire\Student\Dashboard\Takeexam\Exam;
use App\Livewire\Student\MockTest\SelectMockTest;
use App\Livewire\Student\MockTest\ShowMockTest;
use App\Livewire\Student\MockTest\MockTestResult;
use App\Livewire\Auth\GoogleLogin;
use App\Livewire\Student\Dashboard\Product\CheckOutPage;
use App\Livewire\Student\Rewards\GemsTransactions;

// public routes
Route::get('/', Home::class)->name('public.index');
Route::get('/viewallcourses', AllCourses::class)->name('public.viewallcourses.all-courses');
Route::get('/courses/{slug}', Ourcourses::class)->name('public.courseDetail');
Route::get('/contact', ContactPage::class)->name('public.contactUs');
Route::get('/workshops', Workshop::class)->name('public.workshop');
Route::get('/course/{course_id}/chapter/show', CourseWithChapterAndTopic::class)->name('v2.courses.show');
Route::get('/course/{course_id}/chapter/{chapter_id?}/topic/{topic_id?}/show', TopicWithPostContent::class)->name('v2.topics.show');

//auth routes
Route::prefix('auth')->group(function () {
    Route::get('/login', Login::class)->name('auth.login');
    Route::get('/logout', Header::class)->name('auth.logout');
    Route::get('/google', [GoogleLogin::class, 'redirectToGoogle'])->name('auth.google.login');
    Route::get('/google/callback', [GoogleLogin::class, 'handleGoogleCallback'])->name('auth.google.callback');
    Route::get('/github/redirect', [Github::class, 'redirectToGithub'])->name('github.redirect');
    Route::get('/github/callback', [Github::class, 'handleGithubCallback'])->name('github.callback');

    
    Route::get('/linkedin/redirect', [LinkedinLogin::class, 'redirectToLinkedin'])->name('linkedin.redirect');
    Route::get('/linkedin-openid/callback', [LinkedinLogin::class, 'handleLinkedinCallback'])->name('linkedin.callback');

    Route::get('/viewallcourses', AllCourses::class)->name('public.viewallcourses.all-courses');
    Route::get('/courses/{slug}', Ourcourses::class)->name('public.courseDetail');
    Route::get('/contact', ContactPage::class)->name('public.contactUs');
    Route::get('/workshops', Workshop::class)->name('public.workshop');
    Route::get('/facebook/redirect', [Facebook::class, 'redirectToFacebook'])->name('facebook.redirect');
    Route::get('/facebook/callback', [Facebook::class, 'handleFacebookCallback'])->name('facebook.callback');

});
//protected routes
Route::middleware('auth')->group(function () {
    //student routes
    Route::prefix("student")->group(function () {
        Route::get('/dashboard', StudentDashboard::class)->name('student.dashboard');
        Route::get('/billing', ViewBilling::class)->name('student.billing');
        Route::get('/rewards/gems', GemsTransactions::class)->name('student.rewards.gems');
    });

    Route::controller(StudentController::class)->group(function () {
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

Route::get('/get-access-token', [StudentController::class, 'store']);
Route::post('/student/assignments/upload/{assignment_id}', [StudentController::class, 'store'])->name('assignments.store');

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
        Route::get('/dashboard', Dashboad::class)->name('admin.dashboard');
        Route::get('/logout', [Dashboad::class, 'logout'])->name('admin.logout');
        Route::get('/category', ManageCategory::class)->name('admin.category');
        Route::get('/student', ManageStudent::class)->name('admin.student');
        Route::get('/student/{id}', ViewStudent::class)->name('admin.student.view');
        //course routes
        Route::get('/course', InsertCourse::class)->name('admin.course');
        Route::get('/course/update/{courseId}', UpdateCourse::class)->name('admin.course.update');
        Route::get('/course/show/{courseId}', ShowCourse::class)->name('admin.course.show');
        Route::get('/course/manage', ManageCourse::class)->name('admin.course.manage');
        Route::get('/student/{id}', ViewStudent::class)->name('admin.student.view');

        Route::get('/course/update/{courseId}', UpdateCourse::class)->name('admin.course.update');
        Route::get("/admin/attendace", AttendanceScanner::class)->name('admin.attendance');

        //exam routes
        Route::get('/exam', ManageExam::class)->name('admin.exam');
        Route::get('/exam/{examId}/questions', ExamQuestions::class)->name('admin.exam.questions');
        Route::get('/quiz/{examId}/questions', ManageQuiz::class)->name(name: 'admin.quiz');
        Route::get('/student/attendance/calendar/{studentId}', AttendanceCalendar::class)->name('admin.student.attendance.calendar');

        //result routes

        Route::get('/results', ManageResult::class)->name('results');

        //mocktest routes
        Route::get('/mocktest', ManageMockTest::class)->name('admin.mocktest');
        // Assignment Routes
        Route::get('/assignment', CreateAssignment::class)->name('admin.assignment');
        Route::get('/assignment/manage', ManageAssignment::class)->name('admin.assignment.manage');
        Route::get('/singleViewAssignment/{assignment}', SingleViewAssignment::class)->name('admin.assignment.view');
        Route::get('/assignment/course', AssignmentCourse::class)->name('admin.assignment.course');
        Route::get('/assignment/{assignment}/edit', CreateAssignment::class)->name('admin.assignment.edit');
        //upload assignment routes

        Route::get('/assignments/course', AssignmentCourse::class)->name('admin.assignment.course'); //u
        Route::get('/assignments/review/{slug}', AssignmentReview::class)->name('assignment.review'); //u

        Route::get('/assignments/review-work/{id}', ReviewWork::class)->name('assignment.reviewWork');//u

        // Workshop Routes
        Route::get('/workshops', ManageWorkshop::class)->name('admin.workshops.index');

        // Placed Student Routes
        Route::get('/placedstudent/create', InsertPlacedStudent::class)->name('admin.placedstudent.create');
        Route::get('/placedstudent/manage', CallingPlacedStudent::class)->name('admin.placedstudent.index');
        Route::get('/placedstudent/{placedStudent?}', InsertPlacedStudent::class)->name('admin.placedstudent.edit')->whereNumber("placedStudent");

        //    certificate
        Route::get('/certificate', CertificateEligibility::class)->name('admin.certificate');
        //enquiry
        Route::get('/enquiry', ManageEnquiry::class)->name('admin.manage.enquiry');
        //blog
        Route::get("/blog/post-course", PostCourse::class)->name('admin.blog.post-course');

        Route::prefix('blog')->name('blog.')->group(function () {

            // Chapter Routes
            Route::get('/courses/{course}/chapters', ManageChapter::class)->name('chapters');

            // You might want to add these optional routes for better organization
            Route::get('/courses/create', [PostCourse::class, 'create'])->name('courses.create');
            Route::get('/courses/{course}/edit', [PostCourse::class, 'edit'])->name('courses.edit');
            Route::get('/chapters/create/{course}', [ManageChapter::class, 'create'])->name('chapters.create');
            Route::get('/chapters/{chapter}/edit', [ManageChapter::class, 'edit'])->name('chapters.edit');
            // Topic Routes
            Route::get('/chapters/{chapter}/topics', ManageTopic::class)->name('topics');
            //post routes
            Route::get('/topics/{topic}/posts', ManagePost::class)->name('posts');
        });
    });

});





Route::prefix('v2')->group(function () {


    Route::prefix("student")->group(function () {
        Route::get('/assignments/view', ManageAssignments::class)->name('student.assignments-view');
        Route::get('/take-exam', Exam::class)->name('student.takeExam');
        Route::get('/explore-courses', ExploreCourse::class)->name('student.exploreCourses');
        Route::get('/view-courses/{courseId}', ViewCourse::class)->name('student.viewCourses');
        Route::get('/my-courses', MyCourse::class)->name('v2.student.mycourses');
        Route::get('/edit-profile', EditProfile::class)->name('student.v2edit.profile');
        Route::get('/view-assigment', ViewAssigment::class)->name('student.v2view.assigment');
        Route::get('/view-assigment/{id}', ViewAssigment::class)->name('student.v2view.assigment');
        Route::get('/show-quiz/{courseId}', ShowQuiz::class)->name('v2.student.quiz');
        Route::get('/show-all-attempt/{course_id}', ShowAllAttempt::class)->name('v2.student.allAttempts');
        Route::get('show-quiz/result/{exam_id}', Result::class)->name('v2.student.examResult');
        route::get('/my-attendance', MyAttendance::class)->name('student.my-attendance');
        Route::get('/mocktest', SelectMockTest::class)->name('v2.student.mocktest');
        Route::get('/mocktest/{mockTestId}', ShowMockTest::class)->name('v2.student.mocktest.take');
        Route::get('/mocktest/result/{mockTestId}', MockTestResult::class)->name('v2.student.mocktest.result');


        Route::get('/products', OurProducts::class)->name('v2.student.products');
        Route::get('/products/{productId}/checkout', CheckOutPage::class)->name('v2.student.checkout');
    });

});

// public routes here:
Route::controller(PublicController::class)->group(function () {

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

Route::get('/workshop/{id}/enroll', [WorkshopController::class, 'buyWorkshop'])->name('workshop.enroll');

