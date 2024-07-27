<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::paginate(10);

        return view('authors.index', compact('authors'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Author::create($request->all());

        return redirect()->route('dashboard')->with('success', 'Author added successfully.');
    }

    public function update(Request $request, Author $author)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $author->update($request->all());

        return redirect()->route('dashboard')->with('success', 'Author updated successfully.');
    }

    public function destroy(Author $author)
    {
        $author->delete();

        return redirect()->route('dashboard')->with('success', 'Author deleted successfully.');
    }
}
