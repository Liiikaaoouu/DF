@extends('main')
@section('content')
        <div>
            <form action = "{{route('role.update', $role->id)}}" method = "post">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="name">Choose permission for {{$role->name}}</label>
                  @foreach($permissions as $permission)
                    <div class="form-group form-check">
                        <input type="checkbox" value={{$permission->id}} @if($role->hasPermissionTo($permission->name)) checked @endif name="permissions[]" class="form-check-input" id='{{$permission->id}}'>
                        <label class="form-check-label" for="{{$permission->id}}">{{$permission->name}}</label>
                    </div>
                  @endforeach
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
        @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
        @endif
@endsection