<x-app-layout>
    <div class="container mx-auto py-8 px-4">
        <h1 class="text-2xl font-bold mb-6">My Plants</h1>
        <!-- Add Plant Button -->
        <button onclick="showModal('addPlantModal')" class="mb-8 bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Add Plant</button>
        <!-- Add Plant Modal -->
        <div id="addPlantModal" class="fixed inset-0 bg-black bg-opacity-40 items-center justify-center z-50 hidden">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-lg p-6 relative">
                <button class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-2xl" onclick="hideModal('addPlantModal')">&times;</button>
                <h2 class="text-lg font-semibold mb-4">Add a Plant You're Growing</h2>
                <form id="addPlantForm" action="{{ url('/user-plants') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="plant_id" class="block mb-1 font-medium">Plant</label>
                        <select name="plant_id" id="plant_id" class="w-full border rounded p-2" required>
                            <option value="">Select Plant</option>
                            @foreach($allPlants as $plant)
                                <option value="{{ $plant->id }}">{{ $plant->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="area_size" class="block mb-1 font-medium">Area Size (m²)</label>
                        <input type="number" step="0.01" name="area_size" id="area_size" class="w-full border rounded p-2">
                    </div>
                    <div class="mb-4">
                        <label for="location" class="block mb-1 font-medium">Location</label>
                        <input type="text" name="location" id="location" class="w-full border rounded p-2">
                    </div>
                    <div class="mb-4">
                        <label for="planting_date" class="block mb-1 font-medium">Planting Date</label>
                        <input type="date" name="planting_date" id="planting_date" class="w-full border rounded p-2">
                    </div>
                    <div class="mb-4">
                        <label for="status" class="block mb-1 font-medium">Status</label>
                        <select name="status" id="status" class="w-full border rounded p-2" required>
                            <option value="ditanam">Ditanam</option>
                            <option value="panen">Panen</option>
                            <option value="mati">Mati</option>
                        </select>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Add Plant</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- User's Plants List -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($userPlants as $userPlant)
                <div class="bg-white rounded-lg shadow-md p-4 flex flex-col items-center">
                    <img src="{{ $userPlant->plant->image_url ?? 'https://via.placeholder.com/150' }}" alt="{{ $userPlant->plant->name ?? 'Plant' }}" class="w-32 h-32 object-cover rounded mb-2">
                    <h2 class="font-semibold text-lg">{{ $userPlant->plant->name ?? '-' }}</h2>
                    <p class="text-gray-500 text-sm">{{ $userPlant->plant->scientific_name ?? '' }}</p>
                    <p class="text-gray-500 text-sm">{{ $userPlant->plant->family ?? '' }}</p>
                    <p class="text-gray-600 text-sm mb-2">{{ $userPlant->plant->description ?? '' }}</p>
                    <p class="text-gray-600 text-sm mb-2">Area: {{ $userPlant->area_size ?? '-' }} m²</p>
                    <p class="text-gray-600 text-sm mb-2">Location: {{ $userPlant->location ?? '-' }}</p>
                    <p class="text-gray-600 text-sm mb-2">Planted: {{ $userPlant->planting_date ?? '-' }}</p>
                    <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold {{ $userPlant->status == 'ditanam' ? 'bg-green-200 text-green-800' : ($userPlant->status == 'panen' ? 'bg-yellow-200 text-yellow-800' : 'bg-red-200 text-red-800') }}">
                        {{ ucfirst($userPlant->status) }}
                    </span>
                </div>
            @empty
                <div class="col-span-3 text-center text-gray-500">You haven't added any plants yet.</div>
            @endforelse
        </div>
    </div>
    <script>
        function showModal(id) {
            document.getElementById(id).classList.remove('hidden');
            document.getElementById(id).classList.add('flex');
        }
        function hideModal(id) {
            document.getElementById(id).classList.remove('flex');
            document.getElementById(id).classList.add('hidden');
        }
    </script>
</x-app-layout>
