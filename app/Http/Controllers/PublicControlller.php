<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class PublicControlller extends Controller
{
    public function index(){
        $courses = Course::all();
        return view("public.homepage")->with('courses', $courses);
    }

    public function logIn(){

    }

    public function apply(){

    }

    public function viewCourse(){

    }
}
