@extends('layout.master')

@section('content')
    @include("fragment.subview")

    {{ $name }}

    @forelse ($posts as $a)
        <div class="box-item">
            {{ $a }}
        </div>
    @empty
        No data
    @endforelse

@endsection