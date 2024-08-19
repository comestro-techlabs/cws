<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\PublicControlller;
use Illuminate\Support\Facades\Route;

Route::controller(PublicControlller::class)->group(function(){
    Route::get("/","index")->name('public.index');
    Route::get("/register","apply")->name('public.apply');
    Route::post("/register","register")->name('public.register');
});


// admin Routes  
Route::prefix('admin')->group(function(){
    Route::get("/",[AdminController::class,"dashboard"])->name('admin.dashboard');
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
    Route::resource("category", CategoryController::class)->except(['create','show']);
    Route::get("/search",[AdminController::class,"searchCourse"])->name('course.search');
});

// admin search Route
