    <?php

    use App\Http\Controllers\AdminController;
    use App\Http\Controllers\BatchController;
    use App\Http\Controllers\CategoryController;
    use App\Http\Controllers\ChapterController;
    use App\Http\Controllers\CourseController;
    use App\Http\Controllers\LessonController;
    use App\Http\Controllers\PublicController;
    use App\Http\Controllers\StudentController;
    use Illuminate\Support\Facades\Route;

    Route::controller(PublicController::class)->group(function () {

        Route::get("/", "index")->name('public.index');

        Route::prefix('training')->group(function () {

            Route::get("/", "training")->name('public.training');
            Route::get("/register", "apply")->name('public.apply');
            Route::get("/register/success", "success")->name('public.success');
            Route::post("/register", "register")->name('public.register');
            Route::get('/courses/{id}', 'courseDetails')->name('public.courseDetails');
        });

        Route::get('/login', [PublicController::class, 'showLoginForm'])->name('login.form');
        Route::post('/login', [PublicController::class, 'login'])->name('login');
        Route::get('/logout', [PublicController::class, 'logout'])->name('logout');
    });

    Route::get('/services', [PublicController::class, 'servicePage'])->name('public.services');
    Route::get('/about', [PublicController::class, 'aboutPage'])->name('public.about');
    Route::get('/contact', [PublicController::class, 'contactUsPage'])->name('public.contact');
    Route::get('/web-design', [PublicController::class, 'webDesignPage'])->name('public.web-design');
    Route::get('/ecommerce',[PublicController::class, 'ecommercePage'])->name('public.ecommerce');
    Route::get('/coaching',[PublicController::class, 'coachingPage'])->name('public.coaching');
    Route::post('/',[PublicController::class, 'hireUs'])->name('public.hireUs');
   
    Route::post('/enquiry-store', [PublicController::class, 'storeEnquiry'])->name('enquiry.store');


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

    });

    // admin search Route
