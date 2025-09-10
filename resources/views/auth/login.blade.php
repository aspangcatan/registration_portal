<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | {{ config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

<div class="w-full max-w-md bg-white rounded-3xl shadow-2xl p-10">
    <!-- Logo / App Name -->
    <div class="text-center mb-8">
        <h1 class="text-3xl font-extrabold text-gray-800 tracking-wide">CSMC PORTAL</h1>
        <p class="text-gray-500 text-sm mt-2">Welcome back! Log in to access your dashboard.</p>
    </div>

    <!-- Session Status -->
    @if (session('success'))
        <div class="mb-4 bg-green-600 text-white p-4 rounded-lg shadow">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-4 bg-red-600 text-white p-4 rounded-lg shadow">
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
@endif


<!-- Login Form -->
    <form method="POST" action="{{ route('login') }}" class="space-y-6">
    @csrf

    <!-- Username -->
        <div>
            <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
            <input type="text" name="username" id="username" value="{{ old('username') }}" required autofocus
                   class="mt-2 block w-full rounded-xl border border-gray-300 shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 px-4 py-3">
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" name="password" id="password" required
                   class="mt-2 block w-full rounded-xl border border-gray-300 shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 px-4 py-3">
        </div>

        <!-- Submit Button -->
        <button type="submit"
                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-xl shadow-md transition-all duration-150">
            Log In
        </button>
    </form>


</div>

</body>
</html>
