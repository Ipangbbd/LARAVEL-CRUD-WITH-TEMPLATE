@extends('layout')

@section('content')
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4 w-full">
        <h1 class="text-3xl font-bold text-blue-800 dark:text-blue-200 w-full text-center sm:text-left">Categories</h1>
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
                    <th class="px-2 sm:px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">ID</th>
                    <th class="px-2 sm:px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">Name</th>
                    <th class="px-2 sm:px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                @foreach ($categories as $category)
                    <tr class="hover:bg-blue-50 dark:hover:bg-gray-800 transition">
                        <td class="px-2 sm:px-6 py-2 sm:py-4">{{ $category->id }}</td>
                        <td class="px-2 sm:px-6 py-2 sm:py-4 font-semibold">{{ $category->name }}</td>
                        <td class="px-2 sm:px-6 py-2 sm:py-4 space-x-2">
                            <a href="{{ route('categories.edit', $category->id) }}" class="inline-block bg-yellow-100 hover:bg-yellow-200 text-yellow-800 dark:bg-yellow-900 dark:hover:bg-yellow-800 dark:text-yellow-200 font-semibold px-3 py-1 rounded transition">Edit</a>
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-block bg-red-100 hover:bg-red-200 text-red-700 dark:bg-red-900 dark:hover:bg-red-800 dark:text-red-200 font-semibold px-3 py-1 rounded transition">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-6 flex justify-center w-full">
        <a href="{{ route('categories.create') }}" class="inline-block bg-green-600 hover:bg-green-700 text-white font-semibold px-5 py-2 rounded shadow transition w-full sm:w-auto text-center">Create New Category</a>
    </div>
@endsection


