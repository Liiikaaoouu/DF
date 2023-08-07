@extends('main')
@section('content')
    <div class="mt-4">
        @csrf
        @method('patch')
        <div class="conteiner mt-4">
            <div class="row">
                <div class="col-md-6">
                    <a href="{{ route('role.create') }}" class="btn btn-success md-4">Add new role</a>
                    @foreach($roles as $role)
                        <div class="card mt-4 d-4">
                            <h5 class="card-header">{{$role->name}}</h5>
                            <div class="card-body">
                                <a href="{{route('role.show', $role->id)}}" class="btn btn-primary">View role</a>
                                <a href="{{route('role.edit', $role->id)}}" class="btn btn-primary">Edit</a>
                                <form action = "{{route('role.destroy', $role->id)}}" method = "post">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" value="Delete" class="btn btn-danger mt-2">
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

