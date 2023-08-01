@extends('main')
@section('content')
        <div>
            <h5>Разрешения для роли: {{ $roles->name }}</h5>

            @foreach ($permissions as $permission)
                <p>- {{ $permission->name }}</p>
            @endforeach
            <a href ="{{route('role.index')}}">Back</a>
        </div>
@endsection