@extends('main')
@section('content')
        <div>
            <form action = "{{route('role.store')}}" method = "post">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name"  class="form-control" id="name" placeholder="name" value="{{ $roles->name }}">
                  @error('name')
                  <p class = "text-danger">{{ $message }}</p>
                  @enderror
                  @foreach($permissions as $permission)
                    <div class="form-group form-check">
                        <input type="checkbox" value={{$permission->id}} @if($roles->hasPermissionTo($permission->name)) checked @endif name="permissions[]" class="form-check-input" id='{{$permission->id}}'>
                        <label class="form-check-label" for="{{$permission->id}}">{{$permission->name}}</label>
                  @endforeach
                  <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
@endsection