<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel CRUD</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: '#2563eb',
                        secondary: '#64748b',
                    },
                    boxShadow: {
                        glass: '0 8px 32px 0 rgba(31, 38, 135, 0.18)',
                    },
                    backdropBlur: {
                        xs: '2px',
                    },
                },
            },
        }
    </script>
    @yield('styles')
</head>
<body id="body" class="bg-gradient-to-br from-blue-100 to-blue-200 dark:from-gray-900 dark:to-gray-800 min-h-screen font-sans flex flex-col min-h-screen transition-colors duration-300">
    <!-- Navbar -->
    <nav class="sticky top-0 z-30 bg-white/70 dark:bg-gray-900/80 backdrop-blur-md shadow-glass py-3 mb-8 transition-all">
        <div class="container mx-auto flex justify-between items-center px-4">
            <div class="flex items-center gap-3">
                <a href="/" class="text-2xl font-bold text-blue-700 dark:text-blue-200 tracking-wide">Laravel CRUD</a>
            </div>
            <div class="flex items-center gap-4">
                <a href="{{ route('posts.index') }}" class="text-gray-700 dark:text-gray-200 hover:text-blue-600 dark:hover:text-blue-400 transition font-medium">Posts</a>
                <a href="{{ route('genres.index') }}" class="text-gray-700 dark:text-gray-200 hover:text-blue-600 dark:hover:text-blue-400 transition font-medium">Genres</a>
                <a href="{{ route('categories.index') }}" class="text-gray-700 dark:text-gray-200 hover:text-blue-600 dark:hover:text-blue-400 transition font-medium">Categories</a>
                <button id="darkModeToggle" class="ml-2 px-3 py-1 rounded bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 transition font-medium" title="Toggle dark mode">🌙</button>
            </div>
        </div>
    </nav>
    <!-- Content -->
    <div class="container mx-auto px-4 max-w-7xl flex-1 w-full dark:text-gray-100 flex flex-col items-center">
        @yield('content')
    </div>
    <!-- Footer -->
    <footer class="bg-white/80 dark:bg-gray-900/80 backdrop-blur-xs shadow-inner py-4 mt-12 transition-colors duration-300">
        <div class="container mx-auto px-4 flex flex-col md:flex-row justify-between items-center text-gray-500 dark:text-gray-400 text-sm">
            <div class="mb-2 md:mb-0">&copy; {{ date('Y') }} Laravel CRUD. Ali rights reserved.</div>
            <div class="flex gap-4">
                <a href="{{ route('posts.index') }}" class="hover:text-blue-600 dark:hover:text-blue-400 transition">Posts</a>
            </div>
        </div>
    </footer>
    <script>
        // Dark mode toggle logics
        const body = document.getElementById('body');
        const toggle = document.getElementById('darkModeToggle');
        // Persist mode in localStorage
        if (localStorage.getItem('theme') === 'dark' || (localStorage.getItem('theme') === null && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
        toggle.addEventListener('click', function() {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('theme', 'light');
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            }
        });
    </script>
</body>
</html>