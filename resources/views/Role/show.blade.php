@extends('main')
@section('content')
        <div>
            <div> {{$roles->id}}. {{$roles->name}}</div>
        </div>
        <div>
            <a href ="{{route('role.index')}}">Back</a>
        </div>
@endsection