<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // ADMIN METHODS (tetap seperti sebelumnya)
    public function index()
    {
        $posts = Post::latest()->paginate(5);
        return view('posts.index', compact('posts')); // admin view
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        Post::create($request->all());
        return redirect()->route('admin.posts.index')->with('success', 'Post berhasil dibuat.');
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post')); // admin detail
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $post->update($request->all());
        return redirect()->route('admin.posts.index')->with('success', 'Post berhasil diupdate.');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index')->with('success', 'Post berhasil dihapus.');
    }

    // ------------------------
    // USER METHODS
    // ------------------------

// Visitor / User
public function userIndex()
{
    $posts = Post::latest()->paginate(5);
    return view('posts.user.index', compact('posts')); // -> folder posts/user
}

public function userShow(Post $post)
{
    return view('posts.user.show', compact('post')); // -> folder posts/user
}


}
