<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans antialiased">
<!-- Navbar -->
<nav class="bg-white shadow-md">
    <div class="container mx-auto px-4 py-3 flex justify-between items-center">
        <a href="{{ url('/') }}" class="text-lg font-bold text-gray-800">
            CSMC PORTAL
        </a>

        <!-- Right Side -->
        <div class="flex items-center space-x-4">
            @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-md">
                        Logout
                    </button>
                </form>
            @endauth
        </div>
    </div>
</nav>

<!-- Main Content -->
<main class="container mx-auto px-4 py-6">
    @yield('content')
</main>
</body>
</html>
