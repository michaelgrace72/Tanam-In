<x-app-layout>
    <div class="container mx-auto py-8 px-4">
        <h1 class="text-2xl font-bold mb-6">Reminders</h1>
        <button onclick="showModal('addReminderModal')"
            class="mb-6 bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Add Reminder</button>
        <div id="reminder-list" class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @forelse($reminders as $reminder)
                <div class="bg-white rounded-lg shadow-md p-4 flex flex-col">
                    <div class="flex justify-between items-center mb-2">
                        <span class="font-semibold">{{ ucfirst($reminder->type) }}</span>
                        <div class="flex gap-2">
                            <!-- Add edit/delete buttons here if needed -->
                        </div>
                    </div>
                    <div class="text-gray-600 text-sm mb-1">
                        Plant: {{ $reminder->userPlant->plant->name ?? '-' }} ({{ $reminder->userPlant->location ?? 'Unknown location' }})
                    </div>
                    <div class="text-gray-600 text-sm mb-1">Remind At: {{ $reminder->remind_at }}</div>
                    <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold {{ $reminder->is_done ? 'bg-green-200 text-green-800' : 'bg-yellow-200 text-yellow-800' }}">
                        {{ $reminder->is_done ? 'Done' : 'Pending' }}
                    </span>
                </div>
            @empty
                <div class="col-span-2 text-center text-gray-500">No reminders yet.</div>
            @endforelse
        </div>
    </div>

    <!-- Add Reminder Modal -->
    <div id="addReminderModal"
        class="fixed inset-0 bg-black bg-opacity-40 items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative">
            <button class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-2xl"
                onclick="hideModal('addReminderModal')">&times;</button>
            <h2 class="text-xl font-bold mb-4">Add Reminder</h2>
            <form id="addReminderForm" action="{{ url('/reminders') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="user_plant_id" class="block mb-1 font-medium">Your Plant</label>
                    <select name="user_plant_id" id="user_plant_id" class="w-full border rounded p-2" required>
                        <option value="">Select Your Plant</option>
                        @isset($userPlants)
                            @foreach($userPlants as $userPlant)
                                <option value="{{ $userPlant->id }}">
                                    {{ $userPlant->plant->name ?? '-' }}
                                    @if($userPlant->location)
                                        ({{ $userPlant->location }})
                                    @endif
                                </option>
                            @endforeach
                        @endisset
                    </select>
                </div>
                <div class="mb-4">
                    <label for="type" class="block mb-1 font-medium">Type</label>
                    <select name="type" id="type" class="w-full border rounded p-2" required>
                        <option value="">Type</option>
                        <option value="penyiraman">Penyiraman</option>
                        <option value="pemupukan">Pemupukan</option>
                        <option value="panen">Panen</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="remind_at" class="block mb-1 font-medium">Remind At</label>
                    <input type="date" name="remind_at" id="remind_at" class="w-full border rounded p-2" required>
                </div>
                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Add</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Reminder Modal -->
    <div id="editReminderModal"
        class="fixed inset-0 bg-black bg-opacity-40 items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative">
            <button class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-2xl"
                onclick="hideModal('editReminderModal')">&times;</button>
            <h2 class="text-xl font-bold mb-4">Edit Reminder</h2>
            <form id="editReminderForm">
                <input type="hidden" name="id" id="editReminderId">
                @isset($userPlants)
                <select name="user_plant_id" id="editReminderUserPlantId" class="w-full border rounded p-2 mb-2" required>
                    <option value="">Select Your Plant</option>
                    @foreach($userPlants as $userPlant)
                        <option value="{{ $userPlant->id }}">{{ $userPlant->plant->name ?? '-' }} ({{ $userPlant->location ?? 'Unknown location' }})</option>
                    @endforeach
                </select>
                @endisset
                <select name="type" id="editReminderType" class="w-full border rounded p-2 mb-2" required>
                    <option value="">Type</option>
                    <option value="penyiraman">Penyiraman</option>
                    <option value="pemupukan">Pemupukan</option>
                    <option value="panen">Panen</option>
                </select>
                <input type="date" name="remind_at" id="editReminderRemindAt" class="w-full border rounded p-2 mb-2" required>
                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Save</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let reminders = [];
        let userPlants = [];

        async function fetchReminders() {
            const res = await fetch('/api/reminders');
            reminders = await res.json();
            renderReminders();
        }

        function renderReminders() {
            const container = document.getElementById('reminder-list');
            container.innerHTML = '';
            if (reminders.length === 0) {
                container.innerHTML = '<div class="col-span-2 text-center text-gray-500">No reminders yet.</div>';
                return;
            }
            reminders.forEach(reminder => {
                container.innerHTML += `
                    <div class="bg-white rounded-lg shadow-md p-4 flex flex-col">
                        <div class="flex justify-between items-center mb-2">
                            <span class="font-semibold">${reminder.type.charAt(0).toUpperCase() + reminder.type.slice(1)}</span>
                            <div class="flex gap-2">
                                <button onclick="openEditReminderModal(${reminder.id})" class="text-blue-500 hover:underline">Edit</button>
                                <button onclick="deleteReminder(${reminder.id})" class="text-red-500 hover:underline">Delete</button>
                            </div>
                        </div>
                        <div class="text-gray-600 text-sm mb-1">Plant: ${reminder.user_plant_name || '-'}</div>
                        <div class="text-gray-600 text-sm mb-1">Remind At: ${reminder.remind_at}</div>
                        <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold ${reminder.is_done ? 'bg-green-200 text-green-800' : 'bg-yellow-200 text-yellow-800'}">
                            ${reminder.is_done ? 'Done' : 'Pending'}
                        </span>
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

        // Populate plant select options
        function populatePlantSelects() {
            const addSelect = document.querySelector('#addReminderForm select[name="user_plant_id"]');
            const editSelect = document.getElementById('editReminderUserPlantId');
            addSelect.innerHTML = '<option value="">Select Your Plant</option>';
            editSelect.innerHTML = '<option value="">Select Your Plant</option>';
            userPlants.forEach(up => {
                addSelect.innerHTML += `<option value="${up.id}">${up.plant_name || up.name}</option>`;
                editSelect.innerHTML += `<option value="${up.id}">${up.plant_name || up.name}</option>`;
            });
        }

        // Fetch user's plants for select options
        async function fetchUserPlants() {
            const res = await fetch('/api/user-plants');
            userPlants = await res.json();
            populatePlantSelects();
        }

        // Add Reminder
        document.getElementById('addReminderForm').onsubmit = async function (e) {
            e.preventDefault();
            const form = e.target;
            const data = Object.fromEntries(new FormData(form).entries());
            data.is_done = false;
            const res = await fetch('/api/reminders', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
                body: JSON.stringify(data)
            });
            if (res.ok) {
                hideModal('addReminderModal');
                fetchReminders();
                form.reset();
            } else {
                alert('Failed to add reminder.');
            }
        };

        // Edit Reminder
        function openEditReminderModal(id) {
            const reminder = reminders.find(r => r.id == id);
            if (!reminder) return;
            document.getElementById('editReminderId').value = reminder.id;
            document.getElementById('editReminderUserPlantId').value = reminder.user_plant_id;
            document.getElementById('editReminderType').value = reminder.type;
            document.getElementById('editReminderRemindAt').value = reminder.remind_at;
            showModal('editReminderModal');
        }

        document.getElementById('editReminderForm').onsubmit = async function (e) {
            e.preventDefault();
            const form = e.target;
            const id = document.getElementById('editReminderId').value;
            const data = Object.fromEntries(new FormData(form).entries());
            const res = await fetch(`/api/reminders/${id}`, {
                method: 'PUT',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
                body: JSON.stringify(data)
            });
            if (res.ok) {
                hideModal('editReminderModal');
                fetchReminders();
            } else {
                alert('Failed to update reminder.');
            }
        };

        // Delete Reminder
        async function deleteReminder(id) {
            if (!confirm('Delete this reminder?')) return;
            const res = await fetch(`/api/reminders/${id}`, {
                method: 'DELETE',
                headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content }
            });
            if (res.ok) {
                fetchReminders();
            } else {
                alert('Failed to delete reminder.');
            }
        }

        // Initial load
        (async function () {
            await fetchUserPlants();
            await fetchReminders();
        })();
    </script>
</x-app-layout>