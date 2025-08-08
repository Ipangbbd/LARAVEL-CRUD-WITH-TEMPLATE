@extends('layout')

@section('content')
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4 w-full">
        <h1 class="text-3xl font-bold text-blue-800 dark:text-blue-200 w-full text-center sm:text-left">Genres</h1>
    </div>

    @if ($message = Session::get('success'))
        <div id="success-toast" class="fixed bottom-6 left-1/2 transform -translate-x-1/2 z-50 bg-green-100 border border-green-300 text-green-800 px-6 py-4 rounded shadow-lg dark:bg-green-900 dark:border-green-700 dark:text-green-200 transition-opacity duration-500">
            {{ $message }}
        </div>
        <script>
            setTimeout(function() {
                var toast = document.getElementById('success-toast');
                if (toast) {
                    toast.style.opacity = '0';
                    setTimeout(function() { toast.style.display = 'none'; }, 500);
                }
            }, 3000);
        </script>
    @endif

    <div class="overflow-x-auto rounded shadow w-full">
        <table class="min-w-full bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700 text-sm sm:text-base">
            <thead class="bg-blue-700 dark:bg-gray-800">
                <tr>
                    <th class="px-2 sm:px-6 py-3 text-left text-xs font-bold text-white dark:text-blue-200 uppercase tracking-wider">ID</th>
                    <th class="px-2 sm:px-6 py-3 text-left text-xs font-bold text-white dark:text-blue-200 uppercase tracking-wider">Name</th>
                    <th class="px-2 sm:px-6 py-3 text-left text-xs font-bold text-white dark:text-blue-200 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                @foreach ($genres as $genre)
                    <tr class="hover:bg-blue-50 dark:hover:bg-gray-800 transition sm:rounded-none rounded-lg sm:table-row flex flex-col sm:flex-row mb-4 sm:mb-0 bg-white dark:bg-gray-900 sm:bg-transparent sm:dark:bg-transparent shadow sm:shadow-none">
                        <td class="px-2 sm:px-6 py-2 sm:py-4 text-gray-900 dark:text-gray-100 flex-1">{{ $genre->id }}</td>
                        <td class="px-2 sm:px-6 py-2 sm:py-4 font-semibold text-blue-900 dark:text-blue-300 flex-1">
                            <div class="genre-name-display cursor-pointer" data-genre-id="{{ $genre->id }}">{{ $genre->name }}</div>
                            <form action="{{ route('genres.update', $genre->id) }}" method="POST" class="inline-flex items-center genre-edit-form hidden" data-genre-id="{{ $genre->id }}">
                                @csrf
                                @method('PUT')
                                <input type="text" name="name" value="{{ $genre->name }}" class="border border-gray-300 dark:border-gray-700 rounded px-2 py-1 focus:outline-none focus:ring-2 focus:ring-blue-300 dark:bg-gray-800 dark:text-gray-100 text-sm sm:text-base w-full">
                                <button type="submit" class="ml-2 bg-green-100 hover:bg-green-200 text-green-700 dark:bg-green-900 dark:hover:bg-green-800 dark:text-green-200 font-semibold px-2 py-1 rounded transition text-xs sm:text-sm">Save</button>
                                <button type="button" class="ml-1 bg-gray-100 hover:bg-gray-200 text-gray-700 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-gray-200 font-semibold px-2 py-1 rounded transition text-xs sm:text-sm cancel-edit" data-original-name="{{ $genre->name }}">Cancel</button>
                            </form>
                        </td>
                        <td class="px-2 sm:px-6 py-2 sm:py-4 space-x-2 flex flex-row flex-wrap gap-2 sm:gap-0 sm:space-x-2">
                            <form action="{{ route('genres.destroy', $genre->id) }}" method="POST" class="inline w-full sm:w-auto">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-block bg-red-100 hover:bg-red-200 text-red-700 dark:bg-red-900 dark:hover:bg-red-800 dark:text-red-200 font-semibold px-3 py-1 rounded transition w-full sm:w-auto text-center">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-6 flex justify-center w-full">
        <a href="{{ route('genres.create') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded shadow transition w-full sm:w-auto text-center">Create New Genre</a>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.genre-name-display').forEach(item => {
                item.addEventListener('click', function () {
                    const genreId = this.dataset.genreId;
                    document.querySelectorAll(`.genre-edit-form[data-genre-id="${genreId}"]`).forEach(form => {
                        form.classList.remove('hidden');
                        form.querySelector('input[name="name"]').focus(); // Focus on the input field
                    });
                    this.classList.add('hidden');
                });
            });

            document.querySelectorAll('.cancel-edit').forEach(item => {
                item.addEventListener('click', function () {
                    const genreId = this.closest('.genre-edit-form').dataset.genreId;
                    const originalName = this.dataset.originalName;
                    const genreNameInput = this.closest('.genre-edit-form').querySelector('input[name="name"]');
                    genreNameInput.value = originalName; // Reset input to original value

                    document.querySelectorAll(`.genre-edit-form[data-genre-id="${genreId}"]`).forEach(form => {
                        form.classList.add('hidden');
                    });
                    document.querySelectorAll(`.genre-name-display[data-genre-id="${genreId}"]`).forEach(display => {
                        display.classList.remove('hidden');
                    });
                });
            });

            document.querySelectorAll('.genre-edit-form').forEach(form => {
                console.log('Attaching submit listener to form:', form);
                form.addEventListener('submit', function (e) {
                    e.preventDefault();

                    const genreId = this.dataset.genreId;
                    const genreNameInput = this.querySelector('input[name="name"]');
                    const newName = genreNameInput.value;

                    console.log('Attempting to save genre:', genreId, newName);
                    console.log('Form action URL:', this.action);
                    console.log('CSRF Token:', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

                    fetch(this.action, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ name: newName, _method: 'PUT' })
                    })
                    .then(response => {
                        console.log('Raw response:', response);
                        if (!response.ok) {
                            console.error('HTTP error! status:', response.status);
                            return response.json().then(err => { throw err; });
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Response data:', data);
                        if (data.success) {
                            document.querySelectorAll(`.genre-name-display[data-genre-id="${genreId}"]`).forEach(display => {
                                display.textContent = newName;
                                display.classList.remove('hidden');
                            });
                            document.querySelectorAll(`.genre-edit-form[data-genre-id="${genreId}"]`).forEach(form => {
                                form.classList.add('hidden');
                            });
                            // Display success toast
                            const successToast = document.getElementById('success-toast');
                            if (successToast) {
                                successToast.textContent = data.message;
                                successToast.style.opacity = '1';
                                successToast.style.display = 'block';
                                setTimeout(function() {
                                    successToast.style.opacity = '0';
                                    setTimeout(function() { successToast.style.display = 'none'; }, 500);
                                }, 3000);
                            }
                        } else {
                            console.error('Server responded with error:', data.message);
                            alert('Error updating genre: ' + data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                        alert('An error occurred while updating the genre: ' + error.message);
                    });
                });
            });
        });
    </script>
@endsection