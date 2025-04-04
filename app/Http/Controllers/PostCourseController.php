<?php

namespace App\Http\Controllers;

use App\Models\PostCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class PostCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = PostCourse::all();

        return view('admin.post.dashboard', compact('courses'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();

        if ($request->hasFile('image')) {
            $filePath = $request->file('image')->store('images', 'public');
            $validated['image'] = $filePath;
        } else {
            $validated['image'] = 'icons/default-icon.png';
        }

        $validated['course_slug'] = Str::slug($validated['title']);

        $course = PostCourse::create($validated);

        return redirect()->back()->with('success', 'Course created successfully.');
    }


    public function show($id)
    {
        $course = PostCourse::with('chapters.topics.post')->find($id);

        if (!$course) {
            return redirect()->back()->with('error', 'Course not found.');
        }

        return view('courses.show', compact('course'));
    }


    public function update(Request $request, $id)
    {
        $course = PostCourse::find($id);

        if (!$course) {
            return redirect()->route('courses.index')->with('error', 'Course not found.');
        }
        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string|max:550',
            'image' => 'sometimes|required|image|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();

        if ($request->has('title')) {
            $validated['course_slug'] = Str::slug($validated['title']);
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('images', 'public');
        }

        $course->update($validated);

        return redirect()->route('courses.show', $course->id)->with('success', 'Course updated successfully.');
    }


    public function destroy($courseId)
    {
        $course = PostCourse::find($courseId);

        if (!$course) {
            return redirect()->route('courses.index')->with('error', 'Course not found.');
        }

        $course->delete();

        return redirect()->route('courses.index')->with('success', 'Course deleted successfully.');
    }
}
