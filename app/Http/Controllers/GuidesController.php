<?php

namespace App\Http\Controllers;

use App\Models\Guides;
use Illuminate\Http\Request;

class GuidesController extends Controller
{
    /**
     * Display a listing of the guides.
     */
    public function index(\Illuminate\Http\Request $request)
    {
        // Selalu return JSON jika akses ke /api/*
        if ($request->is('api/*')) {
            return response()->json(Guides::all());
        }
        // Untuk akses browser, return Blade view
        return view('guides.index');
    }

    /**
     * Store a newly created guide in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'plant_id' => 'required|integer|exists:plants,id',
            'step_order' => 'required|integer',
            'instruction' => 'required|string',
        ]);

        $guide = Guides::createGuide($validatedData);
        return response()->json($guide, 201);
    }

    /**
     * Display the specified guide.
     */
    public function show($id)
    {
        $guide = Guides::getGuideById($id);
        if (!$guide) {
            return response()->json(['message' => 'Guide not found'], 404);
        }
        return response()->json($guide);
    }

    /**
     * Update the specified guide in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'step_order' => 'nullable|integer',
            'instruction' => 'nullable|string',
        ]);

        $guide = Guides::updateGuide($id, $validatedData);
        if (!$guide) {
            return response()->json(['message' => 'Guide not found'], 404);
        }
        return response()->json($guide);
    }

    /**
     * Remove the specified guide from storage.
     */
    public function destroy($id)
    {
        $deleted = Guides::deleteGuide($id);
        if (!$deleted) {
            return response()->json(['message' => 'Guide not found'], 404);
        }
        return response()->json(['message' => 'Guide deleted successfully']);
    }
}