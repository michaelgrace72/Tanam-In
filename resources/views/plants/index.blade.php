{{-- filepath: resources/views/plants/index.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tanam.in - Plants</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="//unpkg.com/alpinejs" defer></script>
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
        <h1 class="text-2xl font-bold mb-6">Plants</h1>

        <!-- Add Plant Button -->
        <button onclick="showModal('addPlantModal')" class="mb-6 bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Add Plant</button>

        <!-- Plant List -->
        <div id="plant-list" class="grid grid-cols-1 md:grid-cols-3 gap-6"></div>
    </div>

    <!-- Add Plant Modal -->
    <div id="addPlantModal" class="fixed inset-0 bg-black bg-opacity-40 items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative">
            <button class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-2xl"
                onclick="hideModal('addPlantModal')">&times;</button>
            <h2 class="text-xl font-bold mb-4">Add Plant</h2>
            <form id="addPlantForm">
                <input type="text" name="name" placeholder="Name" class="w-full border rounded p-2 mb-2" required>
                <input type="text" name="scientific_name" placeholder="Scientific Name" class="w-full border rounded p-2 mb-2">
                <input type="text" name="family" placeholder="Family" class="w-full border rounded p-2 mb-2">
                <textarea name="description" placeholder="Description" class="w-full border rounded p-2 mb-2"></textarea>
                <input type="url" name="image_url" placeholder="Image URL" class="w-full border rounded p-2 mb-2">
                <select name="planting_method" class="w-full border rounded p-2 mb-2" required>
                    <option value="">Planting Method</option>
                    <option value="tanah">Tanah</option>
                    <option value="pot">Pot</option>
                    <option value="hidroponik">Hidroponik</option>
                </select>
                <input type="number" step="0.01" name="carbon_absorption_rate" placeholder="Carbon Absorption Rate" class="w-full border rounded p-2 mb-2">
                <input type="number" step="0.01" name="temp_reduction_rate" placeholder="Temp Reduction Rate" class="w-full border rounded p-2 mb-4">
                <div class="flex justify-end">
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Add</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Plant Modal -->
    <div id="editPlantModal" class="fixed inset-0 bg-black bg-opacity-40 items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative">
            <button class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-2xl"
                onclick="hideModal('editPlantModal')">&times;</button>
            <h2 class="text-xl font-bold mb-4">Edit Plant</h2>
            <form id="editPlantForm">
                <input type="hidden" name="id" id="editPlantId">
                <input type="text" name="name" id="editPlantName" placeholder="Name" class="w-full border rounded p-2 mb-2" required>
                <input type="text" name="scientific_name" id="editPlantScientificName" placeholder="Scientific Name" class="w-full border rounded p-2 mb-2">
                <input type="text" name="family" id="editPlantFamily" placeholder="Family" class="w-full border rounded p-2 mb-2">
                <textarea name="description" id="editPlantDescription" placeholder="Description" class="w-full border rounded p-2 mb-2"></textarea>
                <input type="url" name="image_url" id="editPlantImageUrl" placeholder="Image URL" class="w-full border rounded p-2 mb-2">
                <select name="planting_method" id="editPlantPlantingMethod" class="w-full border rounded p-2 mb-2" required>
                    <option value="">Planting Method</option>
                    <option value="tanah">Tanah</option>
                    <option value="pot">Pot</option>
                    <option value="hidroponik">Hidroponik</option>
                </select>
                <input type="number" step="0.01" name="carbon_absorption_rate" id="editPlantCarbonAbsorptionRate" placeholder="Carbon Absorption Rate" class="w-full border rounded p-2 mb-2">
                <input type="number" step="0.01" name="temp_reduction_rate" id="editPlantTempReductionRate" placeholder="Temp Reduction Rate" class="w-full border rounded p-2 mb-4">
                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Update</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let plants = [];

        async function fetchPlants() {
            const res = await fetch('/api/plants');
            plants = await res.json();
            renderPlants();
        }

        function renderPlants() {
            const container = document.getElementById('plant-list');
            container.innerHTML = '';
            if (plants.length === 0) {
                container.innerHTML = `<div class="col-span-3 text-center text-gray-500">No plants found.</div>`;
                return;
            }
            plants.forEach(plant => {
                container.innerHTML += `
                    <div class="bg-white rounded-lg shadow-md p-4 flex flex-col items-center">
                        <img src="${plant.image_url || 'https://via.placeholder.com/150'}" alt="${plant.name}" class="w-32 h-32 object-cover rounded mb-2">
                        <h2 class="font-semibold text-lg">${plant.name}</h2>
                        <p class="text-gray-500 text-sm">${plant.scientific_name || ''}</p>
                        <p class="text-gray-500 text-sm">${plant.family || ''}</p>
                        <p class="text-gray-600 text-sm mb-2">${plant.description || ''}</p>
                        <div class="flex gap-2 mt-2">
                            <button onclick="openEditPlantModal(${plant.id})" class="bg-blue-500 text-white px-3 py-1 rounded">Edit</button>
                            <button onclick="deletePlant(${plant.id})" class="bg-red-500 text-white px-3 py-1 rounded">Delete</button>
                        </div>
                    </div>
                `;
            });
        }

        function showModal(id) {
            document.getElementById(id).classList.remove('hidden');
            document.getElementById(id).classList.add('flex');
        }
        function hideModal(id) {
            document.getElementById(id).classList.remove('flex');
            document.getElementById(id).classList.add('hidden');
        }

        // Add Plant
        document.getElementById('addPlantForm').onsubmit = async function(e) {
            e.preventDefault();
            const form = e.target;
            const data = Object.fromEntries(new FormData(form).entries());
            const res = await fetch('/api/plants', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                body: JSON.stringify(data)
            });
            if (res.ok) {
                hideModal('addPlantModal');
                form.reset();
                fetchPlants();
            } else {
                alert('Failed to add plant.');
            }
        };

        // Edit Plant
        function openEditPlantModal(id) {
            const plant = plants.find(p => p.id === id);
            if (!plant) return;
            document.getElementById('editPlantId').value = plant.id;
            document.getElementById('editPlantName').value = plant.name;
            document.getElementById('editPlantScientificName').value = plant.scientific_name || '';
            document.getElementById('editPlantFamily').value = plant.family || '';
            document.getElementById('editPlantDescription').value = plant.description || '';
            document.getElementById('editPlantImageUrl').value = plant.image_url || '';
            document.getElementById('editPlantPlantingMethod').value = plant.planting_method || '';
            document.getElementById('editPlantCarbonAbsorptionRate').value = plant.carbon_absorption_rate || '';
            document.getElementById('editPlantTempReductionRate').value = plant.temp_reduction_rate || '';
            showModal('editPlantModal');
        }

        document.getElementById('editPlantForm').onsubmit = async function(e) {
            e.preventDefault();
            const form = e.target;
            const id = document.getElementById('editPlantId').value;
            const data = Object.fromEntries(new FormData(form).entries());
            const res = await fetch(`/api/plants/${id}`, {
                method: 'PUT',
                headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                body: JSON.stringify(data)
            });
            if (res.ok) {
                hideModal('editPlantModal');
                fetchPlants();
            } else {
                alert('Failed to update plant.');
            }
        };

        // Delete Plant
        async function deletePlant(id) {
            if (!confirm('Delete this plant?')) return;
            const res = await fetch(`/api/plants/${id}`, {
                method: 'DELETE',
                headers: { 'Accept': 'application/json' }
            });
            if (res.ok) {
                fetchPlants();
            } else {
                alert('Failed to delete plant.');
            }
        }

        fetchPlants();
    </script>
</body>
</html>