@extends('layout.app')

@section('content')
    <h1>Recipes</h1>
    <ul>
        @foreach($ingredients as $ingredient)
            <li>{{$ingredient->name}}</li>
        @endforeach
    </ul>
@endsection