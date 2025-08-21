@extends('layout')

@section('page-title', 'Edit Category')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('categories.index') }}">Categories</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">Edit</li>
@endsection

@section('content')
<div class="row">
    <div class="col-12">

        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="small-title">Edit Category</h2>
            <div class="btn-group">
                <a href="{{ route('categories.index') }}" class="btn btn-icon btn-icon-start btn-outline-success">
                    <i data-acorn-icon="chevron-left" class="icon" data-acorn-size="18"></i>
                    <span>Back to Categories</span>
                </a>
                <a href="{{ route('categories.create') }}" class="btn btn-icon btn-icon-start btn-outline-primary">
                    <i data-acorn-icon="plus" class="icon" data-acorn-size="18"></i>
                    <span>Create New</span>
                </a>
            </div>
        </div>

        <!-- Validation Errors -->
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

        <!-- Edit Category Form -->
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="card mb-5 border-warning">
                    
                    <!-- Card Header -->
                    <div class="card-header bg-warning text-dark">
                        <h5 class="card-title d-flex align-items-center mb-0">
                            <i data-acorn-icon="edit" class="me-2" data-acorn-size="20"></i>
                            Edit Category: {{ $category->name }}
                        </h5>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body">
                        <form 
                            id="editCategoryForm"
                            action="{{ route('categories.update', $category->id) }}" 
                            method="POST"
                        >
                            @csrf
                            @method('PUT')

                            <!-- Current Name -->
                            <div class="mb-3 p-3 bg-light rounded">
                                <small class="text-muted d-block mb-1">Current Name:</small>
                                <div class="d-flex align-items-center">
                                    <i data-acorn-icon="grid-2" class="text-success me-2" data-acorn-size="16"></i>
                                    <strong class="text-success">{{ $category->name }}</strong>
                                </div>
                            </div>

                            <!-- New Name Input -->
                            <div class="mb-4">
                                <label for="name" class="form-label">
                                    New Category Name <span class="text-danger">*</span>
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
                                            value="{{ old('name', $category->name) }}"
                                            class="form-control @error('name') is-invalid @enderror"
                                            placeholder="Enter category name"
                                            required
                                            autocomplete="off"
                                        >
                                        <button 
                                            type="button" 
                                            id="resetBtn" 
                                            class="btn btn-outline-secondary" 
                                            title="Reset to original"
                                        >
                                            <i data-acorn-icon="rotate-ccw" data-acorn-size="16"></i>
                                        </button>
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
                                    <span id="changeIndicator">Make your changes and click update</span>
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="d-flex gap-2 justify-content-end">
                                <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary">
                                    <i data-acorn-icon="close" class="me-1" data-acorn-size="16"></i>
                                    Cancel
                                </a>
                                <button type="submit" class="btn btn-warning" id="submitBtn">
                                    <i data-acorn-icon="check" class="me-1" data-acorn-size="16"></i>
                                    Update Category
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <!-- Category Info -->
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="card border-info">
                    
                    <!-- Header -->
                    <div class="card-header bg-info text-white">
                        <h6 class="card-title mb-0">
                            <i data-acorn-icon="info" class="me-2" data-acorn-size="16"></i>
                            Category Details
                        </h6>
                    </div>

                    <!-- Body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <small class="text-muted d-block">ID</small>
                                <strong class="text-primary">#{{ $category->id }}</strong>
                            </div>
                            <div class="col-6">
                                <small class="text-muted d-block">Created</small>
                                <strong class="text-primary">{{ $category->created_at->format('M j, Y') }}</strong>
                            </div>
                        </div>

                        @if($category->updated_at && $category->updated_at != $category->created_at)
                            <hr class="my-2">
                            <div class="row">
                                <div class="col-12">
                                    <small class="text-muted d-block">Last Updated</small>
                                    <strong class="text-warning">
                                        {{ $category->updated_at->format('M j, Y g:i A') }}
                                    </strong>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Editing Tips -->
        <div class="row justify-content-center mt-4">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="card bg-gradient-light">
                    <div class="card-body">
                        <h6 class="card-title text-warning">
                            <i data-acorn-icon="lightbulb" class="me-2" data-acorn-size="16"></i>
                            Editing Tips
                        </h6>
                        <ul class="list-unstyled text-muted mb-0">
                            <li class="mb-2">
                                <i data-acorn-icon="chevron-right" class="text-warning me-2" data-acorn-size="12"></i>
                                Changes will affect all content using this category
                            </li>
                            <li class="mb-2">
                                <i data-acorn-icon="chevron-right" class="text-warning me-2" data-acorn-size="12"></i>
                                Use the reset button to restore the original name
                            </li>
                            <li>
                                <i data-acorn-icon="chevron-right" class="text-warning me-2" data-acorn-size="12"></i>
                                Make sure the new name is clear and descriptive
                            </li>
                        </ul>
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
    const form = document.getElementById('editCategoryForm');
    const submitBtn = document.getElementById('submitBtn');
    const resetBtn = document.getElementById('resetBtn');
    const nameInput = document.getElementById('name');
    const changeIndicator = document.getElementById('changeIndicator');
    const originalName = '{{ $category->name }}';
    let hasUnsavedChanges = false;

    /** Helpers */
    const updateChangeIndicator = () => {
        const currentValue = nameInput.value.trim();
        const hasChanged = currentValue !== originalName;

        if (!currentValue) {
            changeIndicator.innerHTML = 
                '<i data-acorn-icon="warning" class="me-1 text-danger" data-acorn-size="12"></i>Category name cannot be empty';
            changeIndicator.className = 'form-text text-danger';
            submitBtn.disabled = true;
        } else if (hasChanged) {
            changeIndicator.innerHTML = 
                '<i data-acorn-icon="check" class="me-1 text-success" data-acorn-size="12"></i>Category name will be updated';
            changeIndicator.className = 'form-text text-success';
            submitBtn.disabled = false;
        } else {
            changeIndicator.innerHTML = 
                '<i data-acorn-icon="info" class="me-1" data-acorn-size="12"></i>No changes made';
            changeIndicator.className = 'form-text text-muted';
            submitBtn.disabled = false;
        }
    };

    /** Autofocus */
    nameInput.focus();
    nameInput.select();

    /** Reset button */
    resetBtn.addEventListener('click', () => {
        nameInput.value = originalName;
        updateChangeIndicator();
        nameInput.focus();
    });

    /** Input validation & indicator */
    nameInput.addEventListener('input', () => {
        updateChangeIndicator();
        hasUnsavedChanges = (nameInput.value.trim() !== originalName);

        if (nameInput.value.trim()) {
            nameInput.classList.remove('is-invalid');
            nameInput.classList.add('is-valid');
        } else {
            nameInput.classList.remove('is-valid');
            nameInput.classList.add('is-invalid');
        }

        if (nameInput.value.length > 255) {
            nameInput.classList.add('is-invalid');
            nameInput.classList.remove('is-valid');
        }
    });

    /** Form submission */
    form.addEventListener('submit', (e) => {
        const categoryName = nameInput.value.trim();

        if (!categoryName) {
            e.preventDefault();
            nameInput.classList.add('is-invalid');
            changeIndicator.innerHTML = 
                '<i data-acorn-icon="warning" class="me-1 text-danger" data-acorn-size="12"></i>Category name is required';
            changeIndicator.className = 'form-text text-danger';
            return;
        }

        if (categoryName === originalName) {
            if (!confirm('No changes were made. Do you still want to update?')) {
                e.preventDefault();
                return;
            }
        }

        const originalBtnContent = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="spinner-border spinner-border-sm me-1" role="status"></i>Updating...';
        submitBtn.disabled = true;
        hasUnsavedChanges = false;
    });

    /** Keyboard shortcuts */
    nameInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') {
            e.preventDefault();
            form.submit();
        }
    });
    nameInput.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            nameInput.value = originalName;
            updateChangeIndicator();
        }
    });

    /** Unsaved changes warning */
    window.addEventListener('beforeunload', (e) => {
        if (hasUnsavedChanges) {
            e.preventDefault();
            e.returnValue = '';
        }
    });

    /** Auto-save (demo) */
    let autoSaveTimeout;
    nameInput.addEventListener('input', () => {
        clearTimeout(autoSaveTimeout);
        autoSaveTimeout = setTimeout(() => {
            console.log('Auto-save triggered for:', nameInput.value);
        }, 2000);
    });

    updateChangeIndicator();
});
</script>
@endsection
