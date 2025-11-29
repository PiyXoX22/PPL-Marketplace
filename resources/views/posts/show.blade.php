@extends('layouts.app')

@section('content')
<div class="container mx-auto py-5 bg-white p-6 rounded shadow">
    <h1 class="text-3xl font-bold mb-4">{{ $post->title }}</h1>

    <p class="mb-4">{{ $post->content }}</p>

    <div class="flex space-x-4">
        <a href="{{ route('admin.posts.edit', $post) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Edit</a>
        <form action="{{ route('admin.posts.destroy', $post) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600" onclick="return confirm('Are you sure?')">Delete</button>
        </form>
        <a href="{{ route('admin.posts.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Back</a>
    </div>
</div>
@endsection
