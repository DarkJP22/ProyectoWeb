<x-app-layout>
    <br>
    <br>
    <div class="container">
        <a href="{{ route('movies.show') }}">
            <button type="button" class="btn btn-primary">
                Agregar Pelicula
            </button>
        </a>
        <br>
        <br>
        <div class="d-flex justify-content-evenly">
            @foreach ($movies as $movie)
                <div class="card" style="width: 18rem;">
                    <img src="data:image/png;base64, {{ $movie->image_path }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Titulo: {{ $movie->title }}
                        </h5>
                        <p class="card-text">Descripción:
                            {{ $movie->description }}
                        </p>
                        <p class="card-text">Categoria:
                            {{ $movie->category->name }}
                        </p>
                        <p class="card-text">
                            Fecha de estreno:
                            {{ $movie->release_date }}
                        </p>
                        <p class="card-text">Duración:
                            {{ $movie->duration }}
                        </p>
                        <a href="/movies/edit/{{ $movie->id }}" class="btn btn-primary">Editar</a>

                        <form action="/movies/{{ $movie->id }}" method="POST" class="d-inline">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</x-app-layout>
