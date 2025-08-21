@extends('layout')

@section('title', 'Posts - Laravel CRUD')
@section('page-title', 'Posts Management')

@section('breadcrumb')
    <li class="breadcrumb-item active">Posts</li>
@endsection

@section('content')
    @php
        use Illuminate\Support\Str;
    @endphp

    {{-- Success Toast --}}
    @if ($message = Session::get('success'))
        <div    id="success-toast"
                class="position-fixed bottom-0 start-50 translate-middle-x mb-4"
                style="z-index: 1050;">
            <div class="alert alert-success alert-dismissible fade show shadow" role="alert">
                <i data-acorn-icon="check-circle" class="me-2"></i>
                {{ $message }}
                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"
                        aria-label="Close"></button>
            </div>
        </div>

        <script>
            setTimeout(function () {
                const toast = document.getElementById('success-toast');
                if (toast) {
                    const alert = toast.querySelector('.alert');
                    if (alert) {
                        const bsAlert = new bootstrap.Alert(alert);
                        bsAlert.close();
                    }
                }
            }, 5000);
        </script>
    @endif

    {{-- Action Buttons --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex flex-wrap gap-2 justify-content-start">
                <a href="{{ route('posts.create') }}" class="btn btn-primary btn-icon-start">
                    <i data-acorn-icon="plus" class="me-1"></i>
                    <span>Create New Post</span>
                </a>
                <a href="{{ route('genres.create') }}" class="btn btn-success btn-icon-start">
                    <i data-acorn-icon="tag" class="me-1"></i>
                    <span>Create New Genre</span>
                </a>
                <a href="{{ route('categories.create') }}" class="btn btn-info btn-icon-start">
                    <i data-acorn-icon="grid-2" class="me-1"></i>
                    <span>Create New Category</span>
                </a>
            </div>
        </div>
    </div>

    {{-- Posts Table --}}
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th class="text-small text-uppercase">ID</th>
                            <th class="text-small text-uppercase">Image</th>
                            <th class="text-small text-uppercase">Title</th>
                            <th class="text-small text-uppercase">Content</th>
                            <th class="text-small text-uppercase">Genre</th>
                            <th class="text-small text-uppercase">Category</th>
                            <th class="text-small text-uppercase text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($posts as $post)
                            <tr>
                                {{-- ID --}}
                                <td class="align-middle">
                                    <span class="badge bg-outline-primary">{{ $post->id }}</span>
                                </td>

                                {{-- Image --}}
                                <td class="align-middle">
                                    @if ($post->image_path)
                                        <img    src="{{ asset('storage/' . $post->image_path) }}"
                                                alt="{{ $post->title }}"
                                                class="rounded border"
                                                style="width: 60px; height: 60px; object-fit: cover;">
                                    @else
                                        <div    class="d-flex align-items-center justify-content-center border rounded text-muted"
                                                style="width: 60px; height: 60px; font-size: 0.75rem;">
                                            No Image
                                        </div>
                                    @endif
                                </td>

                                {{-- Title --}}
                                <td class="align-middle">
                                    <div class="text-primary fw-medium">{{ $post->title }}</div>
                                </td>

                                {{-- Content --}}
                                <td class="align-middle">
                                    <div class="text-muted">{{ Str::limit($post->content, 50) }}</div>
                                </td>

                                {{-- Genre --}}
                                <td class="align-middle">
                                    <span class="badge bg-secondary">{{ $post->genre->name }}</span>
                                </td>

                                {{-- Category --}}
                                <td class="align-middle">
                                    @if ($post->category)
                                        <span class="badge bg-info">{{ $post->category->name }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>

                                {{-- Actions --}}
                                <td class="align-middle text-center">
                                    <div class="btn-group" role="group" aria-label="Post actions">
                                        {{-- View --}}
                                        <a  href="{{ route('posts.show', $post->id) }}"
                                            class="btn btn-sm btn-outline-info"
                                            data-bs-toggle="tooltip"
                                            title="View Post">
                                            <i data-acorn-icon="info-circle" data-acorn-size="14"></i>
                                        </a>

                                        {{-- Edit --}}
                                        <a  href="{{ route('posts.edit', $post->id) }}"
                                            class="btn btn-sm btn-outline-warning"
                                            data-bs-toggle="tooltip"
                                            title="Edit Post">
                                            <i data-acorn-icon="edit-square" data-acorn-size="14"></i>
                                        </a>

                                        {{-- Delete --}}
                                        <button type="button"
                                                class="btn btn-sm btn-outline-danger"
                                                data-bs-toggle="modal"
                                                data-bs-target="#deleteModal{{ $post->id }}"
                                                title="Delete Post">
                                            <i data-acorn-icon="bin" data-acorn-size="14"></i>
                                        </button>
                                    </div>

                                    {{-- Delete Modal --}}
                                    <div    class="modal fade"
                                            id="deleteModal{{ $post->id }}"
                                            tabindex="-1"
                                            aria-labelledby="deleteModalLabel{{ $post->id }}"
                                            aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel{{ $post->id }}">
                                                        <i  data-acorn-icon="alert-triangle"
                                                            class="me-2 text-danger"></i>
                                                        Confirm Deletion
                                                    </h5>
                                                    <button type="button"
                                                            class="btn-close"
                                                            data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>
                                                        Are you sure you want to delete the post
                                                        <strong>"{{ $post->title }}"</strong>?
                                                    </p>
                                                    <p class="text-muted small mb-0">
                                                        This action cannot be undone.
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button"
                                                            class="btn btn-secondary"
                                                            data-bs-dismiss="modal">
                                                        Cancel
                                                    </button>
                                                    <form   action="{{ route('posts.destroy', $post->id) }}"
                                                            method="POST"
                                                            class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">
                                                            <i data-acorn-icon="trash-2" class="me-1"></i>
                                                            Delete Post
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            {{-- Empty State --}}
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <div class="d-flex flex-column align-items-center">
                                        <i  data-acorn-icon="file-text"
                                            class="text-muted mb-3"
                                            style="font-size: 3rem;"></i>
                                        <h5 class="text-muted mb-2">No Posts Found</h5>
                                        <p class="text-muted mb-3">There are no posts to display at the moment.</p>
                                        <a href="{{ route('posts.create') }}" class="btn btn-primary">
                                            <i data-acorn-icon="plus" class="me-1"></i>
                                            Create Your First Post
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Pagination (Uncomment if needed) --}}
    {{-- {{ $posts->links() }} --}}
@endsection

@section('scripts')
    <script>
        // Initialize tooltips
        const tooltipTriggerList = [].slice.call(
            document.querySelectorAll('[data-bs-toggle="tooltip"]')
        );
        tooltipTriggerList.map(el => new bootstrap.Tooltip(el));
    </script>
@endsection
