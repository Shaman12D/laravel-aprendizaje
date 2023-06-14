<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
</head>
<body>
    @include("fragment.subview")

    @if ($name == 'Carlos Devia')
        Es true
    @else
        Es false
    @endif
    <br>
    {{ $name }} <br>
    {{ $age }} <br>
    {!! $html !!}
    {{-- $age --}}

    @foreach($array as $a)
        <div class="box-item">
            {{ $a }}
        </div>
    @endforeach
    <hr>
    @forelse ($array as $a)
        <div class="box-item">
            {{ $a }}
        </div>
    @empty
        No data
    @endforelse
</body>
</html>