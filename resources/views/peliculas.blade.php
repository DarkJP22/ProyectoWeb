<x-app-layout>
    <br>
    <br>
    <div class="container bg-gray-800 p-6 rounded-lg">
        <div class="text-center mb-6">
            <a href="{{ route('movies.show') }}">
                <button type="button" class="btn btn-primary">
                    Agregar Pelicula
                </button>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2.5">
            @forelse ($movies as $movie)
                <div class="bg-gray-800 text-white rounded-lg shadow-lg overflow-hidden mx-3">
                    <img src="data:image/png;base64, {{ $movie->image_path }}" class="w-full h-48 object-cover"
                        alt="{{ $movie->title }}">
                    <div class="p-4">
                        <h5 class="text-xl font-semibold mb-2">{{ $movie->title }}</h5>
                        <p class="text-gray-300 mb-2">Descripción: {{ $movie->description }}</p>
                        <p class="text-gray-400 mb-2">Categoría: {{ $movie->category->name }}</p>
                        <p class="text-gray-400 mb-2">Fecha de estreno: {{ $movie->release_date }}</p>
                        <p class="text-gray-400 mb-4">Duración: {{ $movie->duration }} horas</p>

                        <div class="flex justify-between items-center">
                            <a href="/movies/edit/{{ $movie->id }}"
                                class="bg-blue-500 text-white py-1 px-3 rounded-lg hover:bg-blue-600 transition duration-300">Editar</a>
                            <form action="/movies/{{ $movie->id }}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit"
                                    class="bg-red-500 text-white py-1 px-3 rounded-lg hover:bg-red-600 transition duration-300">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-white text-center">No hay películas en esta categoría.</p>
            @endforelse
        </div>
    </div>

    @if (session('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: '{{ session('success') }}',
                    confirmButtonText: 'Aceptar'
                });
            });
        </script>
    @endif
</x-app-layout>
