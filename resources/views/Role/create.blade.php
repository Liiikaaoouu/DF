@extends('main')
@section('content')
        <div>
            <form action = "{{route('role.store')}}" method = "post">
                @csrf
                @method('post')
                <div class="form-group">
                  <label for="name">Name</label>
                  <input
                  
                    value="{{old('name')}}"

                    type="text" name ="name" class="form-control" id="name" placeholder="name">
                  
                  @error('name')
                  <p class = "text-danger">{{ $message }}</p>
                  @enderror
                  @foreach($permissions as $permission)
                    <div class="form-group form-check">
                        <input type="checkbox" value={{$permission->id}} name="permissions[S]" class="form-check-input" id='{{$permission->id}}'>
                        <label class="form-check-label" for="{{$permission->id}}">{{$permission->name}}</label>
                    </div>
                  @endforeach
                  <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
@endsection