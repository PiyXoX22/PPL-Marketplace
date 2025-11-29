@extends('layouts.blog')

@section('content')
<div class="container mx-auto py-5 bg-white p-6 rounded shadow">
    <h1 class="text-3xl font-bold mb-4">{{ $post->title }}</h1>
    <p class="mb-4">{{ $post->content }}</p>
    <a href="{{ route('posts.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Back</a>
</div>
@endsection
