@extends('dashboard.layout')

@section('content')
<h1>edit post: {{ $post->title }}</h1>
    
@include('dashboard.fragment._errors-form')

    <h1>{{ $post->tile }}</h1>

    <p>{{ $post->posted }}</p>

    <p>{{ $post->description }}</p>

    <p>{{ $post->content }}</p>

@endsection