<x-app-layout>
    <br>
    <br>
    <div class="container bg-gray-800 p-6 rounded-lg">
        <a href="{{ route('categories.create') }}">
            <button type="button" class="btn btn-primary">Agregar Categoría</button>
        </a>
        <br><br>
        <div class="bg-gray-900 rounded-lg overflow-x-auto">
            <table class="table text-white w-full">
                <thead>
                    <tr class="bg-gray-700">
                        <th scope="col" class="px-4 py-2">ID</th>
                        <th scope="col" class="px-4 py-2">Nombre</th>
                        <th scope="col" class="px-4 py-2">Descripción</th>
                        <th scope="col" class="px-4 py-2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categorias as $categoria)
                        <tr class="bg-gray-800 hover:bg-gray-700">
                            <th scope="row" class="px-4 py-2">{{ $categoria->id }}</th>
                            <td class="px-4 py-2">{{ $categoria->name }}</td>
                            <td class="px-4 py-2">{{ $categoria->description }}</td>
                            <td class="px-4 py-2">
                                <a href="/categories/{{ $categoria->id }}/edit">
                                    <button type="button" class="btn btn-primary">Editar</button>
                                </a>
                                <form action="/categories/{{ $categoria->id }}/destroy" method="POST" class="d-inline">
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
</x-app-layout>