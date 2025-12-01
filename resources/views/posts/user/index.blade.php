@extends('layouts.blog')

@section('content')
<div class="bg-black text-white min-h-screen">

    {{-- HERO POST (POST UTAMA) --}}
    @if($posts->count() > 0)
        @php
            $hero = $posts->first();
        @endphp

        <div class="w-full md:flex px-4 md:px-10 py-10 gap-8">

            {{-- Hero Left --}}
            <div class="md:w-3/4 relative">
                <img src="{{ $hero->image ? asset('uploads/'.$hero->image) : 'https://via.placeholder.com/1200x800' }}"
                    class="w-full h-[450px] object-cover rounded-lg shadow-lg">

                {{-- Judul Besar --}}
                <h1 class="mt-6 text-5xl md:text-7xl font-extrabold leading-tight text-purple-500 drop-shadow-xl">
                    {{ $hero->title }}
                </h1>

                <p class="mt-4 text-lg text-gray-300 max-w-2xl">
                    {{ Str::limit($hero->content, 200) }}
                </p>

                <a href="{{ route('posts.show', $hero) }}"
                   class="block mt-6 text-green-400 font-semibold">
                    READ MORE →
                </a>
            </div>

            {{-- RIGHT SIDEBAR --}}
            <div class="md:w-1/4 mt-10 md:mt-0">
                <h2 class="text-green-400 font-bold text-lg mb-4">Top Stories</h2>

                <div class="space-y-6">
                    @foreach($topStories as $index => $story)
                        <a href="{{ route('posts.show', $story) }}" class="flex gap-3 group">
                            <div class="text-green-400 font-bold text-xl">
                                {{ $index + 1 }}
                            </div>

                            <div class="flex-1">
                                <h3 class="font-semibold text-md group-hover:text-green-300">
                                    {{ Str::limit($story->title, 60) }}
                                </h3>

                                <p class="text-xs text-gray-400 mt-1">
                                    {{ $story->created_at->diffForHumans() }}
                                </p>
                            </div>

                            <img src="{{ $story->image ? asset('uploads/'.$story->image) : 'https://via.placeholder.com/80' }}"
                                class="w-16 h-16 object-cover rounded">
                        </a>
                    @endforeach
                </div>
            </div>

        </div>
    @endif


    {{-- LIST POST LAINNYA --}}
    <div class="px-4 md:px-10 py-10">
        <div class="grid md:grid-cols-3 gap-8">

            @foreach($posts->skip(1) as $post)
                <div class="bg-neutral-900 p-5 rounded-lg hover:bg-neutral-800 transition">
                    <img src="{{ $post->image ? asset('uploads/'.$post->image) : 'https://via.placeholder.com/400x250' }}"
                        class="w-full h-48 object-cover rounded">

                    <h3 class="mt-4 text-xl font-bold text-white hover:text-green-400">
                        {{ Str::limit($post->title, 50) }}
                    </h3>

                    <p class="mt-2 text-gray-400 text-sm">
                        {{ Str::limit($post->content, 120) }}
                    </p>

                    <a href="{{ route('posts.show', $post) }}"
                       class="mt-3 inline-block text-sm text-green-400 font-semibold">
                       READ MORE →
                    </a>
                </div>
            @endforeach

        </div>

        <div class="mt-10 text-center text-white">
            {{ $posts->links() }}
        </div>
    </div>

</div>



<div class="mb-4">
    <label class="font-semibold">Gambar</label>
    <input type="file" name="image" id="imageInput" class="block mt-2">

    <div id="preview" class="mt-3"></div>
</div>

<script>
document.addEventListener('paste', function (e) {
    const items = (e.clipboardData || e.originalEvent.clipboardData).items;

    for (let item of items) {
        if (item.kind === 'file') {
            const file = item.getAsFile();

            const input = document.getElementById('imageInput');
            const dt = new DataTransfer();
            dt.items.add(file);
            input.files = dt.files;

            const preview = document.getElementById('preview');
            preview.innerHTML = `<img src="${URL.createObjectURL(file)}" class="w-40 rounded mt-2">`;
        }
    }
});
</script>
@endsection



