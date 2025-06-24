<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reminders extends Model
{
    // Define the table name (optional if it matches the plural of the model name)
    protected $table = 'reminders';

    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'user_plant_id',
        'type',
        'remind_at',
        'is_done',
    ];

    /**
     * Create a new reminder record.
     */
    public static function createReminder(array $data)
    {
        return self::create($data);
    }

    /**
     * Retrieve all reminder records.
     */
    public static function getAllReminders()
    {
        return self::all();
    }

    /**
     * Retrieve a single reminder record by ID.
     */
    public static function getReminderById($id)
    {
        return self::find($id);
    }

    /**
     * Update a reminder record by ID.
     */
    public static function updateReminder($id, array $data)
    {
        $reminder = self::find($id);
        if ($reminder) {
            $reminder->update($data);
            return $reminder;
        }
        return null;
    }

    /**
     * Delete a reminder record by ID.
     */
    public static function deleteReminder($id)
    {
        $reminder = self::find($id);
        if ($reminder) {
            $reminder->delete();
            return true;
        }
        return false;
    }
    public function userPlant()
    {
        return $this->belongsTo(\App\Models\UserPlants::class, 'user_plant_id');
    }
}