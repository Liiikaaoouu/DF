@extends('main')
@section('content')
    <div class="mt-4">
        @csrf
        @method('patch')
        <div class="conteiner mt-4">
            <div class="row">
                <div class="col-md-6">
                    @if(auth()->user()->can('create ticket'))
                        <a href="{{ route('category.create') }}" class="btn btn-success md-4">Add new category</a>
                    @endif
                    @foreach($category as $categories)
                        <div class="card mt-4 d-4">
                            <h5 class="card-header">{{$categories->id}}</h5>
                            <div class="card-body">
                                @if(auth()->user()->can('show ticket'))
                                    <a href="{{route('category.show', $categories->id)}}" class="btn btn-primary">View category</a>
                                @endif
                                @if(auth()->user()->can('update ticket'))
                                    <a href="{{route('category.edit', $categories->id)}}" class="btn btn-primary">Edit</a>
                                @endif
                                @if(auth()->user()->can('destroy ticket'))
                                    <form action = "{{route('category.destroy', $categories->id)}}" method = "post">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" value="Delete" class="btn btn-danger mt-2">
                                    </form>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

