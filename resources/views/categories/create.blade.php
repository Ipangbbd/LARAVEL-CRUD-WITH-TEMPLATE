@extends('layout')

@section('content')
    <h1 class="text-3xl font-bold text-blue-800 dark:text-blue-200 mb-6">Create New Category</h1>
    @if ($errors->any())
        <div class="bg-red-100 border border-red-300 text-red-800 px-4 sm:px-6 py-3 sm:py-4 rounded mb-6 dark:bg-red-900 dark:border-red-700 dark:text-red-200 text-sm sm:text-base">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('categories.store') }}" method="POST" class="bg-white dark:bg-gray-900 p-4 sm:p-8 rounded shadow-md w-full max-w-xl mx-auto">
        @csrf
        <div class="mb-5">
            <label for="name" class="block font-semibold text-gray-700 dark:text-gray-200 mb-2">Name</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required class="w-full border border-gray-300 dark:border-gray-700 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-300 dark:bg-gray-800 dark:text-gray-100 text-sm sm:text-base">
        </div>
        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 sm:gap-4">
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded shadow transition w-full sm:w-auto">Create Category</button>
            <a href="{{ route('categories.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-gray-200 font-semibold px-6 py-2 rounded shadow transition w-full sm:w-auto text-center">Cancel</a>
        </div>
    </form>
@endsection


