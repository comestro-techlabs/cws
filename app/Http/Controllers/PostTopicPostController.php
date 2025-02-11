<?php

namespace App\Http\Controllers;

use App\Models\PostTopicPost;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class PostTopicPostController extends Controller
{
    public function store(Request $request, $chapterId)
    {
        $validatedData = $request->validate([
            'topic_name' => 'required|string|max:255',
            'topic_description' => 'nullable|string',
            'order' => 'nullable|integer',
        ]);

        $topic = new PostTopicPost();
        $topic->chapter_id = $chapterId;
        $topic->topic_name = $validatedData['topic_name'];
        $topic->topic_description = $validatedData['topic_description'];
        $topic->order = $validatedData['order'] ?? 0;
        $topic->topic_slug = Str::slug($validatedData['topic_name']);
        $topic->save();

        return redirect()->route('chapters.show', $chapterId)->with('success', 'Topic added successfully');
    }


    // Update a topic
    public function update(Request $request, $chapterId, $topicId)
    {
        $topic = PostTopicPost::where('chapter_id', $chapterId)->where('id', $topicId)->first();

        if (!$topic) {
            return redirect()->route('chapters.show', $chapterId)->with('error', 'Topic not found');
        }

        $validatedData = $request->validate([
            'topic_name' => 'sometimes|required|string',
            'topic_description' => 'sometimes|required|string',
            'order' => 'sometimes|required|integer',
        ]);

        if (isset($validatedData['topic_name'])) {
            $validatedData['topic_slug'] = Str::slug($validatedData['topic_name']);
        }

        $topic->update($validatedData);

        return redirect()->route('chapters.show', $chapterId)->with('success', 'Topic updated successfully');
    }



    //Showing  a specific topic
    public function show($chapterId, $topicId)
    {
        $topic = PostTopicPost::where('chapter_id', $chapterId)->where('id', $topicId)->first();

        if (!$topic) {
            return redirect()->route('chapters.show', $chapterId)->with('error', 'Topic not found');
        }

        return view('topics.show', compact('topic'));
    }


    //Showing every topic of chapter
    public function index($chapterId)
    {
        $topics = PostTopicPost::where('chapter_id', $chapterId)->orderBy('order', 'asc')->get();

        if ($topics->isEmpty()) {
            return redirect()->route('chapters.show', $chapterId)->with('error', 'No topics found for this chapter');
        }

        return view('topics.index', compact('topics'));
    }


    // Delete a topic
    public function destroy($chapterId, $topicId)
    {
        $topic = PostTopicPost::where('chapter_id', $chapterId)->where('id', $topicId)->first();

        if (!$topic) {
            return redirect()->route('chapters.show', $chapterId)->with('error', 'Topic not found');
        }

        $topic->delete();

        return redirect()->route('chapters.show', $chapterId)->with('success', 'Topic deleted successfully');
    }
}
