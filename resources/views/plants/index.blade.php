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
    @php
        $userPlants = [
            (object) [
                'id' => 1,
                'location' => 'Backyard',
                'plant' => (object) [
                    'name' => 'Tomato',
                    'image_url' => 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=200&q=80'
                ]
            ],
            (object) [
                'id' => 2,
                'location' => 'Balcony',
                'plant' => (object) [
                    'name' => 'Basil',
                    'image_url' => 'https://images.unsplash.com/photo-1465101046530-73398c7f28ca?auto=format&fit=crop&w=200&q=80'
                ]
            ],
            (object) [
                'id' => 3,
                'location' => 'Frontyard',
                'plant' => (object) [
                    'name' => 'Chili',
                    'image_url' => 'https://images.unsplash.com/photo-1501004318641-b39e6451bec6?auto=format&fit=crop&w=200&q=80'
                ]
            ],
        ];

        $allPlants = [
            (object) ['id' => 1, 'name' => 'Tomato'],
            (object) ['id' => 2, 'name' => 'Basil'],
            (object) ['id' => 3, 'name' => 'Chili'],
            (object) ['id' => 4, 'name' => 'Rosemary'],
            (object) ['id' => 5, 'name' => 'Mint'],
        ];
    @endphp
    <!-- Navbar for authenticated user -->
    <x-navbar :links="[
        ['href' => route('dashboard'), 'label' => 'Dashboard'],
        ['href' => url('/plants'), 'label' => 'Plants'],
        ['href' => url('/posts'), 'label' => 'Posts'],
        ['href' => url('/reminders'), 'label' => 'Reminders'],
        ['href' => url('/guides'), 'label' => 'Guides'],
    ]" :showProfile="true" :user="Auth::user()" />

    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-4">My Plants</h1>

        <!-- Add Plant Form -->
        <form action="{{ url('/user-plants') }}" method="POST" class="mb-6 bg-white p-4 rounded shadow">
            @csrf
            <div class="flex gap-4 flex-wrap">
                <select name="plant_id" required class="border rounded p-2">
                    <option value="">Select Plant</option>
                    @foreach($allPlants as $plant)
                        <option value="{{ $plant->id }}">{{ $plant->name }}</option>
                    @endforeach
                </select>
                <input type="number" name="area_size" placeholder="Area Size (m²)" class="border rounded p-2" />
                <input type="text" name="location" placeholder="Location" class="border rounded p-2" />
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Add Plant</button>
            </div>
        </form>

        <!-- User's Plants List -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($userPlants as $userPlant)
                <div class="bg-white p-4 rounded shadow flex flex-col items-center">
                    <img src="{{ $userPlant->plant->image_url }}" alt="{{ $userPlant->plant->name }}"
                        class="w-32 h-32 object-cover mb-2 rounded">
                    <h2 class="font-semibold text-lg">{{ $userPlant->plant->name }}</h2>
                    <p class="text-gray-600">{{ $userPlant->location }}</p>
                    <form action="{{ url('/user-plants/' . $userPlant->id) }}" method="POST" class="mt-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded">Delete</button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>

    @livewireScripts
</body>

</html>