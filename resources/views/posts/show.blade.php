@extends('layout')
@section('content')
    <h1 class="text-3xl font-bold text-blue-800 dark:text-blue-200 mb-6">View Post</h1>
    <div class="bg-white dark:bg-gray-900 rounded shadow p-4 sm:p-8 mb-8 w-full max-w-xl mx-auto">
        <h2 class="text-2xl font-semibold text-blue-700 dark:text-blue-300 mb-4">{{ $post->title }}</h2>
        @if ($post->image_path)
            <img src="{{ asset('storage/' . $post->image_path) }}" alt="{{ $post->title }}" class="h-40 w-40 object-cover rounded border mb-4">
        @endif
        <p class="mb-2 text-sm sm:text-base"><span class="font-semibold text-gray-700 dark:text-gray-200">Content:</span> <span class="text-gray-900 dark:text-gray-100">{{ $post->content }}</span></p>
        <p class="mb-2 text-sm sm:text-base"><span class="font-semibold text-gray-700 dark:text-gray-200">Genre:</span> <span class="text-gray-900 dark:text-gray-100">{{ $post->genre->name }}</span></p>
        <p class="mb-2 text-sm sm:text-base"><span class="font-semibold text-gray-700 dark:text-gray-200">Category:</span> <span class="text-gray-900 dark:text-gray-100">{{ optional($post->category)->name ?? '-' }}</span></p>
        <p class="mb-2 text-sm sm:text-base"><span class="font-semibold text-gray-700 dark:text-gray-200">Created At:</span> <span class="text-gray-900 dark:text-gray-100">{{ $post->created_at->format('Y-m-d H:i:s') }}</span></p>
        <p class="mb-2 text-sm sm:text-base"><span class="font-semibold text-gray-700 dark:text-gray-200">Updated At:</span> <span class="text-gray-900 dark:text-gray-100">{{ $post->updated_at->format('Y-m-d H:i:s') }}</span></p>
    </div>
    <div class="flex flex-col sm:flex-row flex-wrap gap-3 sm:gap-4 w-full max-w-xl mx-auto">
        <a href="{{ route('posts.edit', $post->id) }}" class="bg-yellow-100 hover:bg-yellow-200 text-yellow-800 dark:bg-yellow-900 dark:hover:bg-yellow-800 dark:text-yellow-200 font-semibold px-5 py-2 rounded shadow transition w-full sm:w-auto text-center">Edit</a>
        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="inline w-full sm:w-auto">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-100 hover:bg-red-200 text-red-700 dark:bg-red-900 dark:hover:bg-red-800 dark:text-red-200 font-semibold px-5 py-2 rounded shadow transition w-full sm:w-auto text-center">Delete</button>
        </form>
        <a href="{{ route('posts.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-gray-200 font-semibold px-5 py-2 rounded shadow transition w-full sm:w-auto text-center">Back to Posts</a>
    </div>
@endsection