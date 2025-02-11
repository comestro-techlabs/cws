<?php

namespace App\Http\Controllers;

use App\Models\PostMyPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostMyPostController extends Controller
{
    public function index($topicId)
    {
        $posts = PostMyPost::where('post_topic_post_id', $topicId)->get();

        return view('admin.post.topicContent', compact('posts', 'topicId'));
    }




    // For displaying specified post
    public function show($topicId, $postId)
    {
        $post = PostMyPost::where('topic_id', $topicId)->where('id', $postId)->first();

        if (!$post) {
            return redirect()->route('posts.index', $topicId)->with('error', 'Post not found.');
        }

        return view('posts.show', compact('post'));
    }

    //for storing the post
    public function store(Request $request, $topicId)
    {
        // Validate the request inputs
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        if ($validator->fails()) {
            return redirect()->route('posts.index', $topicId)->withErrors($validator)->withInput();
        }

        $imagePath = null;

        // Handle the uploaded image file, if provided
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public'); // Save the image in the "public/posts" directory
        }

        // Create a new post for the given topic ID
        PostMyPost::create([
            'topic_id' => $topicId, // Link the post to the given topic ID
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'image_path' => $imagePath, // Save the image path if uploaded
        ]);

        return redirect()->route('posts.index', $topicId)->with('success', 'Post created successfully.');
    }



    //for updating the post
    public function update(Request $request, $topicId, $postId)
    {
        // Validate the request inputs
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image',
        ]);

        if ($validator->fails()) {
            return redirect()->route('posts.show', [$topicId, $postId])->withErrors($validator)->withInput();
        }

        $post = PostMyPost::where('topic_id', $topicId)->where('id', $postId)->first();

        if (!$post) {
            return redirect()->route('posts.index', $topicId)->with('error', 'Post not found.');
        }

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
            $post->update(['image_path' => $imagePath]);
        }

        // Update the post
        $post->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);

        return redirect()->route('posts.show', [$topicId, $postId])->with('success', 'Post updated successfully.');
    }

    //for deleting the post
    public function destroy($topicId, $postId)
    {
        $post = PostMyPost::where('topic_id', $topicId)->where('id', $postId)->first();
    
        if (!$post) {
            return redirect()->route('posts.index', $topicId)->with('error', 'Post not found.');
        }
    
        $post->delete();
    
        return redirect()->route('posts.index', $topicId)->with('success', 'Post deleted successfully.');
    }
    
}
