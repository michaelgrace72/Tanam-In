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
    <x-navbar
        :links="[
            ['href' => route('dashboard'), 'label' => 'Dashboard'],
            ['href' => url('/plants'), 'label' => 'Plants'],
            ['href' => url('/posts'), 'label' => 'Posts'],
            ['href' => url('/reminders'), 'label' => 'Reminders'],
            ['href' => url('/guides'), 'label' => 'Guides'],
        ]"
        :showProfile="true"
        :user="Auth::user()"
    />

    @livewireScripts
</body>

</html>