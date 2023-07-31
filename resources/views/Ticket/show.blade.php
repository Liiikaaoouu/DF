@extends('main')
@section('content')
        <div>
            <div>{{ $ticket->id }} - {{ $ticket->name_project }}, {{ $ticket->name_of_the_manager }}, {{ $ticket->email_of_the_manage }} {{ $ticket->start_date_of_execution }}, {{ $ticket->status }}, {{ $ticket->user->isNotEmpty() ? $ticket->user->first()->name : 'Not assigned' }}</div>
        </div>
        <div>
            <a href ="{{route('ticket.index')}}">Back</a>
        </div>
@endsection

