@extends('layout')

@section('title', 'Edit Post - Laravel CRUD')
@section('page-title', 'Edit Post')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('posts.index') }}">Posts</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a>
    </li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')

    {{-- Error Messages --}}
    @if ($errors->any())
        <div class="row mb-4">
            <div class="col-12">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <h6 class="alert-heading mb-2">Please correct the following errors:</h6>
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif

    {{-- Edit Post Form --}}
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Edit: {{ $post->title }}</h5>
                </div>

                <div class="card-body">
                    <form   action="{{ route('posts.update', $post->id) }}" 
                            method="POST" 
                            enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Title --}}
                        <div class="mb-3">
                            <label for="title" class="form-label">
                                Title <span class="text-danger">*</span>
                            </label>
                            <input  type="text"
                                    id="title"
                                    name="title"
                                    class="form-control @error('title') is-invalid @enderror"
                                    value="{{ old('title', $post->title) }}"
                                    required
                                    placeholder="Enter post title">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Content --}}
                        <div class="mb-3">
                            <label for="content" class="form-label">
                                Content <span class="text-danger">*</span>
                            </label>
                            <textarea   id="content"
                                        name="content"
                                        rows="6"
                                        class="form-control @error('content') is-invalid @enderror"
                                        required
                                        placeholder="Write your post content here...">{{ old('content', $post->content) }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Genre & Category --}}
                        <div class="row">
                            <div class="col-md-6">
                                {{-- Genre --}}
                                <div class="mb-3">
                                    <label for="genre_id" class="form-label">
                                        Genre <span class="text-danger">*</span>
                                    </label>
                                    <select id="genre_id"
                                            name="genre_id"
                                            required
                                            class="form-select @error('genre_id') is-invalid @enderror">
                                        <option value="">Select a genre</option>
                                        @foreach ($genres as $genre)
                                            <option value="{{ $genre->id }}" 
                                                {{ old('genre_id', $post->genre_id) == $genre->id ? 'selected' : '' }}>
                                                {{ $genre->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('genre_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                {{-- Category --}}
                                <div class="mb-3">
                                    <label for="category_id" class="form-label">Category</label>
                                    <select id="category_id"
                                            name="category_id"
                                            class="form-select @error('category_id') is-invalid @enderror">
                                        <option value="">Select a category (optional)</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" 
                                                {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Current Image --}}
                        @if ($post->image_path)
                            <div class="mb-3">
                                <label class="form-label">Current Image</label>
                                <div class="border rounded p-3 bg-light">
                                    <div class="d-flex align-items-center gap-3">
                                        <img    src="{{ asset('storage/' . $post->image_path) }}"
                                                alt="Current Image"
                                                class="img-thumbnail"
                                                style="width: 100px; height: 100px; object-fit: cover;">
                                        <div class="flex-grow-1">
                                            <div class="text-muted small">
                                                Current image will be replaced if you upload a new one.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        {{-- Image Upload --}}
                        <div class="mb-4">
                            <label for="image" class="form-label">
                                {{ $post->image_path ? 'Replace Image' : 'Featured Image' }}
                            </label>
                            <input  type="file"
                                    id="image"
                                    name="image"
                                    class="form-control @error('image') is-invalid @enderror"
                                    accept="image/jpeg,image/jpg,image/png,image/webp">
                            <div class="form-text">
                                <small class="text-muted">
                                    @if($post->image_path)
                                        Upload a new image to replace the current one. Leave empty to keep the existing image.
                                    @else
                                        Upload an image for this post.
                                    @endif
                                    Accepted formats: JPG, JPEG, PNG, WEBP. Maximum size: 10MB.
                                </small>
                            </div>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- New Image Preview --}}
                        <div id="imagePreview" class="mb-3" style="display: none;">
                            <label class="form-label">New Image Preview</label>
                            <div class="border rounded p-3 bg-light">
                                <img    id="previewImg" src="" alt="Preview"
                                        class="img-thumbnail"
                                        style="max-width: 200px; max-height: 200px;">
                                <button type="button" id="removePreview"
                                        class="btn btn-sm btn-outline-danger ms-2">
                                    Remove
                                </button>
                            </div>
                        </div>

                        {{-- Actions --}}
                        <div class="d-flex gap-2 justify-content-end flex-wrap">
                            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-outline-secondary">
                                View Post
                            </a>
                            <a href="{{ route('posts.index') }}" class="btn btn-secondary">
                                Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                Update Post
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="row justify-content-center mt-4">
        <div class="col-12 col-lg-8">
            <div class="card border-warning">
                <div class="card-header bg-warning text-dark">
                    <h6 class="card-title mb-0">Quick Actions</h6>
                </div>
                <div class="card-body">
                    <p class="card-text text-muted mb-3">
                        Need to create new genres or categories for this post?
                    </p>
                    <div class="d-flex gap-2 flex-wrap">
                        <a  href="{{ route('genres.create') }}" target="_blank"
                            class="btn btn-outline-success btn-sm">
                            Add New Genre
                        </a>
                        <a  href="{{ route('categories.create') }}" target="_blank"
                            class="btn btn-outline-info btn-sm">
                            Add New Category
                        </a>
                    </div>
                    <div class="text-muted small mt-2">
                        Links open in new tabs. Refresh this page after creating new items to see them in the dropdowns.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    // Image preview
    const imageInput   = document.getElementById('image');
    const previewDiv   = document.getElementById('imagePreview');
    const previewImg   = document.getElementById('previewImg');
    const removeButton = document.getElementById('removePreview');

    imageInput.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (ev) => {
                previewImg.src = ev.target.result;
                previewDiv.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            previewDiv.style.display = 'none';
        }
    });

    removeButton.addEventListener('click', () => {
        imageInput.value = '';
        previewDiv.style.display = 'none';
    });

    // Client-side required fields validation
    document.querySelector('form').addEventListener('submit', (e) => {
        const title   = document.getElementById('title').value.trim();
        const content = document.getElementById('content').value.trim();
        const genre   = document.getElementById('genre_id').value;

        if (!title || !content || !genre) {
            e.preventDefault();
            alert('Please fill in all required fields (Title, Content, and Genre).');
        }
    });
</script>
@endsection
