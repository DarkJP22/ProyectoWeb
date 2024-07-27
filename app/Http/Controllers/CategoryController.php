<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        // Obtener las categorías desde la base de datos
        $categories = Category::paginate(10);

        // Pasar las categorías a la vista
        return view('categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        Category::create($request->all());

        return redirect()->route('dashboard')->with('success', 'Category added successfully.');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:500',
        ]);

        $category = Category::findOrFail($id);

        $category->name = $validated['nombre'];
        $category->description = $validated['descripcion'];
        $category->save();

        return response()->json(['message' => 'Categoría actualizada correctamente.']);
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('dashboard')->with('success', 'Category deleted successfully.');
    }
}
