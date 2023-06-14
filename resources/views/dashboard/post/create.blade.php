@extends('dashboard.layout')

@section('content')
<h1>crear post</h1>
    
@include('dashboard.fragment._errors-form')

    <form action="{{ route('post.store') }}" method="post">
        @include('dashboard.post._form')
    </form>
@endsection