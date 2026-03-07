<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    // ============================
    // ADMIN METHODS
    // ============================

    public function index()
    {
        $posts = Post::latest()->paginate(10);

        return view('posts.index', compact('posts'));
    }


    public function create()
    {
        return view('posts.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|max:255',
            'content' => 'required',
            'image'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $data = $request->only('title','content');

        // upload gambar
        if ($request->hasFile('image')) {

            $file = $request->file('image');

            $filename = time().'_'.$file->getClientOriginalName();

            $file->move(public_path('uploads'), $filename);

            $data['image'] = $filename;
        }

        Post::create($data);

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post berhasil dibuat.');
    }


    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }


    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }


    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title'   => 'required|max:255',
            'content' => 'required',
            'image'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $data = $request->only('title','content');

        if ($request->hasFile('image')) {

            // hapus gambar lama
            if ($post->image && file_exists(public_path('uploads/'.$post->image))) {
                unlink(public_path('uploads/'.$post->image));
            }

            $file = $request->file('image');

            $filename = time().'_'.$file->getClientOriginalName();

            $file->move(public_path('uploads'), $filename);

            $data['image'] = $filename;
        }

        $post->update($data);

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post berhasil diupdate.');
    }


    public function destroy(Post $post)
    {
        // hapus gambar
        if ($post->image && file_exists(public_path('uploads/'.$post->image))) {
            unlink(public_path('uploads/'.$post->image));
        }

        $post->delete();

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post berhasil dihapus.');
    }



    // ============================
    // USER VIEW
    // ============================

    public function userIndex()
    {
        $posts = Post::latest()->paginate(10);

        $topStories = Post::latest()->take(5)->get();

        return view('posts.user.index', compact('posts','topStories'));
    }


    public function userShow(Post $post)
    {
        return view('posts.user.show', compact('post'));
    }

}