<?php

namespace App\Http\Controllers;

use App\Models\PostMyPost;
use Illuminate\Http\Request;

class PostMyPostContentController extends Controller
{

    //currently we are not using this show function because on admin side we don't need it
    public function show($topicId, $postId)
    {
        try {
            $post = PostMyPost::where('id', $postId)
                ->where('topic_id', $topicId)
                ->first();

            if (!$post) {
                return redirect()->route('posts.index', $topicId)
                    ->with('error', 'Post not found or does not belong to this topic.');
            }

            return view('posts.show', compact('post'));
        } catch (\Exception $e) {
            return redirect()->route('posts.index', $topicId)
                ->with('error', 'An error occurred while fetching the post details.');
        }
    }


    public function update(Request $request, $topicId, $postId)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048', 
        ]);

        try {
            $post = PostMyPost::where('id', $postId)
                ->where('topic_id', $topicId)
                ->first();

            if (!$post) {
                return redirect()->route('posts.index', $topicId)
                    ->with('error', 'Post not found or does not belong to this topic.');
            }

            $post->title = $validatedData['title'];
            $post->content = $validatedData['content'];

            if ($request->hasFile('image')) {
                if ($post->image && file_exists(storage_path('app/public/post/' . $post->image))) {
                    unlink(storage_path('app/public/post/' . $post->image));
                }

                $imagePath = $request->file('image')->store('post', 'public');
                $post->image = basename($imagePath);
            }

            $post->save();

            return redirect()->route('posts.show', [$topicId, $postId])
                ->with('success', 'Post updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('posts.show', [$topicId, $postId])
                ->with('error', 'An error occurred while updating the post.');
        }
    }


    public function destroy($topicId, $postId)
    {
        try {
            $post = PostMyPost::where('id', $postId)
                ->where('topic_id', $topicId)
                ->first();

            if (!$post) {
                return redirect()->route('posts.index', $topicId)
                    ->with('error', 'Post not found or does not belong to this topic.');
            }

            if ($post->image && file_exists(storage_path('app/public/post/' . $post->image))) {
                unlink(storage_path('app/public/post/' . $post->image));
            }

            $post->delete();

            return redirect()->route('posts.index', $topicId)
                ->with('success', 'Post deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('posts.index', $topicId)
                ->with('error', 'An error occurred while deleting the post.');
        }
    }
}
