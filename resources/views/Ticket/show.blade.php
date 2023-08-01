@extends('main')
@section('content')
        <div>
            <div>{{ $tickets->id }} - {{ $tickets->name_project }}, {{ $tickets->name_of_the_manager }}, {{ $tickets->email_of_the_manage }} {{ $tickets->start_date_of_execution }}, {{ $tickets->status }}, {{ $tickets->user->isNotEmpty() ? $tickets->user->first()->name : 'Not assigned' }}</div>
        </div>
        <div>
            <a href ="{{route('ticket.index')}}">Back</a>
        </div>
@endsection

