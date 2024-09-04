    <?php

    use App\Http\Controllers\AdminController;
    use App\Http\Controllers\AuthController;
    use App\Http\Controllers\BatchController;
    use App\Http\Controllers\CategoryController;
    use App\Http\Controllers\ChapterController;
    use App\Http\Controllers\CourseController;
    use App\Http\Controllers\EnquiryController;
    use App\Http\Controllers\LessonController;
    use App\Http\Controllers\PublicController;
    use App\Http\Controllers\StudentController;
    use App\Http\Controllers\PaymentController;
    use App\Models\Enquiry;
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\Auth\SocialiteController;

    Route::get('auth/google', [SocialiteController::class, 'redirectToGoogle'])->name('auth.google');
    Route::get('auth/google/callback', [SocialiteController::class, 'handleGoogleCallback']);

    Route::controller(PublicController::class)->group(function () {

        Route::get("/", "index")->name('public.index');

        Route::prefix('training')->group(function () {

            Route::get("/", "training")->name('public.training');
            Route::get("/register/success", "success")->name('public.success');
            Route::get('/courses/{id}', 'courseDetails')->name('public.courseDetails');
        });

        // Route::get('/login', [PublicController::class, 'showLoginForm'])->name('login.form');
        // Route::post('/login', [PublicController::class, 'login'])->name('login');
        // Route::get('/logout', [PublicController::class, 'logout'])->name('logout');
    });

    Route::get('/about', [PublicController::class, 'aboutPage'])->name('public.about');
    Route::get('/contact', [PublicController::class, 'contactUsPage'])->name('public.contact');
    Route::get('/coaching', [PublicController::class, 'coachingPage'])->name('public.coaching');

    // services route's group:
    Route::prefix("services")->group(function(){
        Route::controller(PublicController::class)->group(function(){
            Route::get('/seo-services', 'seoServices')->name('public.services.seo-services');
            Route::get('/web-dev', 'webDevPage')->name('public.services.web-dev');
            Route::get('/mobile-app', 'mobileAppPage')->name('public.services.mobile-app');
            Route::get('/web-design', 'webDesignPage')->name('public.services.web-design');
            Route::get('/software-dev', 'softwareDev')->name('public.services.software-dev');
            Route::get('/native-app', 'nativeApp')->name('public.services.native-app');
            Route::get('/inventory-solution', 'inventorySolution')->name('public.services.invent-sol');
            Route::get('/services', 'servicePage')->name('public.services.services');
            Route::get('/ecommerce', 'ecommercePage')->name('public.services.ecommerce');
        });
    });


    Route::get('/seo-services', [PublicController::class, 'seoServices'])->name('public.seo_services');


    Route::post('/enquiry-store', [EnquiryController::class, 'storeEnquiry'])->name('enquiry.store');


    Route::prefix("student")->group(function () {
        Route::controller(StudentController::class)->group(function () {
            Route::get('/dashboard', 'dashboard')->name('student.dashboard');
        });
    });

    // admin Routes  
    Route::prefix('admin')->group(function () {
        Route::get("/", [AdminController::class, "dashboard"])->name('admin.dashboard');

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


    // Authentication route's group here
    Route::prefix('auth')->controller(AuthController::class)->group(function () {
        Route::get('/login', 'showLoginForm')->name('auth.login');
        Route::post('/login', 'login')->name('auth.login.post');
        Route::get('/register', 'showRegistrationForm')->name('auth.register');
        Route::post('/register', 'register')->name('auth.register.post');
        Route::get('/logout', 'logout')->name('auth.logout');
    });



Route::post('save-course-payment', [PaymentController::class, 'saveCoursePayment'])->name('save.course.payment');
Route::get('course-payment-success/{token_no}', [PaymentController::class, 'coursePaymentSuccess'])->name('course.payment.success');

