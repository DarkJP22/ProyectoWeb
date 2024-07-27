<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use App\Models\Author;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $authors = Author::all();
        $selectedCategory = $request->query('category');
        
        $movies = Movie::when($selectedCategory, function ($query, $category) {
            return $query->whereHas('category', function ($q) use ($category) {
                $q->where('name', $category);
            });
        })->get();
    
        return view('homepage', [
            'categories' => $categories,
            'movies' => $movies,
            'selectedCategory' => $selectedCategory,
            'authors' => $authors,
        ]);
    }

    public function showDashboard(Request $request)
    {
        $categories = Category::all();
        $authors = Author::all();
        $selectedCategory = $request->input('category');
        
        $movies = Movie::when($selectedCategory, function ($query, $category) {
            return $query->whereHas('category', function ($q) use ($category) {
                $q->where('name', $category);
            });
        })->get();

        return view('dashboard', [
            'categories' => $categories,
            'selectedCategory' => $selectedCategory,
            'movies' => $movies,
            'authors' => $authors,
        ]);
    }

    public function create(Request $request)
    {
        $categories = Category::all();
        $authors = Author::all();
        $selectedCategory = $request->query('category');
        
        $movies = Movie::when($selectedCategory, function ($query, $category) {
            return $query->whereHas('category', function ($q) use ($category) {
                $q->where('name', $category);
            });
        })->get();
    
        return view('dashboard', [
            'categories' => $categories,
            'movies' => $movies,
            'selectedCategory' => $selectedCategory,
            'authors' => $authors,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'categories_id' => 'required|exists:categories,id',
            'author_id' => 'required|exists:authors,id',
            'release_date' => 'required|date',
            'duration' => 'required|string|max:10',
        ]);

        $movieData = $request->only(['title', 'description', 'release_date', 'duration', 'categories_id', 'author_id']);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('movies', 'public');
            $movieData['image_path'] = $imagePath; // Guarda la ruta relativa
        }

        Movie::create($movieData);

        return redirect()->route('dashboard');
    }

    public function update(Request $request, $id)
    {
        // Validar entrada
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'release_date' => 'required|date',
            'categories_id' => 'required|exists:categories,id',
            'author_id' => 'required|exists:authors,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Actualizar película
        $movie = Movie::findOrFail($id);
        $movie->title = $request->input('title');
        $movie->description = $request->input('description');
        $movie->release_date = $request->input('release_date');
        $movie->categories_id = $request->input('categories_id');
        $movie->duration = $request->input('duration');
        $movie->author_id = $request->input('author_id');

        if ($request->hasFile('image')) {
            if ($movie->image_path) {
                Storage::delete('public/' . $movie->image_path);
            }
            $imagePath = $request->file('image')->store('movies', 'public');
            $movie->image_path = $imagePath; // Actualiza la ruta de la imagen
        }

        $movie->save();

        return response()->json(['message' => 'Película actualizada con éxito']);
    }

    public function destroy(Movie $movie)
    {
        if ($movie->image_path) {
            Storage::delete('public/' . $movie->image_path);
        }
        $movie->delete();
        return redirect()->route('dashboard');
    }
}