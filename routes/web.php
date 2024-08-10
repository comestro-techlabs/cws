<?php

use App\Http\Controllers\PublicControlller;
use Illuminate\Support\Facades\Route;

Route::get('/', function(){
    return view('welcome');
});

// Route::get('/',function(){
//     return view("public.layout");
// });