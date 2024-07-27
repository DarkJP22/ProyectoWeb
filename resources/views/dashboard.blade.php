<!-- resources/views/dashboard.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <nav>
                        <a href="{{ route('dashboard') }}?view=authors"
                            class="{{ request('view') == 'authors' ? 'font-bold' : '' }}">Autores</a>
                        <a href="{{ route('dashboard') }}?view=movies"
                            class="{{ request('view') == 'movies' ? 'font-bold' : '' }}">Películas</a>
                        <a href="{{ route('dashboard') }}?view=categories"
                            class="{{ request('view') == 'categories' ? 'font-bold' : '' }}">Categorías</a>
                    </nav>
                </div>
                <div class="border-t border-gray-200 dark:border-gray-700">
                    <div class="p-6">
                        @if (request('view') == 'categories')
                            <!-- Tabla para Categorías -->
                            <div class="overflow-x-auto">
                                <table
                                    class="min-w-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-md">
                                    <thead>
                                        <tr class="bg-gray-100 dark:bg-gray-700 text-left text-white">
                                            <th class="py-2 px-4 border-b">ID</th>
                                            <th class="py-2 px-4 border-b">Nombre</th>
                                            <th class="py-2 px-4 border-b">Descripción</th>
                                            <th class="py-2 px-4 border-b">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                            <tr class="border-b text-white">
                                                <td class="py-2 px-4">{{ $category->id }}</td>
                                                <td class="py-2 px-4">{{ $category->name }}</td>
                                                <td class="py-2 px-4">{{ $category->description }}</td>
                                                <td class="py-2 px-4 flex space-x-2">
                                                    <button
                                                        class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 transition">Editar</button>
                                                    <button
                                                        class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition">Eliminar</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @elseif (request('view') == 'authors')
                            <!-- Tabla para Autores -->
                            <div class="overflow-x-auto">
                                <table
                                    class="min-w-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-md">
                                    <thead>
                                        <tr class="bg-gray-100 dark:bg-gray-700 text-left text-white">
                                            <th class="py-2 px-4 border-b">ID</th>
                                            <th class="py-2 px-4 border-b">Nombre</th>
                                            <th class="py-2 px-4 border-b">Biografía</th>
                                            <th class="py-2 px-4 border-b">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($authors as $author)
                                            <tr class="border-b text-white">
                                                <td class="py-2 px-4">{{ $author->id }}</td>
                                                <td class="py-2 px-4">{{ $author->name }}</td>
                                                <td class="py-2 px-4">{{ $author->biography }}</td>
                                                <td class="py-2 px-4 flex space-x-2">
                                                    <button
                                                        class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 transition">Editar</button>
                                                    <button
                                                        class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition">Eliminar</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @elseif (request('view') == 'movies')
                            <!-- Tarjetas para Películas -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 ">
                                @foreach ($movies as $movie)
                                    <div class="bg-white p-4 rounded-lg shadow-md">
                                        @if ($movie->image_path)
                                            <img src="{{ Storage::url($movie->image_path) }}"
                                                alt="{{ $movie->title }}"
                                                class="w-full h-48 object-cover mb-4 rounded">
                                        @endif
                                        <h3 class="text-lg font-semibold mb-2">{{ $movie->title }}</h3>
                                        <p class="text-gray-700 dark:text-gray-300 mb-2">{{ $movie->description }}</p>
                                        <div class="flex space-x-2 mt-2">
                                            <button
                                                class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 transition">Editar</button>
                                            <button
                                                class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition">Eliminar</button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-700 dark:text-gray-300">Selecciona una opción de la navegación para ver
                                los datos.</p>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
