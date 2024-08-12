<x-app-layout>
    <br>
    <br>
    <div class="container">
        <a href="{{ route('categories.create') }}">
            <button type="button" class="btn btn-primary">
                Agregar Categoria
            </button>
        </a>
        <br>
        <br>
        <div class="row">
            <div class="col">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Descripcion</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categorias as $categoria)
                            <tr>
                                <th scope="row">{{ $categoria->id }}</th>
                                <td>{{ $categoria->name }}</td>
                                <td>{{ $categoria->description }}</td>
                                <td>
                                    <a href="/categories/{{ $categoria->id }}/edit"><button type="button"
                                            class="btn btn-primary">Editar</button></a>

                                    <form action="/categories/{{ $categoria->id }}/destroy" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
