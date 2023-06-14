@extends('dashboard.layout')

@section('content')
<h1>category: {{ $category->title }}</h1>
    
@include('dashboard.fragment._errors-form')

    <h1>{{ $category->tile }}</h1>

    <p>{{ $category->slug }}</p>

@endsection