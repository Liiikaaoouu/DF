@extends('main')
@section('content')
    <div>
        @csrf
        @method('patch')
        <div class="conteiner mt-6">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('role.create') }}" class="btn btn-success md-4">Add new role</a>
                    @foreach($roles as $role)
                        <div class="card md-4">
                            <h5 class="card-header">{{$role->name}}</h5>
                            <div class="card-body">
                                <a href="{{route(role.show)}}">View role</a>
                                <a href="{{route(role.edit)}}">Edit</a>
                                <form action = "{{route('role.destroy', $role->id)}}" method = "post">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" value="Delet" class="btn btn-danger">
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>1
        </div>
    </div>
@endsection

