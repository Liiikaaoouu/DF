@extends('main')
@section('content')
        <div>
            <div>{{$category->id}}- {{$category->title}}</div>
            <a href ="{{route('category.index')}}">Back</a>
        </div>
@endsection