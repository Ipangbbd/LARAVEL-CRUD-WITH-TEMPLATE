@extends('layout')

@section('title', 'Create Post - Laravel CRUD')
@section('page-title', 'Create New Post')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('posts.index') }}">Posts</a>
    </li>
    <li class="breadcrumb-item active">Create</li>
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

    {{-- Create Post Form --}}
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('posts.store') }}" 
                          method="POST" 
                          enctype="multipart/form-data">
                        @csrf

                        {{-- Title --}}
                        <div class="mb-3">
                            <label for="title" class="form-label">
                                Title <span class="text-danger">*</span>
                            </label>
                            <input  type="text"
                                    id="title"
                                    name="title"
                                    value="{{ old('title') }}"
                                    required
                                    placeholder="Enter post title"
                                    class="form-control @error('title') is-invalid @enderror">
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
                                        required
                                        placeholder="Write your post content here..."
                                        class="form-control @error('content') is-invalid @enderror">{{ old('content') }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Genre & Category --}}
                        <div class="row">
                            <div class="col-md-6">
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
                                                    {{ old('genre_id') == $genre->id ? 'selected' : '' }}>
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
                                <div class="mb-3">
                                    <label for="category_id" class="form-label">Category</label>
                                    <select id="category_id"
                                            name="category_id"
                                            class="form-select @error('category_id') is-invalid @enderror">
                                        <option value="">Select a category (optional)</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" 
                                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
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

                        {{-- Featured Image --}}
                        <div class="mb-4">
                            <label for="image" class="form-label">Featured Image</label>
                            <input  type="file"
                                    id="image"
                                    name="image"
                                    accept="image/jpeg,image/jpg,image/png,image/webp"
                                    class="form-control @error('image') is-invalid @enderror">
                            <div class="form-text">
                                <small class="text-muted">
                                    Accepted formats: JPG, JPEG, PNG, WEBP. Maximum size: 10MB.
                                </small>
                            </div>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Image Preview --}}
                        <div class="mb-3" id="imagePreview" style="display: none;">
                            <label class="form-label">Image Preview</label>
                            <div class="border rounded p-3 bg-light d-flex align-items-center">
                                <img    id="previewImg" src="" alt="Preview" 
                                        class="img-thumbnail" 
                                        style="max-width: 200px; max-height: 200px;">
                                <button type="button" 
                                        id="removePreview" 
                                        class="btn btn-sm btn-outline-danger ms-2">
                                    Remove
                                </button>
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="d-flex gap-2 justify-content-end flex-wrap">
                            <a href="{{ route('posts.index') }}" class="btn btn-secondary">
                                Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                Create Post
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
            <div class="card border-primary">
                <div class="card-header bg-primary text-white">
                    <h6 class="card-title mb-0">Quick Actions</h6>
                </div>
                <div class="card-body">
                    <p class="card-text text-muted mb-3">
                        Need to create new genres or categories?
                    </p>
                    <div class="d-flex gap-2 flex-wrap">
                        <a  href="{{ route('genres.create') }}" 
                            class="btn btn-outline-success btn-sm">
                            Add New Genre
                        </a>
                        <a  href="{{ route('categories.create') }}" 
                            class="btn btn-outline-info btn-sm">
                            Add New Category
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    // Image preview
    document.getElementById('image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const previewDiv = document.getElementById('imagePreview');
        const previewImg = document.getElementById('previewImg');

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                previewDiv.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            previewDiv.style.display = 'none';
        }
    });

    // Remove preview
    document.getElementById('removePreview').addEventListener('click', function() {
        document.getElementById('image').value = '';
        document.getElementById('imagePreview').style.display = 'none';
    });

    // Client-side form validation
    document.querySelector('form').addEventListener('submit', function(e) {
        const title = document.getElementById('title').value.trim();
        const content = document.getElementById('content').value.trim();
        const genre = document.getElementById('genre_id').value;

        if (!title || !content || !genre) {
            e.preventDefault();
            alert('Please fill in all required fields (Title, Content, and Genre).');
            return false;
        }
    });
</script>
@endsection
