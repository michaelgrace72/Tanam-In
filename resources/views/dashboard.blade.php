<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tanam.in</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="min-h-screen bg-gradient-to-b from-[#81e7af] to-white font-sans antialiased">

    <!-- Navbar for authenticated user -->
    <nav class="bg-white shadow mb-8">
        <div class="container mx-auto px-4 py-3 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <a href="/dashboard" class="text-xl font-bold text-green-600 hover:text-green-800">Tanam.in</a>
                <a href="/user-plants" class="text-gray-700 hover:text-green-600 px-3 py-2 rounded transition">Plants</a>
                <a href="/posts" class="text-gray-700 hover:text-green-600 px-3 py-2 rounded transition">Posts</a>
                <a href="/reminders" class="text-gray-700 hover:text-green-600 px-3 py-2 rounded transition">Reminders</a>
                <a href="/guides" class="text-gray-700 hover:text-green-600 px-3 py-2 rounded transition">Guides</a>
            </div>
            <div class="flex items-center gap-4">
                <span class="text-gray-600 font-medium">{{ Auth::user()->name }}</span>
                <img src="{{ Auth::user()->profile_photo_url }}" alt="Profile" class="w-8 h-8 rounded-full border">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="ml-2 text-red-500 hover:text-red-700 font-semibold">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    hi
    @livewireScripts
</body>

</html>