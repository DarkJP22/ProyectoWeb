<x-app-layout>
    <div class="container bg-gray-800 p-6 rounded-lg max-w-3xl mx-auto mt-6">
        <h1 class="text-2xl font-semibold text-white mb-6">Editar Película</h1>
        <form action="" method="POST" id="form" class="space-y-4">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label text-white">Título</label>
                <input type="text" class="form-control bg-gray-900 text-gray-200 border-gray-600 rounded-md"
                    id="title" name="title" value="{{ $movie->title }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label text-white">Descripción</label>
                <input class="form-control bg-gray-900 text-gray-200 border-gray-600 rounded-md" id="description"
                    name="description" value="{{ $movie->description }}" required>
            </div>

            <div class="mb-3">
                <label for="release_date" class="form-label text-white">Fecha de estreno</label>
                <input type="date" class="form-control bg-gray-900 text-gray-200 border-gray-600 rounded-md"
                    id="release_date" name="release_date" value="{{ $movie->release_date }}" required>
            </div>

            <div class="mb-3">
                <label for="duration" class="form-label text-white">Duración</label>
                <input type="text" class="form-control bg-gray-900 text-gray-200 border-gray-600 rounded-md"
                    id="duration" name="duration" value="{{ $movie->duration }}" required pattern="[0-9]{1}">
            </div>

            <div class="mb-3">
                <label for="categories_id" class="form-label text-white">Categoría</label>
                <select name="categories_id" id="categories_id"
                    class="form-control bg-gray-900 text-gray-200 border-gray-600 rounded-md" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ $movie->category->id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="image_path" class="form-label text-white">Imagen</label>
                <input type="file" class="form-control bg-gray-900 text-gray-200 border-gray-600 rounded-md"
                    id="image_path" name="image_path" required>
            </div>

            <input type="hidden" name="id" id="hide" value="{{ $movie->id }}">
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById("form").onsubmit = async function(event) {
            event.preventDefault();

            const formulario = document.getElementById('form');
            const formData = new FormData(formulario);
            const id = document.getElementById('hide').value;

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            try {
                const response = await fetch(`/movies/${id}/update`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json' // Opcional, dependiendo de si el backend espera JSON
                    },
                    body: formData
                });

                if (!response.ok) {
                    throw new Error(`Error en la solicitud: ${response.statusText}`);
                }

                const result = await response.json();
                console.log('Éxito:', result);

                Swal.fire({
                    icon: 'success',
                    title: 'Película actualizada',
                    text: 'La película ha sido actualizada exitosamente.',
                    confirmButtonText: 'Aceptar'
                }).then(() => {
                    window.location.href = '/movies'; // Redirige al usuario a la lista de películas
                });

            } catch (error) {
                console.error(error.message);

                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Hubo un problema al actualizar la película.',
                    confirmButtonText: 'Aceptar'
                });
            }
        }
    </script>
</x-app-layout>