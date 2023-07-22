@extends('layouts.main')
@section('content')
        <div>
            @csrf
            @method('patch')
            <div>
                <a href = "{{ route('ticket.create') }}" class="btn btn-primary">Add one</a>
            </div>
            <div>
                @foreach($tickets as $ticket)
                    <div><a href = "{{ route('ticket.show', $ticket->id)}}">{{$ticket->name_project}}. {{$ticket->start_date_of_execution}}</a></div>
                @endforeach
            </div>
        </div>
@endsection