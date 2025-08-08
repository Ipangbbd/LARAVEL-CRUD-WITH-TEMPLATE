@extends('layout')

@section('content')
    @php
        use Illuminate\Support\Str;
    @endphp
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4 w-full">
        <h1 class="text-3xl font-bold text-blue-800 dark:text-blue-200 w-full text-center sm:text-left">Posts</h1>
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
                    <th class="px-2 sm:px-6 py-3 text-left text-xs font-bold text-white dark:text-blue-200 uppercase tracking-wider">Image</th>
                    <th class="px-2 sm:px-6 py-3 text-left text-xs font-bold text-white dark:text-blue-200 uppercase tracking-wider">Title</th>
                    <th class="px-2 sm:px-6 py-3 text-left text-xs font-bold text-white dark:text-blue-200 uppercase tracking-wider">Content</th>
                    <th class="px-2 sm:px-6 py-3 text-left text-xs font-bold text-white dark:text-blue-200 uppercase tracking-wider">Genre</th>
                    <th class="px-2 sm:px-6 py-3 text-left text-xs font-bold text-white dark:text-blue-200 uppercase tracking-wider">Category</th>
                    <th class="px-2 sm:px-6 py-3 text-left text-xs font-bold text-white dark:text-blue-200 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                @foreach ($posts as $post)
                    <tr class="hover:bg-blue-50 dark:hover:bg-gray-800 transition sm:rounded-none rounded-lg sm:table-row flex flex-col sm:flex-row mb-4 sm:mb-0 bg-white dark:bg-gray-900 sm:bg-transparent sm:dark:bg-transparent shadow sm:shadow-none">
                        <td class="px-2 sm:px-6 py-2 sm:py-4 text-gray-900 dark:text-gray-100 flex-1">{{ $post->id }}</td>
                        <td class="px-2 sm:px-6 py-2 sm:py-4 flex-1">
                            @if ($post->image_path)
                                <img src="{{ asset('storage/' . $post->image_path) }}" alt="{{ $post->title }}" class="h-20 w-20 object-cover rounded border" />
                            @else
                                <div class="h-20 w-20 rounded border flex items-center justify-center text-xs text-gray-400">No Image</div>
                            @endif
                        </td>
                        <td class="px-2 sm:px-6 py-2 sm:py-4 font-semibold text-blue-900 dark:text-blue-300 flex-1">{{ $post->title }}</td>
                        <td class="px-2 sm:px-6 py-2 sm:py-4 text-gray-700 dark:text-gray-300 flex-1">{{ Str::limit($post->content, 50) }}</td>
                        <td class="px-2 sm:px-6 py-2 sm:py-4 text-gray-900 dark:text-gray-200 flex-1">{{ $post->genre->name }}</td>
                        <td class="px-2 sm:px-6 py-2 sm:py-4 text-gray-900 dark:text-gray-200 flex-1">{{ optional($post->category)->name ?? '-' }}</td>
                        <td class="px-2 sm:px-6 py-2 sm:py-4 space-x-2 flex flex-row flex-wrap gap-2 sm:gap-0 sm:space-x-2">
                            <a href="{{ route('posts.show', $post->id) }}" class="inline-block bg-blue-100 hover:bg-blue-200 text-blue-700 dark:bg-blue-900 dark:hover:bg-blue-800 dark:text-blue-200 font-semibold px-3 py-1 rounded transition w-full sm:w-auto text-center">View</a>
                            <a href="{{ route('posts.edit', $post->id) }}" class="inline-block bg-yellow-100 hover:bg-yellow-200 text-yellow-800 dark:bg-yellow-900 dark:hover:bg-yellow-800 dark:text-yellow-200 font-semibold px-3 py-1 rounded transition w-full sm:w-auto text-center">Edit</a>
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="inline w-full sm:w-auto">
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
        <a href="{{ route('posts.create') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded shadow transition w-full sm:w-auto text-center mr-3">Create New Post</a>
        <a href="{{ route('genres.create') }}" class="inline-block bg-green-600 hover:bg-green-700 text-white font-semibold px-5 py-2 rounded shadow transition w-full sm:w-auto text-center mr-3">Create New Genre</a>
        <a href="{{ route('categories.create') }}" class="inline-block bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-5 py-2 rounded shadow transition w-full sm:w-auto text-center">Create New Category</a>
    </div>
@endsection