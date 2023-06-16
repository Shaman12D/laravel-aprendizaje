@extends('dashboard.layout')

@section('content')
<a class="btn btn-success mt-3" href="{{ route("category.create") }}">Crear</a>

<table class="table mb-3">
    <thead>
        <tr>
            <th>Titulo</th>
            <th>Slug</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($categories as $c)
            <tr>
                <td>{{ $c->title }}</td>
                <td>{{ $c->slug }}</td>
                <td>
                    <a class="btn btn-warning mt-2" href="{{ route("category.edit",$c) }}">Editar</a>
                    <a class="btn btn-primary mt-2" href="{{ route("category.show",$c) }}">Mostrar</a>
                    <form action="{{ route("category.destroy",$c) }}" method="POST">
                    @method("DELETE")
                    @csrf
                        <button class="btn btn-danger mt-2" type="submit">Eliminar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{ $categories->links() }}
@endsection
