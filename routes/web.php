<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\PublicControlller;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

Route::controller(PublicControlller::class)->group(function(){
    Route::get("/","index")->name('public.index');
});


// admin Routes  
Route::prefix('admin')->group(function(){
    Route::get("/",[AdminController::class,"dashboard"])->name('admin.dashboard');
    Route::resource('course', CourseController::class);
    Route::get("/search",[AdminController::class,"searchCourse"])->name('course.search');
});

// admin search Route
