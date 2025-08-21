@extends('layout')

@section('page-title', 'Create Genre')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('genres.index') }}">Genres</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">Create</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">

            {{-- Page Header --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="small-title">Create New Genre</h2>
                <a href="{{ route('genres.index') }}" class="btn btn-icon btn-icon-start btn-outline-primary">
                    <i data-acorn-icon="chevron-left" class="icon" data-acorn-size="18"></i>
                    <span>Back to Genres</span>
                </a>
            </div>

            {{-- Error Messages --}}
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i data-acorn-icon="warning-hexagon" class="me-2" data-acorn-size="16"></i>
                    <strong>Please fix the following errors:</strong>
                    <ul class="list-unstyled mt-2 mb-0">
                        @foreach ($errors->all() as $error)
                            <li>
                                <i data-acorn-icon="chevron-right" class="me-1" data-acorn-size="12"></i>
                                {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Create Genre Form --}}
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-6">
                    <div class="card mb-5">
                        <div class="card-header">
                            <h5 class="card-title d-flex align-items-center">
                                <i data-acorn-icon="plus-circle" class="me-2" data-acorn-size="20"></i>
                                Genre Information
                            </h5>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('genres.store') }}" method="POST" id="createGenreForm">
                                @csrf

                                {{-- Genre Name --}}
                                <div class="mb-4">
                                    <label for="name" class="form-label">
                                        Genre Name <span class="text-danger">*</span>
                                    </label>
                                    <div class="position-relative">
                                        <input 
                                            type="text"
                                            id="name"
                                            name="name"
                                            value="{{ old('name') }}"
                                            class="form-control @error('name') is-invalid @enderror"
                                            placeholder="Enter genre name"
                                            required
                                            autocomplete="off"
                                        >
                                        <div class="invalid-feedback">
                                            @error('name')
                                                {{ $message }}
                                            @else
                                                Please provide a valid genre name.
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-text text-muted">
                                        <i data-acorn-icon="info" class="me-1" data-acorn-size="12"></i>
                                        Choose a descriptive name for your genre
                                    </div>
                                </div>

                                {{-- Actions --}}
                                <div class="d-flex gap-2 justify-content-end">
                                    <a href="{{ route('genres.index') }}" class="btn btn-outline-secondary">
                                        <i data-acorn-icon="close" class="me-1" data-acorn-size="16"></i>
                                        Cancel
                                    </a>
                                    <button type="submit" class="btn btn-primary" id="submitBtn">
                                        <i data-acorn-icon="check" class="me-1" data-acorn-size="16"></i>
                                        Create Genre
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Help / Tips Section --}}
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-6">
                    <div class="card border-primary">
                        <div class="card-body">
                            <h6 class="card-title text-primary">
                                <i data-acorn-icon="help" class="me-2" data-acorn-size="16"></i>
                                Tips for Creating Genres
                            </h6>
                            <div class="card-text text-muted">
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-2">
                                        <i data-acorn-icon="chevron-right" class="text-primary me-2" data-acorn-size="12"></i>
                                        Use clear, descriptive names (e.g., "Science Fiction", "Romance")
                                    </li>
                                    <li class="mb-2">
                                        <i data-acorn-icon="chevron-right" class="text-primary me-2" data-acorn-size="12"></i>
                                        Keep names concise but meaningful
                                    </li>
                                    <li>
                                        <i data-acorn-icon="chevron-right" class="text-primary me-2" data-acorn-size="12"></i>
                                        Check if the genre already exists before creating
                                    </li>
                                </ul>
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
        const form      = document.getElementById('createGenreForm');
        const submitBtn = document.getElementById('submitBtn');
        const nameInput = document.getElementById('name');

        // Autofocus on name input
        nameInput.focus();

        // Form submission handling
        form.addEventListener('submit', (e) => {
            const genreName = nameInput.value.trim();

            if (!genreName) {
                e.preventDefault();
                nameInput.classList.add('is-invalid');
                return;
            }

            // Loading state
            submitBtn.disabled = true;
            submitBtn.innerHTML = `
                <i class="spinner-border spinner-border-sm me-1" role="status"></i>
                Creating...
            `;
        });

        // Remove validation error on input
        nameInput.addEventListener('input', () => {
            if (nameInput.value.trim()) {
                nameInput.classList.remove('is-invalid');
            }
        });

        // Submit form on Enter key
        nameInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                form.submit();
            }
        });

        // Character length validation
        nameInput.addEventListener('input', () => {
            const maxLength = 255;
            if (nameInput.value.length > maxLength) {
                nameInput.classList.add('is-invalid');
            } else {
                nameInput.classList.remove('is-invalid');
            }
        });
    });
</script>
@endsection
