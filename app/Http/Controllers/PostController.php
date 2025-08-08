<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Genre;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with(['genre', 'category'])->get();
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genres = Genre::all();
        $categories = Category::all();
        return view('posts.create', compact('genres', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'genre_id' => 'required|exists:genres,id',
            'category_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
        ]);

        $data = [
            'title' => $validated['title'],
            'content' => $validated['content'],
            'genre_id' => $validated['genre_id'],
            'category_id' => $validated['category_id'] ?? null,
        ];

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('posts', 'public');
            $data['image_path'] = $path;
        }

        Post::create($data);

        return redirect()->route('posts.index')
                        ->with('success', 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $genres = Genre::all();
        $categories = Category::all();
        return view('posts.edit', compact('post', 'genres', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'genre_id' => 'required|exists:genres,id',
            'category_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
        ]);

        $updateData = [
            'title' => $validated['title'],
            'content' => $validated['content'],
            'genre_id' => $validated['genre_id'],
            'category_id' => $validated['category_id'] ?? null,
        ];

        if ($request->hasFile('image')) {
            if (!empty($post->image_path)) {
                Storage::disk('public')->delete($post->image_path);
            }
            $path = $request->file('image')->store('posts', 'public');
            $updateData['image_path'] = $path;
        }

        $post->update($updateData);

        return redirect()->route('posts.index')
                        ->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if (!empty($post->image_path)) {
            Storage::disk('public')->delete($post->image_path);
        }
        $post->delete();

        return redirect()->route('posts.index')
                        ->with('success', 'Post deleted successfully.');
    }
}
