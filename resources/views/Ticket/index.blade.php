@extends('main')
@section('content')
    <div class="mt-5">
        @csrf
        @method('patch')
        <div class="conteiner mt-4">
            <div class="row">
                <div class="col-md-6">
                    @if(auth()->user()->can('create ticket'))
                        <a href="{{ route('ticket.create') }}" class="btn btn-success md-4">Add new ticket</a>
                    @endif
                    @foreach($tickets as $ticket)
                        <div class="card mt-4 md-4">
                            <h5 class="card-header">{{$ticket->name_project}}</h5>
                            <div class="card-body">
                                @if(auth()->user()->can('show ticket'))
                                    <a href="{{route(ticket.show)}}">View ticket</a>
                                @endif
                                @if(auth()->user()->can('update ticket'))    
                                    <a href="{{route(ticket.edit)}}">Edit</a>
                                @endif
                                @if(auth()->user()->can('destroy ticket'))
                                    <form action = "{{route('ticket.destroy', $tickets->id)}}" method = "post">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" value="Delet" class="btn btn-danger">
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

