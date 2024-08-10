<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\PublicControlller;
use Illuminate\Support\Facades\Route;

Route::get('/', function(){
    return view('welcome');
});

// Route::get('/',function(){
//     return view("public.layout");
// });


// admin Routes  
Route::prefix('admin')->group(function(){
    Route::get("/",[AdminController::class,"dashboard"])->name('admin.dashboard');
    Route::resource('course', CourseController::class);
});