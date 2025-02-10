<?php

namespace App\Http\Controllers;

use App\Models\PostChapter;
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
        $chapter = PostChapter::all();

        return response()->json([
            'status' => 200,
            'data' => $chapter
        ]);
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
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ], 422);
        }
        $validated = $validator->validated();
        $validated["chapter_slug"] = Str::slug($validated['chapter_name']);
        $chapter = PostChapter::create($validated);
        return response()->json([
            'message' => 'Chapter Created Successfully',
            'chapter' => $chapter,

        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)

    {
        $chapter = PostChapter::with(['topics.post'])->find($id);

        if (!$chapter) {
            return response()->json([
                'message' => 'chapter not found',
            ], 404);
        }

        return response()->json([
            'message' => 'chapter Fetched Successfully',
            'data' => $chapter,
        ], 200);
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
            return response()->json(['message' => 'Chapter not found'], 404);
        }

        $chapter->update($validatedData);

        return response()->json(['message' => 'Chapter updated successfully', 'data' => $chapter], 200);
    }


    public function destroy($chapterId)
    {
        $chapter = PostChapter::where('id', $chapterId)->first();
        if (!$chapter) {
            return response()->json(['error' => 'Chapter not found'], 404);
        }
        //delete chapter with all topics and post
        $chapter->delete();
        return response()->json(['message' => 'Chapter and related data deleted successfully.'], 200);
    }
    
}
