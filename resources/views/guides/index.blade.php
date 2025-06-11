<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Plant Guides - Tanam.in</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gradient-to-b from-[#81e7af] to-white font-sans antialiased">
    <x-navbar :links="[
        ['href' => route('dashboard'), 'label' => 'Dashboard'],
        ['href' => url('/plants'), 'label' => 'Plants'],
        ['href' => url('/posts'), 'label' => 'Posts'],
        ['href' => url('/reminders'), 'label' => 'Reminders'],
        ['href' => url('/guides'), 'label' => 'Guides'],
    ]" :showProfile="true" :user="Auth::user()" />

    <div class="container mx-auto py-8 px-4">
        <h1 class="text-2xl font-bold mb-6">Plant Guides</h1>

        <!-- List Tanaman -->
        <div id="plant-list" class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8"></div>

        <!-- Detail Guide -->
        <div id="guideDetail" class="hidden bg-white rounded-lg shadow-md p-6 mt-6">
            <button onclick="hideGuide()"
                class="float-right text-gray-400 hover:text-gray-700 text-2xl">&times;</button>
            <div id="guideContent"></div>
        </div>
        <div id="all-guides"></div>
    </div>

    <script>
        let plants = [];
        let guides = [];

        function renderAllGuides() {
            const container = document.getElementById('all-guides');
            container.innerHTML = '';
            plants.forEach(plant => {
                const plantGuides = guides.filter(g => g.plant_id === plant.id).sort((a, b) => a.step_order - b.step_order);
                container.innerHTML += `
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <h2 class="text-xl font-bold mb-2">${plant.name}</h2>
                    <ol class="list-decimal list-inside space-y-1">
                        ${plantGuides.length > 0 ? plantGuides.map(step => `<li>${step.instruction}</li>`).join('') : '<li>Belum ada panduan menanam.</li>'}
                    </ol>
                </div>
            `;
            });
        }

        // Fetch plants and guides from backend
        async function fetchData() {
            const plantsRes = await fetch('/api/plants');
            plants = await plantsRes.json();
            const guidesRes = await fetch('/api/guides');
            guides = await guidesRes.json();
            renderPlants();
        }

        function renderPlants() {
            const container = document.getElementById('plant-list');
            container.innerHTML = '';
            if (plants.length === 0) {
                container.innerHTML = `<div class="col-span-3 text-center text-gray-500">Belum ada data tanaman.</div>`;
                return;
            }
            plants.forEach(plant => {
                container.innerHTML += `
                    <div class="bg-white rounded-lg shadow-md p-4 flex flex-col items-center cursor-pointer hover:scale-105 transition"
                        onclick="showGuide(${plant.id})">
                        <img src="${plant.image_url || 'https://via.placeholder.com/150'}" alt="${plant.name}" class="w-32 h-32 object-cover rounded mb-2">
                        <h2 class="font-semibold text-lg">${plant.name}</h2>
                        <p class="text-gray-500 text-sm">${plant.scientific_name || ''}</p>
                        <p class="text-gray-600 text-sm mb-2">${plant.family || ''}</p>
                    </div>
                `;
            });
        }

        function showGuide(plantId) {
            const plant = plants.find(p => p.id === plantId);
            const plantGuides = guides.filter(g => g.plant_id === plantId).sort((a, b) => a.step_order - b.step_order);
            let html = `
                <div class="flex flex-col md:flex-row gap-6">
                    <img src="${plant.image_url || 'https://via.placeholder.com/150'}" alt="${plant.name}" class="w-40 h-40 object-cover rounded mb-4">
                    <div>
                        <h2 class="text-2xl font-bold mb-2">${plant.name}</h2>
                        <p class="text-gray-600 mb-1"><span class="font-semibold">Scientific Name:</span> ${plant.scientific_name || '-'}</p>
                        <p class="text-gray-600 mb-1"><span class="font-semibold">Family:</span> ${plant.family || '-'}</p>
                        <p class="mb-4">${plant.description || ''}</p>
                        <h3 class="font-semibold mb-2">How to Plant:</h3>
                        <ol class="list-decimal list-inside space-y-1">
                            ${plantGuides.length > 0 ? plantGuides.map(step => `<li>${step.instruction}</li>`).join('') : '<li>Belum ada panduan menanam.</li>'}
                        </ol>
                    </div>
                </div>
            `;
            document.getElementById('guideContent').innerHTML = html;
            document.getElementById('guideDetail').classList.remove('hidden');
        }

        function hideGuide() {
            document.getElementById('guideDetail').classList.add('hidden');
        }

        fetchData();
    </script>
</body>

</html>