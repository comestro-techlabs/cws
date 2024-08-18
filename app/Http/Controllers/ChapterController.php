<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\Course;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($course_id)
    {
        $course = Course::findOrFail($course_id);
        return view('admin.chapter.create', compact('course'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $course_id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $chapter = new Chapter();
        $chapter->course_id = $course_id;
        $chapter->title = $request->input('title');
        $chapter->save();

        return redirect()->route('course.show', $course_id)->with('success', 'Chapter added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Chapter $chapter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chapter $chapter)
    {
        return view('admin.chapter.edit', compact('chapter'));
    }

    public function update(Request $request, Chapter $chapter)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            // Add any other validation rules here
        ]);

        $chapter->update($data);

        return redirect()->route('course.show', $chapter->course_id)
                         ->with('success', 'Chapter updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $chapter = Chapter::findOrFail($id);
        $chapter->delete();
    
        return redirect()->back()->with('success', 'Chapter deleted successfully');
    }
}
