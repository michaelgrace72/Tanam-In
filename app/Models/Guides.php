<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guides extends Model
{
    // Define the table name (optional if it matches the plural of the model name)
    protected $table = 'guides';

    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'plant_id',
        'step_order',
        'instruction',
    ];

    /**
     * Create a new guide record.
     */
    public static function createGuide(array $data)
    {
        return self::create($data);
    }

    /**
     * Retrieve all guide records.
     */
    public static function getAllGuides()
    {
        return self::all();
    }

    /**
     * Retrieve a single guide record by ID.
     */
    public static function getGuideById($id)
    {
        return self::find($id);
    }

    /**
     * Update a guide record by ID.
     */
    public static function updateGuide($id, array $data)
    {
        $guide = self::find($id);
        if ($guide) {
            $guide->update($data);
            return $guide;
        }
        return null;
    }

    /**
     * Delete a guide record by ID.
     */
    public static function deleteGuide($id)
    {
        $guide = self::find($id);
        if ($guide) {
            $guide->delete();
            return true;
        }
        return false;
    }
}