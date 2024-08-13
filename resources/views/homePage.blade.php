<x-app-layout>
    <div class="bg-gray-800 text-white py-4">
        <div class="flex flex-col items-center">
            <a href="{{ route('HomePage') }}" class="font-semibold text-xl leading-tight mb-4">
                <h2>{{ __('Movies') }}</h2>
            </a>
            <div class="flex space-x-4">
                @foreach ($categories as $category)
                    <a href="{{ route('HomePage', ['category' => $category->name]) }}"
                        class="text-white bg-gray-800 hover:bg-gray-600 px-3 py-1 rounded-lg transition duration-300">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>
    <div class="py-12 bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 bg-gray-800 rounded-lg shadow-md">
                    <h2 class="text-xl font-semibold mb-4 text-white">
                        Movies @if ($selectedCategory)
                            / {{ $selectedCategory }}
                        @endif
                    </h2>
                    <div class="container">
                        <div class="flex flex-wrap justify-center gap-6">
                            @if ($movies->isEmpty())
                                <p class="text-center text-white">No existen películas en esta categoría.</p>
                            @else
                                @foreach ($movies as $movie)
                                    <div class="bg-gray-700 rounded-lg shadow-lg w-80 mx-3">
                                        <img src="data:image/png;base64, {{ $movie->image_path }}"
                                            class="w-full h-48 object-cover rounded-t-lg" alt="{{ $movie->title }}"
                                            data-bs-toggle="modal" data-bs-target="#movieModal"
                                            data-id="{{ $movie->id }}"
                                            data-title="{{ $movie->title }}"
                                            data-description="{{ $movie->description }}"
                                            data-category="{{ $movie->category->name }}"
                                            data-release_date="{{ $movie->release_date }}"
                                            data-duration="{{ $movie->duration }}">
                                        <div class="p-4">
                                            <h5 class="text-lg font-semibold text-white mb-2">Titulo: {{ $movie->title }}
                                            </h5>
                                            <p class="text-gray-400 mb-2">Descripción: {{ $movie->description }}</p>
                                            <p class="text-gray-400 mb-2">Categoria: {{ $movie->category->name }}</p>
                                            <p class="text-gray-400 mb-2">Fecha de estreno: {{ $movie->release_date }}</p>
                                            <p class="text-gray-400">Duración: {{ $movie->duration }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Película -->
    <div class="modal fade" id="movieModal" tabindex="-1" aria-labelledby="movieModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content bg-gray-800 text-white">
                <div class="modal-header border-b border-gray-700">
                    <h5 class="modal-title text-2xl font-semibold" id="movieModalLabel">Detalles de la Película</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-6">
                    <img id="modal-image" class="w-full h-64 object-cover rounded-lg mb-4" alt="Imagen de la película">
                    <div class="space-y-4">
                        <p class="text-lg">
                            <strong class="text-gray-400">Título:</strong>
                            <span id="modal-title" class="ml-2 text-white"></span>
                        </p>
                        <p class="text-lg">
                            <strong class="text-gray-400">Descripción:</strong>
                            <span id="modal-description" class="ml-2 text-white"></span>
                        </p>
                        <p class="text-lg">
                            <strong class="text-gray-400">Categoría:</strong>
                            <span id="modal-category" class="ml-2 text-white"></span>
                        </p>
                        <p class="text-lg">
                            <strong class="text-gray-400">Fecha de estreno:</strong>
                            <span id="modal-release_date" class="ml-2 text-white"></span>
                        </p>
                        <p class="text-lg">
                            <strong class="text-gray-400">Duración:</strong>
                            <span id="modal-duration" class="ml-2 text-white"></span>
                        </p>
                    </div>
                </div>
                <div class="modal-footer border-t border-gray-700">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modal = document.getElementById('movieModal');

            modal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget; // Botón que activó el modal
                const title = button.getAttribute('data-title');
                const description = button.getAttribute('data-description');
                const category = button.getAttribute('data-category');
                const releaseDate = button.getAttribute('data-release_date');
                const duration = button.getAttribute('data-duration');
                const image = button.src;

                // Actualiza el contenido del modal
                modal.querySelector('#modal-title').textContent = title;
                modal.querySelector('#modal-description').textContent = description;
                modal.querySelector('#modal-category').textContent = category;
                modal.querySelector('#modal-release_date').textContent = releaseDate;
                modal.querySelector('#modal-duration').textContent = duration;
                modal.querySelector('#modal-image').src = image;
            });

            // Verifica si el mensaje de no películas está presente en la vista
            @if ($movies->isEmpty() && $selectedCategory)
                Swal.fire({
                    icon: 'info',
                    title: 'No hay películas',
                    text: 'No existen películas en esta categoría.',
                    confirmButtonText: 'Aceptar'
                }).then(() => {
                    window.location.href = '{{ route('HomePage') }}';
                });
            @endif
        });
    </script>
</x-app-layout>
