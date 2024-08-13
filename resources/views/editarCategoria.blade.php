<x-app-layout>
    <div class="container bg-gray-800 p-6 rounded-lg max-w-3xl mx-auto mt-6">
        <h1 class="text-2xl font-semibold text-white mb-6">Editar Categoría</h1>
        <form id="categoryForm" action="/categories/{{ $category->id }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label text-white">Nombre</label>
                <input type="text" class="form-control bg-gray-900 text-gray-200 border-gray-600 rounded-md" id="name" name="name" value="{{ $category->name }}">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label text-white">Descripción</label>
                <textarea class="form-control bg-gray-900 text-gray-200 border-gray-600 rounded-md" id="description" name="description">{{ $category->description }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('categoryForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Evita el envío del formulario

            const form = event.target;

            Swal.fire({
                title: '¡Categoría guardada!',
                text: 'La categoría ha sido actualizada exitosamente.',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => {
                form.submit(); // Envía el formulario después de mostrar la alerta
            });
        });
    </script>
</x-app-layout>
