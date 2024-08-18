<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['courses'] = Course::paginate(20);
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
        ]);

        $course = new Course();
        $course->title = $request->title;
        $course->slug = Str::slug($request->title);
        $course->save();
        return redirect()->route('course.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        $categories = Category::all();  // Assuming Category model exists and has all categories
        return view("admin.viewCourse", array("course" => $course,'categories' => $categories));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        return view('admin.edit_course', ['course' => $course]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id, $field)
    {
        $course = Course::findOrFail($id);
    
        // Validate only the field being updated
        $validatedData = $request->validate([
            $field => 'required' // Add more validation rules based on your needs
        ]);
    
        // Update the specific field
        $course->update($validatedData);
    
        return redirect()->route('course.show', $course->id)->with('success', ucfirst($field) . ' updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        Course::find($course->id)->delete();
        return redirect()->route('course.index');
    }

    
}
