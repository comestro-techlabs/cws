<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['courses'] = Course::all();
        return view("admin.manageCourse",$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.insertCourse');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'duration' => 'required',
            'instructor' => 'required',
            'fees' => 'required',
            'discounted_fee' => 'required',
            'image' => 'required',
        ]);

        $request->image->store("/public/image");
        $course = new Course();
        $course->title = $request->title;
        $course->description = $request->description;
        $course->duration = $request->duration;
        $course->instructor = $request->instructor;
        $course->fees = $request->fees;
        $course->discounted_fees = $request->discounted_fee;
        $course->course_image = $request->file('image')->hashName();
        $course->save();
        return redirect()->route('course.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        //
    }
}
