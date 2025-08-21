@extends('layout')

@section('page-title', 'Genres')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Genres</li>
@endsection

@section('content')
<div class="row">
    <div class="col-12">

        <!-- Header: Title + Create Button -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="small-title">Manage Genres</h2>
            <a href="{{ route('genres.create') }}" class="btn btn-icon btn-icon-start btn-primary">
                <i data-acorn-icon="plus" class="icon" data-acorn-size="18"></i>
                <span>Create New Genre</span>
            </a>
        </div>

        <!-- Success Toast -->
        @if ($message = Session::get('success'))
            <div    id="success-toast" 
                    class="position-fixed bottom-0 start-50 translate-middle-x mb-3" 
                    style="z-index: 1050;">
                <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header bg-success text-white">
                        <i data-acorn-icon="check-circle" data-acorn-size="16" class="me-2"></i>
                        <strong class="me-auto">Success</strong>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        {{ $message }}
                    </div>
                </div>
            </div>
            <script>
                setTimeout(() => {
                    const toast = document.getElementById('success-toast');
                    if (toast) {
                        const bsToast = new bootstrap.Toast(toast.querySelector('.toast'));
                        bsToast.hide();
                    }
                }, 3000);
            </script>
        @endif

        <!-- Genres Table -->
        <div class="card mb-5">
            <div class="card-header">
                <h5 class="card-title">All Genres</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-primary">
                            <tr>
                                <th scope="col" class="text-muted text-small text-uppercase">ID</th>
                                <th scope="col" class="text-muted text-small text-uppercase">Name</th>
                                <th scope="col" class="text-muted text-small text-uppercase text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($genres as $genre)
                                <tr>
                                    <!-- Genre ID -->
                                    <td class="text-alternate">{{ $genre->id }}</td>

                                    <!-- Genre Name (inline-edit) -->
                                    <td>
                                        <!-- Display -->
                                        <div class="genre-name-display cursor-pointer fw-bold text-primary" data-genre-id="{{ $genre->id }}">
                                            {{ $genre->name }}
                                            <i data-acorn-icon="edit" class="text-muted ms-2" data-acorn-size="14"></i>
                                        </div>

                                        <!-- Edit Form -->
                                        <form   action="{{ route('genres.update', $genre->id) }}" 
                                                method="POST" 
                                                class="genre-edit-form d-none" 
                                                data-genre-id="{{ $genre->id }}">
                                            @csrf
                                            @method('PUT')

                                            <div class="d-flex align-items-center gap-2">
                                                <input  type="text" 
                                                        name="name" 
                                                        value="{{ $genre->name }}" 
                                                        class="form-control form-control-sm">

                                                <button type="submit" 
                                                        class="btn btn-sm btn-icon btn-icon-only btn-success">
                                                    <i data-acorn-icon="check" data-acorn-size="16"></i>
                                                </button>

                                                <button type="button" 
                                                        class="btn btn-sm btn-icon btn-icon-only btn-outline-secondary cancel-edit" 
                                                        data-original-name="{{ $genre->name }}">
                                                    <i data-acorn-icon="close" data-acorn-size="16"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </td>

                                    <!-- Actions -->
                                    <td class="text-end">
                                        <form   action="{{ route('genres.destroy', $genre->id) }}" 
                                                method="POST" 
                                                class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-sm btn-icon btn-icon-only btn-outline-danger"
                                                    onclick="return confirm('Are you sure you want to delete this genre?')"
                                                    title="Delete Genre">
                                                <i data-acorn-icon="bin" data-acorn-size="16"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-5">
                                        <i data-acorn-icon="tag" class="text-primary mb-3" data-acorn-size="48"></i>
                                        <br>
                                        No genres found. 
                                        <a href="{{ route('genres.create') }}" class="text-primary">Create the first one!</a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {

    /**
     * Inline Edit Toggle
     */
    document.querySelectorAll('.genre-name-display').forEach(display => {
        display.addEventListener('click', function () {
            const genreId = this.dataset.genreId;
            const editForm = document.querySelector(`.genre-edit-form[data-genre-id="${genreId}"]`);

            if (editForm) {
                editForm.classList.remove('d-none');
                editForm.querySelector('input[name="name"]').focus();
                this.classList.add('d-none');
            }
        });
    });

    /**
     * Cancel Edit
     */
    document.querySelectorAll('.cancel-edit').forEach(btn => {
        btn.addEventListener('click', function () {
            const form = this.closest('.genre-edit-form');
            const genreId = form.dataset.genreId;
            const originalName = this.dataset.originalName;
            const nameInput = form.querySelector('input[name="name"]');
            const nameDisplay = document.querySelector(`.genre-name-display[data-genre-id="${genreId}"]`);

            nameInput.value = originalName;
            form.classList.add('d-none');
            nameDisplay.classList.remove('d-none');
        });
    });

    /**
     * AJAX Update
     */
    document.querySelectorAll('.genre-edit-form').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            const genreId = this.dataset.genreId;
            const nameInput = this.querySelector('input[name="name"]');
            const newName = nameInput.value.trim();
            const nameDisplay = document.querySelector(`.genre-name-display[data-genre-id="${genreId}"]`);

            if (!newName) {
                alert('Genre name cannot be empty');
                return;
            }

            // Loading state
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalBtnContent = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="spinner-border spinner-border-sm" role="status"></i>';
            submitBtn.disabled = true;

            fetch(this.action, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ 
                    name: newName, 
                    _method: 'PUT' 
                })
            })
            .then(response => {
                if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    nameDisplay.firstChild.textContent = newName + ' ';
                    this.classList.add('d-none');
                    nameDisplay.classList.remove('d-none');
                    showSuccessToast(data.message || 'Genre updated successfully');
                } else {
                    throw new Error(data.message || 'Unknown error occurred');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error updating genre: ' + error.message);
            })
            .finally(() => {
                submitBtn.innerHTML = originalBtnContent;
                submitBtn.disabled = false;
            });
        });
    });

    /**
     * Toast Helper
     */
    function showSuccessToast(message) {
        // Remove existing
        const existingToast = document.getElementById('success-toast');
        if (existingToast) existingToast.remove();

        // Insert new
        const toastHtml = `
            <div id="success-toast" class="position-fixed bottom-0 start-50 translate-middle-x mb-3" style="z-index: 1050;">
                <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header bg-success text-white">
                        <i data-acorn-icon="check-circle" data-acorn-size="16" class="me-2"></i>
                        <strong class="me-auto">Success</strong>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">${message}</div>
                </div>
            </div>
        `;

        document.body.insertAdjacentHTML('beforeend', toastHtml);

        // Auto-hide
        setTimeout(() => {
            const toast = document.getElementById('success-toast');
            if (toast) {
                const bsToast = new bootstrap.Toast(toast.querySelector('.toast'));
                bsToast.hide();
            }
        }, 3000);
    }

});
</script>
@endsection
