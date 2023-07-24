@extends('main')
@section('content')
    <div>
        @csrf
        @method('patch')
        <div>
            <a href="{{ route('ticket.create') }}" class="btn btn-primary">Add one</a>
        </div>
        <div>
            @foreach($tickets as $ticket)
                <div>
                    <a href="{{ route('ticket.show', $ticket->id)}}">
                        {{ $ticket->id }} - {{ $ticket->name_project }}, {{ $ticket->name_of_the_manager }}, {{ $ticket->email_of_the_manage }}, {{ $ticket->start_date_of_execution }}, {{ $ticket->status }}, {{ $ticket->user->first()->name }}
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
