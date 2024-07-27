<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col items-center">
            <h2 class="font-semibold text-xl text-white leading-tight mb-4">
                {{ __('Movies') }}
            </h2>
            <div class="flex space-x-4">
                @foreach ($categories as $category)
                    <a href="{{ route('HomePage', ['category' => $category->name]) }}"
                        class="text-white bg-gray-800 hover:bg-gray-600 px-3 py-1 rounded-lg transition duration-300">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 bg-gray-700 rounded-lg shadow-md">
                    <h2 class="text-xl font-semibold mb-4 text-white">
                        Movies @if ($selectedCategory)
                            / {{ $selectedCategory }}
                        @endif
                    </h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @forelse ($movies as $movie)
                            <div class="bg-white p-4 rounded-lg shadow-md">
                                @if ($movie->image_path)
                                    <!--<img src="{{ asset('storage/' . str_replace('public/', '', $movie->image_path)) }}" alt="{{ $movie->title }}"
                                        class="w-full h-40 object-cover rounded-lg mb-4">-->
                                    <img src="storage/movies/local_liberia.jpg" class="w-full h-40 object-cover rounded-lg mb-4">
                                @endif
                                <h3 class="text-lg font-semibold mb-2">{{ $movie->title }}</h3>
                                @if ($movie->author)
                                    <p class="text-gray-700 mb-2">Autor: {{ $movie->author->name }}</p>
                                @endif
                                @if ($movie->category)
                                    <p class="text-gray-700 mb-2">Categoría: {{ $movie->category->name }}</p>
                                @endif
                                <p class="text-gray-500">Duración: {{ $movie->duration }} minutos</p>
                            </div>
                        @empty
                            <p class="text-gray-700">No movies found.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
