<x-app-layout>
    <div class="container">
        <form action="" method="POST" id="form">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Titulo</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Descripción</label>
                <input class="form-control" id="description" name="description" required>
            </div>
            <div class="mb-3">
                <label for="release_date" class="form-label">Fecha de estreno</label>
                <input type="date" class="form-control" id="release_date" name="release_date" required>
            </div>
            <div class="mb-3">
                <label for="duration" class="form-label">Duración</label>
                <input type="text" class="form-control" id="duration" name="duration" required pattern="[0-9]{1}">
            </div>
            <div class="mb-3">
                <label for="categories_id" class="form-label">Categoria</label>
                <select name="categories_id" id="categories_id" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="image_path" class="form-label">Imagen</label>
                <input type="file" class="form-control" id="image_path" name="image_path" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>

    <script>
        document.getElementById("form").onsubmit = async function(event) {
            event.preventDefault();
            const formulario = document.getElementById('form');
            const formData = new FormData(formulario);

            fetch('/movies/store', {
                    method: 'POST',
                    body: formData
                })
                .then(data => {
                    console.log('Éxito:', data);
                })
                .then(() => {
                    window.location.href = '/movies';
                })
        }
    </script>
</x-app-layout>
