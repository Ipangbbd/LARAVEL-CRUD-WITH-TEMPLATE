<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::all();
        return view('genres.index', compact('genres'));
    }

    public function create()
    {
        return view('genres.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:genres,name|max:255',
        ]);

        Genre::create($request->all());

        return redirect()->route('genres.index')
                        ->with('success', 'Genre created successfully.');
    }

    public function edit(Genre $genre)
    {
        return view('genres.edit', compact('genre'));
    }

    public function update(Request $request, Genre $genre)
    {
        $validated = $request->validate([
            'name' => 'required|unique:genres,name,' . $genre->id . '|max:255',
        ]);
    
        try {
            $genre->update($validated);
    
            return response()->json([
                'success' => true,
                'message' => 'Genre updated successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating the genre.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Genre $genre)
    {
        $genre->delete();

        return redirect()->route('genres.index')
                        ->with('success', 'Genre deleted successfully.');
    }
}
