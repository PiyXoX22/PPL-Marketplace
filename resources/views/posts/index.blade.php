@extends('layouts.app')

@section('content')
<div class="container mx-auto py-5">
    <h1 class="text-3xl font-bold mb-4">Blog Posts</h1>

    <a href="{{ route('admin.posts.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Create New Post</a>

    @if(session('success'))
        <div class="bg-green-200 text-green-800 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="table-auto w-full border-collapse border border-gray-200">
        <thead>
            <tr class="bg-gray-100">
                <th class="border px-4 py-2">#</th>
                <th class="border px-4 py-2">Title</th>
                <th class="border px-4 py-2">Content</th>
                <th class="border px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($posts as $post)
                <tr>
                    <td class="border px-4 py-2">{{ $post->id }}</td>
                    <td class="border px-4 py-2">{{ $post->title }}</td>
                    <td class="border px-4 py-2">{{ Str::limit($post->content, 50) }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('admin.posts.show', $post) }}" class="text-blue-600">View</a> |
                        <a href="{{ route('admin.posts.edit', $post) }}" class="text-yellow-600">Edit</a> |
                        <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="border px-4 py-2 text-center">No posts yet.</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $posts->links() }}
    </div>
</div>
@endsection
