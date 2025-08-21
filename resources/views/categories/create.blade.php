@extends('layout')

@section('page-title', 'Create Category')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('categories.index') }}">Categories</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">Create</li>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="small-title mb-0">Create New Category</h2>
            <a href="{{ route('categories.index') }}" class="btn btn-icon btn-icon-start btn-outline-success">
                <i data-acorn-icon="chevron-left" class="icon" data-acorn-size="18"></i>
                <span>Back to Categories</span>
            </a>
        </div>

        <!-- Error Messages -->
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i data-acorn-icon="warning-hexagon" class="me-2" data-acorn-size="16"></i>
                <strong>Please fix the following errors:</strong>
                <ul class="list-unstyled mt-2 mb-0">
                    @foreach ($errors->all() as $error)
                        <li>
                            <i data-acorn-icon="chevron-right" class="me-1" data-acorn-size="12"></i>{{ $error }}
                        </li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Create Form -->
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="card mb-5 border-success">
                    <div class="card-header bg-success text-white">
                        <h5 class="card-title d-flex align-items-center mb-0">
                            <i data-acorn-icon="grid-2" class="me-2" data-acorn-size="20"></i>
                            Category Information
                        </h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('categories.store') }}" method="POST" id="createCategoryForm">
                            @csrf

                            <!-- Category Name -->
                            <div class="mb-4">
                                <label for="name" class="form-label">
                                    Category Name <span class="text-danger">*</span>
                                </label>
                                <div class="position-relative">
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i data-acorn-icon="grid-2" data-acorn-size="16"></i>
                                        </span>
                                        <input 
                                            type="text"
                                            id="name"
                                            name="name"
                                            value="{{ old('name') }}"
                                            class="form-control @error('name') is-invalid @enderror"
                                            placeholder="Enter category name"
                                            required
                                            autocomplete="off"
                                        >
                                    </div>
                                    <div class="invalid-feedback">
                                        @error('name')
                                            {{ $message }}
                                        @else
                                            Please provide a valid category name.
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-text text-muted">
                                    <i data-acorn-icon="info" class="me-1" data-acorn-size="12"></i>
                                    Choose a descriptive name for your category.
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="d-flex gap-2 justify-content-end">
                                <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary">
                                    <i data-acorn-icon="close" class="me-1" data-acorn-size="16"></i>
                                    Cancel
                                </a>
                                <button type="submit" class="btn btn-success" id="submitBtn">
                                    <i data-acorn-icon="check" class="me-1" data-acorn-size="16"></i>
                                    Create Category
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tips Section -->
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="card border-success">
                    <div class="card-body">
                        <h6 class="card-title text-success">
                            <i data-acorn-icon="help" class="me-2" data-acorn-size="16"></i>
                            Tips for Creating Categories
                        </h6>
                        <ul class="list-unstyled text-muted mb-0">
                            <li class="mb-2">
                                <i data-acorn-icon="chevron-right" class="text-success me-2" data-acorn-size="12"></i>
                                Use clear, organizational names (e.g., "Technology", "Business")
                            </li>
                            <li class="mb-2">
                                <i data-acorn-icon="chevron-right" class="text-success me-2" data-acorn-size="12"></i>
                                Categories help group related content together
                            </li>
                            <li class="mb-2">
                                <i data-acorn-icon="chevron-right" class="text-success me-2" data-acorn-size="12"></i>
                                Keep names concise but descriptive
                            </li>
                            <li>
                                <i data-acorn-icon="chevron-right" class="text-success me-2" data-acorn-size="12"></i>
                                Check if the category already exists before creating
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Categories vs Genres -->
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="card bg-gradient-light">
                    <div class="card-body">
                        <h6 class="card-title text-primary">
                            <i data-acorn-icon="lightbulb" class="me-2" data-acorn-size="16"></i>
                            Categories vs Genres
                        </h6>
                        <div class="row">
                            <div class="col-6">
                                <div class="text-success mb-2">
                                    <i data-acorn-icon="grid-2" class="me-1" data-acorn-size="14"></i>
                                    <strong>Categories</strong>
                                </div>
                                <ul class="text-muted small mb-0">
                                    <li>Broad topics</li>
                                    <li>Content organization</li>
                                    <li>General classification</li>
                                </ul>
                            </div>
                            <div class="col-6">
                                <div class="text-primary mb-2">
                                    <i data-acorn-icon="tag" class="me-1" data-acorn-size="14"></i>
                                    <strong>Genres</strong>
                                </div>
                                <ul class="text-muted small mb-0">
                                    <li>Specific styles</li>
                                    <li>Artistic classification</li>
                                    <li>Content characteristics</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const form       = document.getElementById('createCategoryForm');
    const submitBtn  = document.getElementById('submitBtn');
    const nameInput  = document.getElementById('name');
    const maxLength  = 255;

    // Autofocus
    nameInput.focus();

    // Form submission
    form.addEventListener('submit', e => {
        const categoryName = nameInput.value.trim();

        if (!categoryName) {
            e.preventDefault();
            nameInput.classList.add('is-invalid');
            return;
        }

        // Show loading state
        submitBtn.innerHTML = '<i class="spinner-border spinner-border-sm me-1" role="status"></i>Creating...';
        submitBtn.disabled  = true;
    });

    // Validation feedback
    nameInput.addEventListener('input', () => {
        const value = nameInput.value.trim();

        if (value.length > maxLength) {
            nameInput.classList.add('is-invalid');
        } else if (value.length > 0) {
            nameInput.classList.remove('is-invalid');
            nameInput.classList.add('is-valid');
        } else {
            nameInput.classList.remove('is-valid', 'is-invalid');
        }

        showSuggestions();
    });

    // Remove validation error on typing
    nameInput.addEventListener('input', () => {
        if (nameInput.value.trim()) {
            nameInput.classList.remove('is-invalid');
        }
    });

    // Handle Enter key
    nameInput.addEventListener('keypress', e => {
        if (e.key === 'Enter') {
            e.preventDefault();
            form.submit();
        }
    });

    // Category suggestions
    const commonCategories = [
        'Technology', 'Business', 'Health', 'Education', 'Entertainment',
        'Sports', 'Travel', 'Food', 'Fashion', 'Science', 'Art', 'Music'
    ];

    function showSuggestions() {
        const input = nameInput.value.toLowerCase();
        if (input.length > 1) {
            const suggestions = commonCategories.filter(cat =>
                cat.toLowerCase().includes(input)
            );
            console.log('Suggestions:', suggestions);
        }
    }

    // Real-time existence check (basic example)
    nameInput.addEventListener('blur', () => {
        const value = nameInput.value.trim().toLowerCase();
        if (value) {
            const exists = commonCategories.some(cat => cat.toLowerCase() === value);
            if (exists) {
                console.log('Similar category might exist:', value);
            }
        }
    });
});
</script>
@endsection
