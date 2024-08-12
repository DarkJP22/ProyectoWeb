<x-app-layout>
    <div class="container">
        <form action="" method="POST" id="form">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Titulo</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $movie->title }}">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Descripción</label>
                <input class="form-control" id="description" name="description" value="{{ $movie->description }}">
            </div>
            <div class="mb-3">
                <label for="release_date" class="form-label">Fecha de estreno</label>
                <input type="date" class="form-control" id="release_date" name="release_date"
                    value="{{ $movie->release_date }}">
            </div>
            <div class="mb-3">
                <label for="duration" class="form-label">Duración</label>
                <input type="text" class="form-control" id="duration" name="duration"
                    value="{{ $movie->duration }}">
            </div>
            <div class="mb-3">
                <label for="categories_id" class="form-label">Categoria</label>
                <select name="categories_id" id="categories_id">
                    @foreach ($categories as $category)
                        @if ($movie->category->id == $category->id)
                            <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                        @else
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="image_path" class="form-label">Imagen</label>
                <input type="file" class="form-control" id="image_path" name="image_path">
            </div>
            <input type="hidden" name="id" id="hide" value="{{ $movie->id }}">
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>

    <script>
        document.getElementById("form").onsubmit = async function(event) {
            event.preventDefault();
            const formulario = document.getElementById('form');
            const formData = new FormData(formulario);
            const id = document.getElementById('hide').value;

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch(`/movies/${id}/update`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: formData
                })
                .then(data => {
                    console.log('Éxito:', data);
                });
            .then(() => {
                window.location.href = '/movies';
            })
        }
    </script>
</x-app-layout>
