@extends('layouts.main')
@section('content')
        <div>
            <div>{{$tickets->name_project}}. {{$tickets->start_date_of_execution}}</div>
        </div>
        <div>
            <a href ="{{route('ticket.index')}}">Back</a>
        </div>
        <div>
            <a href ="{{route('ticket.edit', $tickets->id)}}">Edit</a>
        </div>
        <div>
            <form action = "{{route('ticket.destroy', $tickets->id)}}" method = "post">
                @csrf
                @method('DELETE')
                <input type="submit" value="Delet" class="btn btn-danger">
            </form>
        </div>
@endsection