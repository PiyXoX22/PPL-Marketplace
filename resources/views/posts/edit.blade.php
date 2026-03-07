@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Edit Blog Post</h1>

    <div class="card shadow mb-4">

        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Update Post
            </h6>
        </div>

        <div class="card-body">

            <form action="{{ route('admin.posts.update', $post) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Title -->
                <div class="form-group">
                    <label>Post Title</label>

                    <input type="text"
                           name="title"
                           class="form-control"
                           value="{{ old('title', $post->title) }}">

                    @error('title')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>


                <!-- Content -->
                <div class="form-group">
                    <label>Content</label>

                    <textarea name="content"
                              rows="6"
                              class="form-control">{{ old('content', $post->content) }}</textarea>

                    @error('content')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>


                <!-- Buttons -->
                <button type="submit" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Update Post
                </button>

                <a href="{{ route('admin.posts.index') }}"
                   class="btn btn-secondary">
                    Back
                </a>

            </form>

        </div>

    </div>

</div>

@endsection