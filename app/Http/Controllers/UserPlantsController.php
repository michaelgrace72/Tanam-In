<?php

namespace App\Http\Controllers;

use App\Models\UserPlants;
use Illuminate\Http\Request;

class UserPlantsController extends Controller
{
    /**
     * Display a listing of the user plants.
     */
    public function index()
    {
        $userPlants = UserPlants::getAllUserPlants();
        return response()->json($userPlants);
    }

    /**
     * Store a newly created user plant in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'plant_id' => 'required|integer|exists:plants,id',
            'area_size' => 'nullable|numeric',
            'location' => 'nullable|string|max:255',
            'planting_date' => 'nullable|date',
            'status' => 'required|in:ditanam,panen,mati',
        ]);

        $userPlant = UserPlants::createUserPlant($validatedData);
        return response()->json($userPlant, 201);
    }

    /**
     * Display the specified user plant.
     */
    public function show($id)
    {
        $userPlant = UserPlants::getUserPlantById($id);
        if (!$userPlant) {
            return response()->json(['message' => 'User plant not found'], 404);
        }
        return response()->json($userPlant);
    }

    /**
     * Update the specified user plant in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'user_id' => 'nullable|integer|exists:users,id',
            'plant_id' => 'nullable|integer|exists:plants,id',
            'area_size' => 'nullable|numeric',
            'location' => 'nullable|string|max:255',
            'planting_date' => 'nullable|date',
            'status' => 'nullable|in:ditanam,panen,mati',
        ]);

        $userPlant = UserPlants::updateUserPlant($id, $validatedData);
        if (!$userPlant) {
            return response()->json(['message' => 'User plant not found'], 404);
        }
        return response()->json($userPlant);
    }

    /**
     * Remove the specified user plant from storage.
     */
    public function destroy($id)
    {
        $deleted = UserPlants::deleteUserPlant($id);
        if (!$deleted) {
            return response()->json(['message' => 'User plant not found'], 404);
        }
        return response()->json(['message' => 'User plant deleted successfully']);
    }
}