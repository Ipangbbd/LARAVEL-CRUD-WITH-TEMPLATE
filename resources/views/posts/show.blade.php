@extends('layout')

@section('title', $post->title . ' - Laravel CRUD')
@section('page-title', 'View Post')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('posts.index') }}">Posts</a>
    </li>
    <li class="breadcrumb-item active">{{ $post->title }}</li>
@endsection

@section('content')
    <!-- Post Details -->
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">

            <div class="card">
                <div class="card-body">

                    <!-- Post Header -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="d-flex align-items-start justify-content-between flex-wrap gap-3">

                                <div>
                                    <h2 class="card-title mb-2">{{ $post->title }}</h2>
                                    <div class="d-flex gap-2 flex-wrap">
                                        <span class="badge bg-secondary">{{ $post->genre->name }}</span>
                                        @if ($post->category)
                                            <span class="badge bg-info">{{ $post->category->name }}</span>
                                        @endif
                                    </div>
                                </div>

                                @if ($post->image_path)
                                    <div class="flex-shrink-0">
                                        <img    src="{{ asset('storage/' . $post->image_path) }}"
                                                alt="{{ $post->title }}"
                                                class="rounded border shadow-sm"
                                                style="width: 120px; height: 120px; object-fit: cover;">
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>

                    <!-- Post Content -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <h6 class="text-muted text-uppercase text-small mb-2">Content</h6>
                            <p class="mb-0">{{ $post->content }}</p>
                        </div>
                    </div>

                    <!-- Post Metadata -->
                    <div class="row">
                        <div class="col-12">
                            <div class="border-top pt-3">
                                <div class="row text-small">

                                    <div class="col-sm-6 mb-2">
                                        <span class="text-muted">Genre:</span>
                                        <span class="ms-2 fw-medium">{{ $post->genre->name }}</span>
                                    </div>

                                    <div class="col-sm-6 mb-2">
                                        <span class="text-muted">Category:</span>
                                        <span class="ms-2 fw-medium">
                                            {{ optional($post->category)->name ?? '-' }}
                                        </span>
                                    </div>

                                    <div class="col-sm-6 mb-2">
                                        <span class="text-muted">Created:</span>
                                        <span class="ms-2">
                                            {{ $post->created_at->format('M d, Y \a\t H:i') }}
                                        </span>
                                    </div>

                                    <div class="col-sm-6 mb-2">
                                        <span class="text-muted">Updated:</span>
                                        <span class="ms-2">
                                            {{ $post->updated_at->format('M d, Y \a\t H:i') }}
                                        </span>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <!-- Action Buttons -->
    <div class="row justify-content-center mt-4">
        <div class="col-12 col-lg-8">
            <div class="d-flex gap-2 flex-wrap justify-content-center justify-content-sm-start">
                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning btn-icon-start">
                    <span>Edit Post</span>
                </a>
                <button type="button"
                        class="btn btn-danger btn-icon-start"
                        data-bs-toggle="modal"
                        data-bs-target="#deleteModal">
                    <span>Delete Post</span>
                </button>
                <a href="{{ route('posts.index') }}" class="btn btn-secondary btn-icon-start">
                    <span>Back to Posts</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div    class="modal fade" id="deleteModal" tabindex="-1"
            aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>

                <div class="modal-body text-center">
                    <div class="mb-3">
                        <div    class=  "bg-danger bg-opacity-10 rounded-circle d-inline-flex 
                                        align-items-center justify-content-center"
                                style=  "width: 60px; height: 60px;">
                            <span class="text-danger fs-2">⚠</span>
                        </div>
                    </div>
                    <h6 class="mb-2">Delete "{{ $post->title }}"?</h6>
                    <p class="text-muted mb-0">
                        This action cannot be undone. The post will be permanently removed
                        from the system.
                    </p>
                </div>

                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <form   action="{{ route('posts.destroy', $post->id) }}"
                            method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <span>Yes, Delete Post</span>
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
