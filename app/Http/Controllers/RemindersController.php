<?php

namespace App\Http\Controllers;

use App\Models\Reminders;
use Illuminate\Http\Request;
use App\Models\UserPlants;

class RemindersController extends Controller
{
    /**
     * Display a listing of the reminders.
     */
    public function index(Request $request)
    {
        // Jika request ke API, selalu return JSON
        if ($request->is('api/*')) {
            return response()->json(Reminders::all());
        }
        // Untuk web, ambil reminders dan userPlants untuk user yang sedang login
        $user = auth()->user();
        $userPlants = \App\Models\UserPlants::with('plant')->where('user_id', $user->id)->get();
        $reminders = \App\Models\Reminders::with(['userPlant.plant'])
            ->whereHas('userPlant', function($q) use ($user) {
                $q->where('user_id', $user->id);
            })
            ->orderBy('remind_at', 'asc')
            ->get();
        return view('reminders.index', compact('reminders', 'userPlants'));
    }

    /**
     * Store a newly created reminder in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_plant_id' => 'required|integer|exists:user_plants,id',
            'type' => 'required|in:penyiraman,pemupukan,panen',
            'remind_at' => 'required|date',
            'is_done' => 'nullable|boolean',
        ]);

        $reminder = Reminders::createReminder($validatedData);
        return response()->json($reminder, 201);
    }

    /**
     * Display the specified reminder.
     */
    public function show($id)
    {
        $reminder = Reminders::getReminderById($id);
        if (!$reminder) {
            return response()->json(['message' => 'Reminder not found'], 404);
        }
        return response()->json($reminder);
    }

    /**
     * Update the specified reminder in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'type' => 'nullable|in:penyiraman,pemupukan,panen',
            'remind_at' => 'nullable|date',
            'is_done' => 'nullable|boolean',
        ]);

        $reminder = Reminders::updateReminder($id, $validatedData);
        if (!$reminder) {
            return response()->json(['message' => 'Reminder not found'], 404);
        }
        return response()->json($reminder);
    }

    /**
     * Remove the specified reminder from storage.
     */
    public function destroy($id)
    {
        $deleted = Reminders::deleteReminder($id);
        if (!$deleted) {
            return response()->json(['message' => 'Reminder not found'], 404);
        }
        return response()->json(['message' => 'Reminder deleted successfully']);
    }
}