@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 text-gray-800">Blog Posts</h1>

        <a href="{{ route('admin.posts.create') }}"
           class="btn btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm"></i> Create Post
        </a>
    </div>


    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}

            <button class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    @endif


    <!-- Card -->
    <div class="card shadow mb-4">

        <div class="card-header py-3 d-flex justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">
                List Blog Posts
            </h6>
        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="thead-dark">
                        <tr>
                            <th width="60">ID</th>
                            <th width="120">Image</th>
                            <th>Title</th>
                            <th>Content</th>
                            <th width="150">Date</th>
                            <th width="160">Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                    @forelse($posts as $post)

                    <tr>

                        <td>
                            <span class="badge badge-secondary">
                                {{ $loop->iteration }}
                            </span>
                        </td>
                        <td>
                            <img
                                src="{{ $post->image ? asset('uploads/'.$post->image) : 'https://via.placeholder.com/80' }}"
                                width="70"
                                class="img-thumbnail">
                        </td>

                        <td class="font-weight-bold">
                            {{ $post->title }}
                        </td>

                        <td>
                            {{ \Illuminate\Support\Str::limit($post->content, 80) }}
                        </td>

                        <td>
                            {{ $post->created_at->format('d M Y') }}
                        </td>

                        <td>

                            <a href="{{ route('admin.posts.show', $post) }}"
                               class="btn btn-info btn-sm">
                                <i class="fas fa-eye"></i>
                            </a>

                            <a href="{{ route('admin.posts.edit', $post) }}"
                               class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>

                            <form action="{{ route('admin.posts.destroy', $post) }}"
                                  method="POST"
                                  class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Delete this post?')">

                                    <i class="fas fa-trash"></i>

                                </button>

                            </form>

                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="6" class="text-center text-muted">
                            No blog posts available
                        </td>
                    </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>


    <!-- Pagination -->
    <div class="mt-3">
        {{ $posts->links() }}
    </div>

</div>

@endsection