<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function showCreatePost() {
        return view('create-post');
    }

    public function viewSinglePost(Post $post) {
        return view('single-post', ['post' => $post]);
    }

    public function createPost(Request $request) {
        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);
        $incomingFields['user_id'] = auth()->id();

        $newPost = Post::create($incomingFields);

        return redirect("/post/{$newPost->id}")->with('success', 'New post successfully created');
    }

    public function delete(Post $post) {
        $post->delete();

        return redirect(auth()->user()->username)-with('success', 'Post successfully deleted');
    }

    public function showEditForm(Post $post) {
        return view('edit-post', ['post' => $post]);
    }
    public function actuallyUpdate(Post $post, Request $request) {
        $incomingFields = $request->validate(['title' => 'required', 'body' => 'required']);
        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);

        $post->update($incomingFields);
        return back()->with('success', 'Post Successfully Updated');
    }
}
