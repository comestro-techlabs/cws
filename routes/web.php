<?php

use App\Http\Controllers\PublicController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\WorkshopController;
use Illuminate\Support\Facades\Artisan;
// use Livewire\Livewire;


use App\Livewire\Admin\Assignment\ManageAssignment;
use App\Livewire\Admin\Assignment\ReviewWork;

use App\Livewire\Admin\Dashboad;
use App\Livewire\Admin\ManageEnquiry;
use App\Livewire\Admin\Student\AttendanceCalendar;
use App\Livewire\Admin\Student\ManageStudent;
use App\Livewire\Admin\Subscription\InsertSubscription;
use App\Livewire\Auth\Facebook;
use App\Livewire\Auth\Github;
use App\Livewire\Auth\LinkedinLogin;
use App\Livewire\Student\Dashboard\Takeexam\Result;
use App\Livewire\Student\Dashboard\Takeexam\ShowAllAttempt;
use App\Livewire\Student\Dashboard\Takeexam\ShowQuiz;
use App\Livewire\Student\MyAttendance;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
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
use App\Livewire\Admin\Course\ShowBatch;
use App\Livewire\Admin\Certificate\ManageCertificate;
use App\Livewire\Admin\Certificate\ViewDetail;
use App\Livewire\Admin\Exam\ManageExam;
use App\Livewire\Admin\Exam\ExamQuestions;
use App\Livewire\Admin\Quiz\ManageQuiz;
use App\Livewire\Admin\Result\ManageResult;
use App\Livewire\Admin\MockTest\ManageMockTest;
use App\Livewire\Admin\Store\ManageOrders;
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
use App\Livewire\Public\Mocktest\SelectMockTest as PublicSelectMockTest;
use App\Livewire\Public\Mocktest\ShowMockTest as PublicShowMockTest;
use App\Livewire\Public\Mocktest\MockTestResult as PublicMockTestResult;
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
use App\Http\Controllers\SubscriptionController;
use App\Livewire\Admin\Store\ManageProducts;
use App\Livewire\Student\Billing\ShowBilling;
use App\Livewire\Student\Subscriptions\Plans;
use App\Livewire\Student\Marksheet\StudentMarksheet;
use App\Livewire\Student\Certificate\ShowCertificate;
use App\Livewire\Admin\MockTest\ManageQuestions;
use App\Livewire\Admin\Store\ManageProductCategories;
use App\Livewire\Admin\Subscription\ViewSubcriptions;
use App\Livewire\Auth\ForgetPassword;
use App\Livewire\Auth\ResetPassword;
use App\Livewire\Public\Myeditor\Monaco;
use App\Livewire\Public\Viewallcourses\FreeCourses;
use App\Livewire\Student\Dashboard\Product\MyOrders;
use App\Livewire\Public\AboutUs;
use App\Livewire\Public\ContactUs;
use App\Livewire\Public\TermsAndConditions;
use App\Livewire\Public\PrivacyPolicy;
use App\Livewire\Public\Workshops\ViewWorkshop;

// Livewire::setUpdateRoute(function ($handle) {
//     return Route::post('/learnsyntax/public/livewire/update', $handle);
// });

// public routes
Route::get('/', Home::class)->name('public.index');
Route::get('/courses', AllCourses::class)->name('public.viewallcourses.all-courses');
Route::get('/free-courses',FreeCourses::class)->name('public.free-courses');
Route::get('/contact', ContactPage::class)->name('public.contactUs');
Route::get('/workshops', Workshop::class)->name('public.workshop');
Route::get('/workshops/{id}', ViewWorkshop::class)->name('workshops.view');

Route::get('/about-us', AboutUs::class)->name('public.about.us');
Route::get('/contact-us', ContactUs::class)->name('public.contact.us');
Route::get('/terms-and-conditions', TermsAndConditions::class)->name('public.terms');
Route::get('/privacy-policy', PrivacyPolicy::class)->name('privacy-policy');
Route::get('/practice-tests', PublicSelectMockTest::class)->name('public.mocktest');
Route::get('/practice-tests/{mockTestId}', PublicShowMockTest::class)->name('public.mocktest.take');
Route::get('/practice-tests/result/{mockTestId}', PublicMockTestResult::class)->name('public.mocktest.result');

//blog courses routes
Route::get('/course/{course_slug}/chapter/show', CourseWithChapterAndTopic::class)->name('v2.courses.show');
Route::get('/course/{course_slug}/chapter/{chapter_slug?}/topic/{topic_slug?}/show', TopicWithPostContent::class)->name('v2.topics.show');

Route::get('/courses/{slug}', Ourcourses::class)->name('public.courseDetail');

//auth routes
Route::prefix('auth')->group(function () {
    Route::get('/login', Login::class)->name('auth.login');
    Route::get('/forget-password', ForgetPassword::class)->name('auth.forget-password');
    Route::get('/reset-password/{token}', ResetPassword::class)->name('password.reset');

    Route::post('/logout', [Header::class, 'logout'])->name('auth.logout'); // Changed to POST
    Route::get('/google', [GoogleLogin::class, 'redirectToGoogle'])
        ->name('auth.google.login')
        ->middleware('guest');
    Route::get('/google/callback', [GoogleLogin::class, 'handleGoogleCallback'])
        ->name('auth.google.callback')
        ->middleware('guest');
    Route::get('/github/redirect', [Github::class, 'redirectToGithub'])->name('github.redirect');
    Route::get('/github/callback', [Github::class, 'handleGithubCallback'])->name('github.callback');
    Route::get('/linkedin/redirect', [LinkedinLogin::class, 'redirectToLinkedin'])->name('linkedin.redirect');
    Route::get('/linkedin-openid/callback', [LinkedinLogin::class, 'handleLinkedinCallback'])->name('linkedin.callback');
    Route::get('/facebook/redirect', [Facebook::class, 'redirectToFacebook'])->name('facebook.redirect');
    Route::get('/facebook/callback', [Facebook::class, 'handleFacebookCallback'])->name('facebook.callback');
    Route::get('/register', App\Livewire\Auth\Register::class)->name('auth.register');

});
//protected routes
Route::middleware('auth')->group(function () {
    //student routes
    Route::prefix("student")->group(function () {
        Route::get('/dashboard', StudentDashboard::class)->name('student.dashboard');
        Route::get('/billing', ViewBilling::class)->name('student.billing');
        Route::get('/billing/{paymentId}', ShowBilling::class)->name('student.viewbilling');
        Route::get('/rewards/gems', GemsTransactions::class)->name('student.rewards.gems');
        Route::get('/subscriptions/plans', Plans::class)->name('student.subscriptions.plans');
        Route::post('/subscriptions/process', [SubscriptionController::class, 'process'])->name('student.subscriptions.process');
        Route::post('/subscriptions/initiate', [Plans::class, 'initializePayment'])->name('student.subscriptions.initiate');
        Route::get('/subscription/success', [Plans::class, 'handleSuccess'])->name('student.subscriptions.success');
        Route::get('/subscription/cancel', [Plans::class, 'handleCancel'])->name('student.subscriptions.cancel');
        Route::get('/assignments/view', ManageAssignments::class)->name('student.assignments-view');
        Route::get('/explore-courses', ExploreCourse::class)->name('student.exploreCourses');
        Route::get('/view-courses/{courseId}', ViewCourse::class)->name('student.viewCourses');
        Route::get('/my-courses', MyCourse::class)->name('v2.student.mycourses');
        Route::get('/edit-profile', EditProfile::class)->name('student.v2edit.profile');
        Route::get('/view-assigment', ViewAssigment::class)->name('student.v2view.assigment');
        Route::get('/view-assigment/{id}', ViewAssigment::class)->name('student.v2view.assigment');
        Route::get('/take-exam', Exam::class)->name('student.takeExam');
        Route::get('/show-quiz/{courseId}', ShowQuiz::class)->name('v2.student.quiz');
        Route::get('/show-all-attempt/{course_id}', ShowAllAttempt::class)->name('v2.student.allAttempts');
        Route::get('/exam/result/{examId}', Result::class)->name('v2.student.examResult');
        route::get('/my-attendance', MyAttendance::class)->name('student.my-attendance');
        Route::get('/mocktest', SelectMockTest::class)->name('v2.student.mocktest');
        Route::get('/mocktest/{mockTestId}', ShowMockTest::class)->name('v2.student.mocktest.take');
        Route::get('/mocktest/result/{mockTestId}', MockTestResult::class)->name('v2.student.mocktest.result');
        Route::get('/products', OurProducts::class)->name('v2.student.products');
        Route::get('/products/{productId}/checkout', CheckOutPage::class)->name('v2.student.checkout');
        Route::get('/certificates',ShowCertificate::class)->name('student.certificates');
        Route::get('/marksheet',StudentMarksheet::class)->name('student.marksheet');
        Route::get('/code-editor', Monaco::class)->name('v2.student.code-editor');

        Route::get('/my-orders',MyOrders::class)->name('student.my-orders');

    });

});

Route::get('/get-access-token', [StudentController::class, 'store']);
Route::post('/student/assignments/upload/{assignment_id}', [StudentController::class, 'store'])->name('assignments.store');

// //razorpay routes
Route::post('/initiate-payment', [PaymentController::class, 'initiatePayment'])->name('store.payment.initiation');
Route::post('/payment-response', [PaymentController::class, 'handlePaymentResponse'])->name('handle.payment.response');
Route::post('/refresh-payment-status', [PaymentController::class, 'refreshPaymentStatus'])->name('refresh.payment.status');
Route::post('/update-payment-status', [PaymentController::class, 'updatePaymentStatus'])->name('update.payment.status');
Route::post('/create-razorpay-order', [PaymentController::class, 'createRazorpayOrder'])->name('create.razorpay.order');
Route::get('/process-overdue-payments', [PaymentController::class, 'processOverduePayments']);

Route::middleware([AdminMiddleware::class, 'auth'])->group(function () {
    Route::prefix('admin')->group(function () {

    });

    // Version 2 Routes (Livewire)
    Route::prefix('v2/admin')->group(function () {
        Route::get('/dashboard', Dashboad::class)->name('admin.dashboard');
        Route::get('/logout', [Dashboad::class, 'logout'])->name('admin.logout');
        Route::get('/category', ManageCategory::class)->name('admin.category');
        Route::get('/student', ManageStudent::class)->name('admin.student');
        Route::get('/view-subscription', ViewSubcriptions::class)->name('admin.view-subscription');
        // Route::get('/student/{id}', ViewStudent::class)->name('admin.student.view');
        //course routes
        Route::get('/course', InsertCourse::class)->name('admin.course');
        Route::get('/course/update/{courseId}', UpdateCourse::class)->name('admin.course.update');
        Route::get('/course/manage', ManageCourse::class)->name('admin.course.manage');
        Route::get('/student/{id}', ViewStudent::class)->name('admin.student.view');
        Route::get('/batch',ShowBatch::class)->name('admin.batch');
        Route::get('/course/update/{courseId}', UpdateCourse::class)->name('admin.course.update');
        Route::get("/admin/attendace", AttendanceScanner::class)->name('admin.attendance');
        Route::get("/subscription/insert-subscription", InsertSubscription::class)->name('admin.insert_subscription');

        //exam routes
        Route::get('/exam', ManageExam::class)->name('admin.exam');
        Route::get('/exam/{examId}/questions', ExamQuestions::class)->name('admin.exam.questions');
        Route::get('/quiz/{examId}/questions', ManageQuiz::class)->name(name: 'admin.quiz');
        Route::get('/student/attendance/calendar/{studentId}', AttendanceCalendar::class)->name('admin.student.attendance.calendar');

        //result routes

        Route::get('/results', ManageResult::class)->name('results');

        //mocktest routes
        Route::get('/mocktest', ManageMockTest::class)->name('admin.mocktest');
        Route::get('/mock-test/{mockTestId}/questions', ManageQuestions::class)->name('admin.mock-test.questions');
        // Assignment Routes
        Route::get('/assignment/manage', ManageAssignment::class)->name('admin.assignment.manage');

        Route::get('/assignments/review-work/{id}', ReviewWork::class)->name('assignment.reviewWork');//u
        //Certificate Routes
        Route::get('/certificate/course',ManageCertificate::class)->name('admin.certificate.course');
        Route::get('/certificate/view-detail/{studentId}/{courseId}', ViewDetail::class)->name('certificate.view-detail');
       

        // Workshop Routes certificate/course
        Route::get('/workshops', ManageWorkshop::class)->name('admin.workshops.index');

        // Placed Student Routes
        Route::get('/placedstudent/manage', CallingPlacedStudent::class)->name('admin.placedstudent.index');

       
        //enquiry
        Route::get('/enquiry', ManageEnquiry::class)->name('admin.manage.enquiry');
        //manage-orders
        Route::get('/products-manage',ManageProducts::class)->name('v2.admin.manageProducts');
        Route::get('/manage-orders', ManageOrders::class)->name('v2.student.manageOrders');
        Route::get('/manage-product-categories',ManageProductCategories::class)->name('v2.admin.manageCategories');


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
// public routes here:
Route::controller(PublicController::class)->group(function () {
   // Route::get('/about', 'aboutPage')->name('public.about');
    //Route::get('/contact', 'contactUsPage')->name('public.contact');
    //Route::get('/privacy-policy', 'privacyAndPolicy')->name('public.privacy');
    //Route::get('/terms-conditions', 'termsAndConditions')->name('public.terms-conditions');
    Route::post('/enquiry-store', 'storeEnquiry')->name('enquiry.store');
});


Route::get('generate', function () {
    \Illuminate\Support\Facades\Artisan::call('storage:link');
    echo 'ok';
});Route::get('/workshop/{id}/enroll', [WorkshopController::class, 'buyWorkshop'])->name('workshop.enroll');


// Route::get('/storage-link', function () {
//     Artisan::call('storage:link');
//     return 'Storage link has been created!';
// });

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('optimize:clear');
    return "All Caches are cleared by @Roni";
});



