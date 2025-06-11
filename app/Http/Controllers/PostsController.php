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
        // return response()->json($posts);
        return view('posts.index', compact('posts'));
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

        // Jika request dari API, return JSON
        if ($request->is('api/*') || $request->wantsJson()) {
            return response()->json($post, 201);
        }

        // Jika dari browser (form), redirect ke halaman posts
        return redirect('/posts')->with('success', 'Post created successfully!');
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
            if ($request->is('api/*') || $request->wantsJson()) {
                return response()->json(['message' => 'Post not found'], 404);
            }
            return redirect('/posts')->with('error', 'Post not found!');
        }

        if ($request->is('api/*') || $request->wantsJson()) {
            return response()->json($post);
        }
        return redirect('/posts')->with('success', 'Post updated successfully!');
    }

    /**
     * Remove the specified post from storage.
     */
    public function destroy($id, Request $request)
    {
        $deleted = Posts::deletePost($id);
        if (!$deleted) {
            if ($request->is('api/*') || $request->wantsJson()) {
                return response()->json(['message' => 'Post not found'], 404);
            }
            return redirect('/posts')->with('error', 'Post not found!');
        }
        if ($request->is('api/*') || $request->wantsJson()) {
            return response()->json(['message' => 'Post deleted successfully']);
        }
        return redirect('/posts')->with('success', 'Post deleted successfully!');
    }
}