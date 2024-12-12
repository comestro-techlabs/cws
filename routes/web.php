    <?php

    use App\Http\Controllers\AdminController;
    use App\Http\Controllers\AuthController;
    use App\Http\Controllers\BatchController;
    use App\Http\Controllers\CategoryController;
    use App\Http\Controllers\ChapterController;
    use App\Http\Controllers\CourseController;
    use App\Http\Controllers\EnquiryController;
    use App\Http\Controllers\LessonController;
    use App\Http\Controllers\PhonepeController;
    use App\Http\Controllers\PublicController;
    use App\Http\Controllers\StudentController;
    use App\Http\Controllers\PaymentController;
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\Auth\SocialiteController;
    use App\Http\Middleware\AdminMiddleware;

    Route::prefix("student")->group(function () {
        Route::controller(StudentController::class)->group(function () {
            Route::get('/dashboard', 'dashboard')->name('student.dashboard');
            Route::get('/billing', 'billing')->name('student.billing');
        });
    });
    Route::post('save-course-payment', [PaymentController::class, 'saveCoursePayment'])->name('save.course.payment');


    Route::middleware([AdminMiddleware::class, "auth"])->group(function () {

        Route::prefix('admin')->group(function () {
            Route::get("/", [AdminController::class, "dashboard"])->name('admin.dashboard');
            Route::get('/manage-payment', [AdminController::class, "managePayment"])->name('admin.manage-payment');
            Route::get('/payment/{id}', [AdminController::class, "viewPayment"])->name('admin.payment.view');


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
        Route::get('/register', 'showRegistrationForm')->name('auth.register');
        Route::post('/register', 'register')->name('auth.register.post');
        Route::get('/logout', 'logout')->name('auth.logout');
    });



    Route::get('/launch', function () {
        return view('public.launch');
    });
    

    // Route::get('/user/{id}/courses', [AdminController::class, 'showPurchasedCourses'])->name('user.courses');


    Route::get('/phonepe/payment', [PhonepeController::class, 'index'])->name('phonepe.payment');
    Route::post('/phonepe/initiate', [PhonepeController::class, 'initiatePayment'])->name('phonepe.initiate');
    Route::post('/phonepe/callback', [PhonePeController::class, 'callback'])->name('phonepe.callback');
    Route::get('/phonepe/status/{transactionId}', [PhonePeController::class, 'checkStatus'])->name('phonepe.status');
    // Route::post('/phonepe/refund', [PhonePeController::class, 'refund'])->name('phonepe.refund');
    Route::get('/phonepe/redirect', [PhonePeController::class, 'redirect'])->name('phonepe.redirect');
