<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\Category;
use App\Models\Author;
use App\Models\Movie;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $categories = Category::all();

        return view('auth.register', compact('categories'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));
        
        Auth::login($user);
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
}
