@extends('main')
@section('content')
        <div>
            <form action = "{{route('category.store')}}" method = "post">
                @csrf
                <div class="form-group">
                  <label for="title">Title category</label>
                  <input type="text" name ="title" class="form-control" id="title" placeholder="title">
                  
                  @error('title')
                  <p class = "text-danger">{{ $message }}</p>
                  @enderror
                </div>
                  <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
@endsection