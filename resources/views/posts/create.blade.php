@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Create Blog Post</h1>

    <div class="card shadow mb-4">

        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Add New Post
            </h6>
        </div>

        <div class="card-body">

            <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Title -->
                <div class="form-group">
                    <label>Post Title</label>

                    <input type="text"
                           name="title"
                           class="form-control"
                           value="{{ old('title') }}"
                           placeholder="Enter post title">

                    @error('title')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>


                <!-- Content -->
                <div class="form-group">
                    <label>Content</label>

                    <textarea name="content"
                              rows="8"
                              class="form-control"
                              placeholder="Write your blog content here...">{{ old('content') }}</textarea>

                    @error('content')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>


                <!-- Image Upload -->
                <div class="form-group">
                    <label>Post Image</label>

                    <input type="file"
                           name="image"
                           class="form-control-file"
                           id="imageInput">

                    <small class="form-text text-muted">
                        Upload thumbnail image for this post.
                    </small>

                    <div class="mt-3">
                        <img id="preview"
                             src=""
                             style="max-height:200px; display:none;"
                             class="img-thumbnail">
                    </div>

                    @error('image')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>


                <!-- Buttons -->
                <div class="mt-4">

                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Save Post
                    </button>

                    <a href="{{ route('admin.posts.index') }}"
                       class="btn btn-secondary">
                        Back
                    </a>

                </div>

            </form>

        </div>

    </div>

</div>


<!-- Preview Image Script -->
<script>

document.getElementById('imageInput').addEventListener('change', function(e){

    const file = e.target.files[0];

    if(file){

        const reader = new FileReader();

        reader.onload = function(e){

            const preview = document.getElementById('preview');

            preview.src = e.target.result;

            preview.style.display = 'block';
        }

        reader.readAsDataURL(file);
    }

});

</script>

@endsection