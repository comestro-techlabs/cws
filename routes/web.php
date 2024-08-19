<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourseController;
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
    Route::resource("category", CategoryController::class)->except(['create','show']);
    Route::get("/search",[AdminController::class,"searchCourse"])->name('course.search');
});

// admin search Route
