@extends('layout')

@section('page-title', 'Categories')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Categories</li>
@endsection

@section('content')
<div class="row">
    <div class="col-12">

        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="small-title">Manage Categories</h2>
            <a href="{{ route('categories.create') }}" class="btn btn-icon btn-icon-start btn-success">
                <i data-acorn-icon="plus" class="icon" data-acorn-size="18"></i>
                <span>Create New Category</span>
            </a>
        </div>

        <!-- Success Toast -->
        @if ($message = Session::get('success'))
            <div id="success-toast" class="position-fixed bottom-0 start-50 translate-middle-x mb-3" style="z-index:1050;">
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

        <!-- Categories Table -->
        <div class="card mb-5">
            <div class="card-header">
                <h5 class="card-title">All Categories</h5>
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
                            @forelse ($categories as $category)
                                <tr>
                                    <td class="text-alternate">{{ $category->id }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i data-acorn-icon="grid-2" class="text-primary me-2" data-acorn-size="16"></i>
                                            <span class="fw-bold text-primary">{{ $category->name }}</span>
                                        </div>
                                    </td>
                                    <td class="text-end">
                                        <div class="btn-group" role="group">
                                            <a  href="{{ route('categories.edit', $category->id) }}"
                                                class="btn btn-sm btn-icon btn-icon-only btn-outline-warning"
                                                title="Edit Category">
                                                <i data-acorn-icon="edit" data-acorn-size="16"></i>
                                            </a>
                                            <form   action="{{ route('categories.destroy', $category->id) }}" 
                                                    method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="btn btn-sm btn-icon btn-icon-only btn-outline-danger"
                                                        onclick="return confirm('Are you sure you want to delete this category?')"
                                                        title="Delete Category">
                                                    <i data-acorn-icon="bin" data-acorn-size="16"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-5">
                                        <i data-acorn-icon="grid-2" class="text-primary mb-3" data-acorn-size="48"></i>
                                        <div class="mb-2">No categories found.</div>
                                        <a href="{{ route('categories.create') }}" class="btn btn-sm btn-primary">
                                            <i data-acorn-icon="plus" class="me-1" data-acorn-size="14"></i>
                                            Create the first category
                                        </a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            @if(method_exists($categories, 'links') && $categories->hasPages())
                <div class="card-footer">
                    <div class="d-flex justify-content-center">
                        {{ $categories->links() }}
                    </div>
                </div>
            @endif
        </div>

        <!-- Category Stats -->
        <div class="row">
            <div class="col-12 col-md-4">
                <div class="card bg-gradient-light mb-3">
                    <div class="card-body text-center">
                        <i data-acorn-icon="screen" class="text-white mb-2" data-acorn-size="32"></i>
                        <h3 class="card-title">{{ count($categories) }}</h3>
                        <p class="card-text text-muted">Total Categories</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card bg-gradient-light mb-3">
                    <div class="card-body text-center">
                        <i data-acorn-icon="calendar" class="text-white mb-2" data-acorn-size="32"></i>
                        <h3 class="card-title">
                            {{ $categories->where('created_at', '>=', now()->subDays(30))->count() ?? 0 }}
                        </h3>
                        <p class="card-text text-muted">Added This Month</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card bg-gradient-light mb-3">
                    <div class="card-body text-center">
                        <i data-acorn-icon="light-on" class="text-white mb-2" data-acorn-size="32"></i>
                        <h3 class="card-title">Active</h3>
                        <p class="card-text text-muted">Status</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="card border-primary">
            <div class="card-header bg-primary text-white">
                <h6 class="card-title mb-0">
                    <i data-acorn-icon="lightning" class="me-2" data-acorn-size="16"></i>
                    Quick Actions
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-6 mb-3">
                        <a href="{{ route('categories.create') }}" class="btn btn-outline-primary w-100">
                            <i data-acorn-icon="check-circle" class="me-2" data-acorn-size="16"></i>
                            Create New Category
                        </a>
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <button type="button" class="btn btn-outline-secondary w-100" onclick="window.print()">
                            <i data-acorn-icon="print" class="me-2" data-acorn-size="16"></i>
                            Print Categories List
                        </button>
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
    // Enhanced delete confirmation
    document.querySelectorAll('form[method="POST"]').forEach(form => {
        const deleteBtn = form.querySelector('button[type="submit"]');
        if (deleteBtn && deleteBtn.innerHTML.includes('bin')) {
            deleteBtn.addEventListener('click', function (e) {
                e.preventDefault();
                if (confirm('Are you sure you want to delete this category? This action cannot be undone.')) {
                    const originalContent = this.innerHTML;
                    this.innerHTML = '<i class="spinner-border spinner-border-sm" role="status"></i>';
                    this.disabled = true;
                    form.submit();
                }
            });
        }
    });

    // Table hover effect
    document.querySelectorAll('tbody tr').forEach(row => {
        row.addEventListener('mouseenter', () => row.style.backgroundColor = 'rgba(0, 123, 255, 0.05)');
        row.addEventListener('mouseleave', () => row.style.backgroundColor = '');
    });

    // Auto-hide success toast
    const successToast = document.getElementById('success-toast');
    if (successToast) {
        setTimeout(() => {
            const bsToast = new bootstrap.Toast(successToast.querySelector('.toast'));
            bsToast.hide();
        }, 5000);
    }

    // Category Search (optional enhancement)
    const searchInput = document.getElementById('categorySearch');
    if (searchInput) {
        searchInput.addEventListener('input', function () {
            const term = this.value.toLowerCase();
            document.querySelectorAll('tbody tr').forEach(row => {
                const categoryName = row.querySelector('td:nth-child(2)')?.textContent.toLowerCase() || '';
                row.style.display = categoryName.includes(term) ? '' : 'none';
            });
        });
    }
});
</script>
@endsection
