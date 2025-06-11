<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reminders - Tanam.in</title>
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
        <h1 class="text-2xl font-bold mb-6">Reminders</h1>
        <button onclick="showModal('addReminderModal')"
            class="mb-6 bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Add Reminder</button>
        <div id="reminder-list" class="grid grid-cols-1 md:grid-cols-2 gap-6"></div>
    </div>

    <!-- Add Reminder Modal -->
    <div id="addReminderModal" class="fixed inset-0 bg-black bg-opacity-40 items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative">
            <button class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-2xl"
                onclick="hideModal('addReminderModal')">&times;</button>
            <h2 class="text-xl font-bold mb-4">Add Reminder</h2>
            <form id="addReminderForm">
                <select name="user_plant_id" class="w-full border rounded p-2 mb-2" required>
                    <option value="">Select Your Plant</option>
                </select>
                <select name="type" class="w-full border rounded p-2 mb-2" required>
                    <option value="">Type</option>
                    <option value="penyiraman">Penyiraman</option>
                    <option value="pemupukan">Pemupukan</option>
                    <option value="panen">Panen</option>
                </select>
                <input type="date" name="remind_at" class="w-full border rounded p-2 mb-2" required>
                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Add</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Reminder Modal -->
    <div id="editReminderModal" class="fixed inset-0 bg-black bg-opacity-40 items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative">
            <button class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-2xl"
                onclick="hideModal('editReminderModal')">&times;</button>
            <h2 class="text-xl font-bold mb-4">Edit Reminder</h2>
            <form id="editReminderForm">
                <input type="hidden" name="id" id="editReminderId">
                <select name="user_plant_id" id="editReminderUserPlantId" class="w-full border rounded p-2 mb-2"
                    required>
                    <option value="">Select Your Plant</option>
                </select>
                <select name="type" id="editReminderType" class="w-full border rounded p-2 mb-2" required>
                    <option value="">Type</option>
                    <option value="penyiraman">Penyiraman</option>
                    <option value="pemupukan">Pemupukan</option>
                    <option value="panen">Panen</option>
                </select>
                <input type="date" name="remind_at" id="editReminderRemindAt" class="w-full border rounded p-2 mb-2"
                    required>
                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Update</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let reminders = [];
        let userPlants = [];

        async function fetchPlants() {
            const res = await fetch('/api/plants');
            plants = await res.json();
        }

        async function fetchReminders() {
            const res = await fetch('/api/reminders');
            reminders = await res.json();
            renderReminders();
        }

        function renderReminders() {
            const container = document.getElementById('reminder-list');
            container.innerHTML = '';
            if (reminders.length === 0) {
                container.innerHTML = `<div class="col-span-2 text-center text-gray-500">No reminders found.</div>`;
                return;
            }
            reminders.forEach(reminder => {
                // Find the plant by plant_id (adjust if your reminder has user_plant_id -> plant_id)
                let plantName = '-';
                if (reminder.plant_id) {
                    const plant = plants.find(p => p.id == reminder.plant_id);
                    plantName = plant ? plant.name : '-';
                } else if (reminder.user_plant_id) {
                    // If reminder only has user_plant_id, you need to fetch userPlants with plant relation
                    // Or adjust your backend to include plant_id in reminders
                    plantName = `User Plant #${reminder.user_plant_id}`;
                }
                container.innerHTML += `
            <div class="bg-white rounded-lg shadow-md p-4 flex flex-col">
                <div class="mb-2">
                    <span class="font-semibold">Plant:</span> ${plantName}
                </div>
                <div class="mb-2">
                    <span class="font-semibold">Type:</span> ${reminder.type}
                </div>
                <div class="mb-2">
                    <span class="font-semibold">Remind At:</span> ${reminder.remind_at}
                </div>
                <div class="mb-2">
                    <span class="font-semibold">Status:</span> ${reminder.is_done ? 'Done' : 'Pending'}
                </div>
                <div class="flex gap-2 mt-2">
                    <button onclick="openEditReminderModal(${reminder.id})" class="bg-blue-500 text-white px-3 py-1 rounded">Edit</button>
                    <button onclick="deleteReminder(${reminder.id})" class="bg-red-500 text-white px-3 py-1 rounded">Delete</button>
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

        // Populate plant select options
        function populatePlantSelects() {
            const addSelect = document.querySelector('#addReminderForm select[name="user_plant_id"]');
            const editSelect = document.getElementById('editReminderUserPlantId');
            addSelect.innerHTML = '<option value="">Select Your Plant</option>';
            editSelect.innerHTML = '<option value="">Select Your Plant</option>';
            userPlants.forEach(up => {
                const plantName = up.plant ? up.plant.name : 'Plant #' + up.id;
                addSelect.innerHTML += `<option value="${up.id}">${plantName}</option>`;
                editSelect.innerHTML += `<option value="${up.id}">${plantName}</option>`;
            });
        }

        // Add Reminder
        document.getElementById('addReminderForm').onsubmit = async function (e) {
            e.preventDefault();
            const form = e.target;
            const data = Object.fromEntries(new FormData(form).entries());
            data.is_done = false;
            const res = await fetch('/api/reminders', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                body: JSON.stringify(data)
            });
            if (res.ok) {
                hideModal('addReminderModal');
                form.reset();
                fetchReminders();
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
                headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
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
                headers: { 'Accept': 'application/json' }
            });
            if (res.ok) {
                fetchReminders();
            } else {
                alert('Failed to delete reminder.');
            }
        }

        // Initial load
        (async function () {
            await fetchPlants();
            await fetchReminders();
        })();
    </script>
</body>

</html>