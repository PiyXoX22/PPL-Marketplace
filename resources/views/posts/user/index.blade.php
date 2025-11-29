@extends('layouts.blog')

@section('content')
<div class="container mx-auto py-8 px-4">
    <h1 class="text-4xl font-extrabold mb-8 text-center text-gray-800">Postingan Kami</h1>

    <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($posts as $post)
            <div class="bg-white rounded-lg shadow-lg hover:shadow-2xl transition-shadow duration-300">
                <div class="p-6 flex flex-col h-full">
                    <h2 class="text-2xl font-semibold mb-3 text-gray-900 hover:text-blue-500 transition-colors duration-200">
                        {{ $post->title }}
                    </h2>
                    <p class="text-gray-700 mb-4 flex-grow">{{ Str::limit($post->content, 150) }}</p>
                    <a href="{{ route('posts.show', $post) }}"
                       class="mt-auto inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition-colors duration-200 text-center">
                        Read More
                    </a>
                </div>
            </div>
        @empty
            <p class="text-center text-gray-500 col-span-full">No posts available.</p>
        @endforelse
    </div>

    <div class="mt-8 flex justify-center">
        {{ $posts->links() }}
    </div>
</div>
@endsection
