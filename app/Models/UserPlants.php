<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPlants extends Model
{
    // Define the table name (optional if it matches the plural of the model name)
    protected $table = 'user_plants';

    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'user_id',
        'plant_id',
        'area_size',
        'location',
        'planting_date',
        'status',
    ];

    /**
     * Create a new user plant record.
     */
    public static function createUserPlant(array $data)
    {
        return self::create($data);
    }

    /**
     * Retrieve all user plant records.
     */
    public static function getAllUserPlants()
    {
        return self::all();
    }

    /**
     * Retrieve a single user plant record by ID.
     */
    public static function getUserPlantById($id)
    {
        return self::find($id);
    }

    /**
     * Update a user plant record by ID.
     */
    public static function updateUserPlant($id, array $data)
    {
        $userPlant = self::find($id);
        if ($userPlant) {
            $userPlant->update($data);
            return $userPlant;
        }
        return null;
    }

    /**
     * Delete a user plant record by ID.
     */
    public static function deleteUserPlant($id)
    {
        $userPlant = self::find($id);
        if ($userPlant) {
            $userPlant->delete();
            return true;
        }
        return false;
    }
}