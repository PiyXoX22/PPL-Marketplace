@extends('layouts.blog')

@section('content')

<div class="bg-black text-white min-h-screen">

    {{-- HERO SECTION --}}
    @if($posts->count() > 0)

    @php $hero = $posts->first(); @endphp

    <div class="max-w-7xl mx-auto px-6 py-12 grid md:grid-cols-4 gap-10">

        {{-- HERO POST --}}
        <div class="md:col-span-3">

            <img src="{{ $hero->image ? asset('uploads/'.$hero->image) : 'https://via.placeholder.com/1200x700' }}"
                 class="w-full h-[420px] object-cover rounded-lg shadow-lg">

            <h1 class="mt-6 text-4xl md:text-5xl font-bold text-purple-400 leading-tight">
                {{ $hero->title }}
            </h1>

            <p class="mt-4 text-gray-300 max-w-2xl">
                {{ Str::limit($hero->content,200) }}
            </p>

            <a href="{{ route('posts.show',$hero) }}"
               class="inline-block mt-5 text-green-400 font-semibold hover:text-green-300">
                Read Full Article →
            </a>

        </div>


        {{-- SIDEBAR --}}
        <div>

            <h2 class="text-green-400 text-lg font-bold mb-6 border-b border-neutral-700 pb-2">
                Top Stories
            </h2>

            <div class="space-y-6">

                @foreach($topStories as $index => $story)

                <a href="{{ route('posts.show',$story) }}"
                   class="flex gap-3 items-start group">

                    <span class="text-green-400 font-bold text-lg">
                        {{ $index + 1 }}
                    </span>

                    <div class="flex-1">

                        <h3 class="text-sm font-semibold group-hover:text-green-400">
                            {{ Str::limit($story->title,55) }}
                        </h3>

                        <p class="text-xs text-gray-400 mt-1">
                            {{ $story->created_at->diffForHumans() }}
                        </p>

                    </div>

                    <img src="{{ $story->image ? asset('uploads/'.$story->image) : 'https://via.placeholder.com/80' }}"
                         class="w-14 h-14 rounded object-cover">

                </a>

                @endforeach

            </div>

        </div>

    </div>

    @endif



    {{-- GRID POSTS --}}
    <div class="max-w-7xl mx-auto px-6 pb-16">

        <h2 class="text-2xl font-bold mb-8 text-white">
            Latest Articles
        </h2>

        <div class="grid md:grid-cols-3 gap-8">

            @foreach($posts->skip(1) as $post)

            <div class="bg-neutral-900 rounded-lg overflow-hidden hover:bg-neutral-800 transition">

                <img src="{{ $post->image ? asset('uploads/'.$post->image) : 'https://via.placeholder.com/400x250' }}"
                     class="w-full h-48 object-cover">

                <div class="p-5">

                    <h3 class="text-lg font-semibold hover:text-green-400">
                        {{ Str::limit($post->title,55) }}
                    </h3>

                    <p class="text-gray-400 text-sm mt-2">
                        {{ Str::limit($post->content,120) }}
                    </p>

                    <a href="{{ route('posts.show',$post) }}"
                       class="text-green-400 text-sm font-semibold mt-4 inline-block">
                        Read More →
                    </a>

                </div>

            </div>

            @endforeach

        </div>


        {{-- PAGINATION --}}
        <div class="mt-12 flex justify-center">
            {{ $posts->links() }}
        </div>

    </div>

</div>

@endsection