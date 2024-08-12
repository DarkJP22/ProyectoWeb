<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        // Obtener las categorías desde la base de datos
        $categorias = Category::paginate(10);

        // Pasar las categorías a la vista
        return view('categorias', compact('categorias'));
    }

    public function create()
    {
        return view('crearCategoria');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);

        return view('editarCategoria', compact('category'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        Category::create($request->all());

        return redirect()->route('categories');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:500',
        ]);

        $category = Category::findOrFail($id);

        $category->name = $validated['name'];
        $category->description = $validated['description'];
        $category->save();

        return redirect()->route('categories');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories');
    }
}
