@extends('layouts.app')

@section('content')
<div class="container mx-auto py-5">
    <h1 class="text-3xl font-bold mb-4">Create Post</h1>

    @if($errors->any())
        <div class="bg-red-200 text-red-800 p-2 rounded mb-4">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.posts.store') }}" method="POST" class="space-y-4 bg-white p-6 rounded shadow">
        @csrf
        <div>
            <label class="block mb-1 font-semibold">Title</label>
            <input type="text" name="title" class="border px-2 py-1 w-full" value="{{ old('title') }}">
        </div>
        <div>
            <label class="block mb-1 font-semibold">Content</label>
            <textarea name="content" class="border px-2 py-1 w-full">{{ old('content') }}</textarea>
        </div>
        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Save</button>
    </form>
</div>
@endsection
