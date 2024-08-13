<x-app-layout>
    <br>
    <br>
    <div class="container bg-gray-800 p-6 rounded-lg">
        <h1 class="text-2xl font-semibold text-white mb-6">Agregar Película</h1>
        <form action="" method="POST" id="form">
            @csrf
            <div class="mb-4">
                <label for="title" class="form-label text-white">Título</label>
                <input type="text" class="form-control bg-gray-900 text-gray-200 border-gray-600 rounded-md"
                    id="title" name="title" placeholder="Título de la película" required>
            </div>
            <div class="mb-4">
                <label for="description" class="form-label text-white">Descripción</label>
                <input class="form-control bg-gray-900 text-gray-200 border-gray-600 rounded-md" id="description"
                    name="description" placeholder="Descripción de la película" required>
            </div>
            <div class="mb-4">
                <label for="release_date" class="form-label text-white">Fecha de estreno</label>
                <input type="date" class="form-control bg-gray-900 text-gray-200 border-gray-600 rounded-md"
                    id="release_date" name="release_date" required>
            </div>
            <div class="mb-4">
                <label for="duration" class="form-label text-white">Duración</label>
                <input type="text" class="form-control bg-gray-900 text-gray-200 border-gray-600 rounded-md"
                    id="duration" name="duration" placeholder="Duración en minutos" required pattern="[0-9]{1}">
            </div>
            <div class="mb-4">
                <label for="categories_id" class="form-label text-white">Categoría</label>
                <select name="categories_id" id="categories_id"
                    class="form-control bg-gray-900 text-gray-200 border-gray-600 rounded-md" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="image_path" class="form-label text-white">Imagen</label>
                <input type="file" class="form-control bg-gray-700 text-white border-gray-600" id="image_path"
                    name="image_path" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById("form").onsubmit = async function(event) {
            event.preventDefault();
            const formulario = document.getElementById('form');
            const formData = new FormData(formulario);

            try {
                const response = await fetch('/movies/store', {
                    method: 'POST',
                    body: formData
                });

                if (!response.ok) {
                    throw new Error(`Error en la solicitud: ${response.statusText}`);
                }

                const result = await response.json();

                // Muestra SweetAlert2
                Swal.fire({
                    icon: 'success',
                    title: 'Película agregada',
                    text: 'La película ha sido agregada con éxito.',
                    confirmButtonText: 'Aceptar'
                }).then(() => {
                    window.location.href = '/movies';
                });

            } catch (error) {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Hubo un problema al agregar la película.',
                    confirmButtonText: 'Aceptar'
                });
            }
        }
    </script>
</x-app-layout>
