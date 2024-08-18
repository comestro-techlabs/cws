<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function create(Chapter $chapter)
    {
        return view('admin.lessons.create', compact('chapter'));
    }

    public function store(Request $request, Chapter $chapter)
    {
        $data= $request->validate([
            'title' => 'required|string|max:255',
            // Add any other validation rules for the lesson fields
        ]);

        $lesson = new Lesson($data);
        $chapter->lessons()->save($lesson);

        return redirect()->route('course.show', $chapter->course_id)
                         ->with('success', 'Lesson added successfully');
    }
}
