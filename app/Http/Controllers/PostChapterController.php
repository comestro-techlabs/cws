<?php

namespace App\Http\Controllers;

use App\Models\PostChapter;
use App\Models\PostCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class PostChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($courseId)
    {
        $chapters = PostChapter::where('post_course_id', $courseId)->get();

        if ($chapters->isEmpty()) {
            return redirect()->back()->with('error', 'Chapters not found.');
        }

        return view('admin.post.chapterWithTopic', compact('chapters'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'course_id' => 'required',
            'chapter_name' => 'required|string',
            'chapter_description' => 'required|string',
            'order' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return redirect()->route('chapters.create', $request->course_id)
                ->withErrors($validator)
                ->withInput();
        }

        $validated = $validator->validated();

        $validated["chapter_slug"] = Str::slug($validated['chapter_name']);

        $chapter = PostChapter::create($validated);

        return redirect()->route('courses.show', $validated['course_id'])
            ->with('success', 'Chapter created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $chapter = PostChapter::with(['topics.post'])->find($id);

        if (!$chapter) {
            return redirect()->route('chapters.index')->with('error', 'Chapter not found.');
        }
        return view('chapters.show', compact('chapter'));
    }



    public function update(Request $request, $course_id, $chapter_id)
    {
        $validatedData = $request->validate([
            'chapter_name' => 'required|string',
            'chapter_description' => 'required|string',
            'order' => 'required|integer',
        ]);

        $chapter = PostChapter::where('course_id', $course_id)->where('id', $chapter_id)->first();

        if (!$chapter) {
            return redirect()->route('courses.show', $course_id)->with('error', 'Chapter not found.');
        }

        $chapter->update($validatedData);

        return redirect()->route('courses.show', $course_id)->with('success', 'Chapter updated successfully.');
    }



    public function destroy($courseId, $chapterId)
    {
        $chapter = PostChapter::where('course_id', $courseId)->where('id', $chapterId)->first();

        if (!$chapter) {
            return redirect()->route('courses.show', $courseId)->with('error', 'Chapter not found.');
        }

        $chapter->delete();

        return redirect()->route('courses.show', $courseId)->with('success', 'Chapter and related data deleted successfully.');
    }
}
