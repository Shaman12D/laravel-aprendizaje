@extends('dashboard.layout')

@section('content')

    <a class="btn btn-success mt-3" href="{{ route("post.create") }}">Crear</a>

    <table class="table mb-3">
        <thead>
            <tr>
                <th>Titulo</th>
                <th>Categoria</th>
                <th>Posted</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($posts as $p)
                <tr>
                    <td>{{ $p->title }}</td>
                    <td>{{ $p->category->title }}</td><!-- Variable de la tabla hija -->
                    <td>{{ $p->posted }}</td>
                    <td>
                        <a class="btn btn-warning mt-2" href="{{ route("post.edit",$p) }}">Editar</a>
                        <a class="btn btn-primary mt-2" href="{{ route("post.show",$p) }}">Mostrar</a>
                        <form action="{{ route("post.destroy",$p) }}" method="POST">
                        @method("DELETE")
                        @csrf
                            <button class="btn btn-danger mt-2" type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $posts->links() }}
@endsection
