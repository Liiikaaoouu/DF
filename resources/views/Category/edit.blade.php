@extends('main')
@section('content')
        <div>
            <form action = "{{route('category.update', $category->id)}}" method = "post">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="title">Title category</label>
                    <input type="text" name="title" class="form-control" id="title" placeholder="title" value="{{ $category->title }}">
                </div>
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
@endsection