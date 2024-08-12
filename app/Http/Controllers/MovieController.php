<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use App\Models\Author;

class MovieController extends Controller
{
    public function index()
    {
        return view('peliculas', [
            'movies' => Movie::all(),
        ]);
    }

    public function home()
    {
        return view('homePage', [
            'movies' => Movie::all(),
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

    public function showCreate()
    {
        $categories = Category::all();
        return view('crearPelicula', [
            'categories' => $categories,
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
        try {
            $validateData = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string|max:255',
                'categories_id' => 'required|exists:categories,id',
                'release_date' => 'required|date',
                'duration' => 'required|string|max:10',
                'image_path' => 'required|image:jpeg,png,jpg,gif,svg',
            ]);

            if ($request->hasFile('image_path')) {
                $image = $request->file('image_path')->path();
                $imageData = base64_encode(file_get_contents($image));
                $validateData['image_path'] = $imageData;
            }

            Movie::create($validateData);

            return response()->json(['message' => 'Película creada con éxito']);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validateData = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'release_date' => 'required|date',
                'categories_id' => 'required|exists:categories,id',
                'duration' => 'required|string',
                'image_path' => 'image:jpeg,png,jpg,gif,svg',
            ]);

            // Actualizar película
            if ($request->hasFile('image_path')) {
                $image = $request->file('image_path')->path();
                $imageData = base64_encode(file_get_contents($image));
                $validateData['image_path'] = $imageData;
            }

            $movie = Movie::find($id);
            $movie->title = $validateData['title'];
            $movie->description = $validateData['description'];
            $movie->release_date = $validateData['release_date'];
            $movie->categories_id = $validateData['categories_id'];
            $movie->duration = $validateData['duration'];
            $movie->image_path = $validateData['image_path'];

            $movie->save();

            return response()->json(['message' => 'Película actualizada con éxito']);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
        // Validar entrada

    }

    public function destroy(Movie $movie)
    {
        $movie->delete();
        return redirect()->route('movies');
    }

    public function edit(Movie $movie)
    {
        $categories = Category::all();
        return view('editarPelicula', [
            'movie' => $movie,
            'categories' => $categories,
        ]);
    }
}
