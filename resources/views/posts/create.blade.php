@extends('layout')

@section('content')
    <h1 class="text-3xl font-bold text-blue-800 dark:text-blue-200 mb-6">Create New Post</h1>
    @if ($errors->any())
        <div class="bg-red-100 border border-red-300 text-red-800 px-4 sm:px-6 py-3 sm:py-4 rounded mb-6 dark:bg-red-900 dark:border-red-700 dark:text-red-200 text-sm sm:text-base">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="bg-white dark:bg-gray-900 p-4 sm:p-8 rounded shadow-md w-full max-w-xl mx-auto">
        @csrf
        <div class="mb-5">
            <label for="title" class="block font-semibold text-gray-700 dark:text-gray-200 mb-2">Title</label>
            <input type="text" id="title" name="title" value="{{ old('title') }}" required class="w-full border border-gray-300 dark:border-gray-700 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-300 dark:bg-gray-800 dark:text-gray-100 text-sm sm:text-base">
        </div>
        <div class="mb-8">
            <label for="category_id" class="block font-semibold text-gray-700 dark:text-gray-200 mb-2">Category</label>
            <select id="category_id" name="category_id" class="w-full border border-gray-300 dark:border-gray-700 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-300 dark:bg-gray-800 dark:text-gray-100 text-sm sm:text-base">
                <option value="">Select a category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-8">
            <label for="image" class="block font-semibold text-gray-700 dark:text-gray-200 mb-2">Image</label>
            <input type="file" id="image" name="image" accept="image/*" class="w-full border border-gray-300 dark:border-gray-700 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-300 dark:bg-gray-800 dark:text-gray-100 text-sm sm:text-base">
            <p class="text-xs text-gray-500 mt-1">Accepted: jpg, jpeg, png, webp. Max 10MB.</p>
        </div>
        <div class="mb-5">
            <label for="content" class="block font-semibold text-gray-700 dark:text-gray-200 mb-2">Content</label>
            <textarea id="content" name="content" required class="w-full border border-gray-300 dark:border-gray-700 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-300 min-h-[100px] dark:bg-gray-800 dark:text-gray-100 text-sm sm:text-base">{{ old('content') }}</textarea>
        </div>
        <div class="mb-8">
            <label for="genre_id" class="block font-semibold text-gray-700 dark:text-gray-200 mb-2">Genre</label>
            <select id="genre_id" name="genre_id" required class="w-full border border-gray-300 dark:border-gray-700 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-300 dark:bg-gray-800 dark:text-gray-100 text-sm sm:text-base">
                <option value="">Select a genre</option>
                @foreach ($genres as $genre)
                    <option value="{{ $genre->id }}" {{ old('genre_id') == $genre->id ? 'selected' : '' }}>
                        {{ $genre->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 sm:gap-4">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded shadow transition w-full sm:w-auto">Create Post</button>
            <a href="{{ route('posts.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-gray-200 font-semibold px-6 py-2 rounded shadow transition w-full sm:w-auto text-center">Cancel</a>
        </div>
    </form>
@endsection
