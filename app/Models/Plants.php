<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plants extends Model
{
    // Define the table name (optional if it matches the plural of the model name)
    protected $table = 'plants';

    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'name',
        'scientific_name',
        'family',
        'description',
        'image_url',
        'planting_method',
        'carbon_absorption_rate',
        'temp_reduction_rate',
    ];

    /**
     * Create a new plant record.
     */
    public static function createPlant(array $data)
    {
        return self::create($data);
    }

    /**
     * Retrieve all plant records.
     */
    public static function getAllPlants()
    {
        return self::all();
    }

    /**
     * Retrieve a single plant record by ID.
     */
    public static function getPlantById($id)
    {
        return self::find($id);
    }

    /**
     * Update a plant record by ID.
     */
    public static function updatePlant($id, array $data)
    {
        $plant = self::find($id);
        if ($plant) {
            $plant->update($data);
            return $plant;
        }
        return null;
    }

    /**
     * Delete a plant record by ID.
     */
    public static function deletePlant($id)
    {
        $plant = self::find($id);
        if ($plant) {
            $plant->delete();
            return true;
        }
        return false;
    }
}