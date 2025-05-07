<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Display a listing of the posts.
     */
    public function index()
    {
        $posts = Posts::getAllPosts();
        return response()->json($posts);
    }

    /**
     * Store a newly created post in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'content' => 'required|string',
            'image_path' => 'nullable|string|max:255',
        ]);

        $post = Posts::createPost($validatedData);
        return response()->json($post, 201);
    }

    /**
     * Display the specified post.
     */
    public function show($id)
    {
        $post = Posts::getPostById($id);
        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }
        return response()->json($post);
    }

    /**
     * Update the specified post in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'content' => 'nullable|string',
            'image_path' => 'nullable|string|max:255',
        ]);

        $post = Posts::updatePost($id, $validatedData);
        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }
        return response()->json($post);
    }

    /**
     * Remove the specified post from storage.
     */
    public function destroy($id)
    {
        $deleted = Posts::deletePost($id);
        if (!$deleted) {
            return response()->json(['message' => 'Post not found'], 404);
        }
        return response()->json(['message' => 'Post deleted successfully']);
    }
}