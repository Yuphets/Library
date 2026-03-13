<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mater Dei College Library</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Tailwind via Vite (if using Laravel Breeze with Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .bg-mdc-blue { background-color: #003A6B; }
        .text-mdc-blue { color: #003A6B; }
        .border-mdc-blue { border-color: #003A6B; }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen">
        <!-- Navigation -->
        <nav class="bg-mdc-blue text-white shadow-lg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <h1 class="text-xl font-bold">Mater Dei College Library</h1>
                    </div>
                    <div class="flex items-center space-x-4">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="hover:underline">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="hover:underline">Log in</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="hover:underline">Register</a>
                                @endif
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <header class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-4xl font-extrabold text-mdc-blue sm:text-5xl">
                    Welcome to the Library
                </h2>
                <p class="mt-4 text-xl text-gray-600">
                    Discover, borrow, and explore thousands of books.
                </p>
                <div class="mt-8">
                    <a href="{{ route('register') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-mdc-blue hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Get Started
                    </a>
                </div>
            </div>
        </header>

        <!-- Features / Book Highlights -->
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-mdc-blue">Extensive Collection</h3>
                    <p class="mt-2 text-gray-600">Access thousands of books across all genres.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-mdc-blue">Easy Borrowing</h3>
                    <p class="mt-2 text-gray-600">Simple online borrowing and return system.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-mdc-blue">24/7 Access</h3>
                    <p class="mt-2 text-gray-600">Manage your loans anytime, anywhere.</p>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-mdc-blue text-white py-6 mt-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <p>&copy; {{ date('Y') }} Mater Dei College Library. All rights reserved.</p>
            </div>
        </footer>
    </div>
</body>
</html>