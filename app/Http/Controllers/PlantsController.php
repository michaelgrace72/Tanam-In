<?php

namespace App\Http\Controllers;

use App\Models\Plants;
use Illuminate\Http\Request;

class PlantsController extends Controller
{
    /**
     * Display a listing of the plants.
     */
    public function index()
    {
        $plants = Plants::getAllPlants();
        return response()->json($plants);
    }

    /**
     * Store a newly created plant in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'scientific_name' => 'nullable|string|max:255',
            'family' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image_url' => 'nullable|url',
            'planting_method' => 'required|in:tanah,pot,hidroponik',
            'carbon_absorption_rate' => 'nullable|numeric',
            'temp_reduction_rate' => 'nullable|numeric',
        ]);

        $plant = Plants::createPlant($validatedData);
        return response()->json($plant, 201);
    }

    /**
     * Display the specified plant.
     */
    public function show($id)
    {
        $plant = Plants::getPlantById($id);
        if (!$plant) {
            return response()->json(['message' => 'Plant not found'], 404);
        }
        return response()->json($plant);
    }

    /**
     * Update the specified plant in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'nullable|string|max:255',
            'scientific_name' => 'nullable|string|max:255',
            'family' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image_url' => 'nullable|url',
            'planting_method' => 'nullable|in:tanah,pot,hidroponik',
            'carbon_absorption_rate' => 'nullable|numeric',
            'temp_reduction_rate' => 'nullable|numeric',
        ]);

        $plant = Plants::updatePlant($id, $validatedData);
        if (!$plant) {
            return response()->json(['message' => 'Plant not found'], 404);
        }
        return response()->json($plant);
    }

    /**
     * Remove the specified plant from storage.
     */
    public function destroy($id)
    {
        $deleted = Plants::deletePlant($id);
        if (!$deleted) {
            return response()->json(['message' => 'Plant not found'], 404);
        }
        return response()->json(['message' => 'Plant deleted successfully']);
    }
}