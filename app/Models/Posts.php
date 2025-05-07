<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    // Define the table name (optional if it matches the plural of the model name)
    protected $table = 'posts';

    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'user_id',
        'content',
        'image_path',
    ];

    /**
     * Create a new post record.
     */
    public static function createPost(array $data)
    {
        return self::create($data);
    }

    /**
     * Retrieve all post records.
     */
    public static function getAllPosts()
    {
        return self::all();
    }

    /**
     * Retrieve a single post record by ID.
     */
    public static function getPostById($id)
    {
        return self::find($id);
    }

    /**
     * Update a post record by ID.
     */
    public static function updatePost($id, array $data)
    {
        $post = self::find($id);
        if ($post) {
            $post->update($data);
            return $post;
        }
        return null;
    }

    /**
     * Delete a post record by ID.
     */
    public static function deletePost($id)
    {
        $post = self::find($id);
        if ($post) {
            $post->delete();
            return true;
        }
        return false;
    }
}