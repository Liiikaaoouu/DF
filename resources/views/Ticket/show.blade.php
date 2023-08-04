@extends('main')
@section('content')
        <div>
            <div>{{ $tickets->id }} - {{ $tickets->name_project }}, {{ $tickets->name_of_the_manager }}, {{ $tickets->email_of_the_manage }} {{ $tickets->start_date_of_execution }}, {{ $tickets->status }},  {{ $tickets->category ? $tickets->category->title : 'No category assigned' }}, {{ $tickets->user->isNotEmpty() ? $tickets->user->first()->name : 'Not assigned' }}</div>
            @if ($tickets->attachment)
                <div>
                    Attachment: {{ $tickets->attachment }}
                    @if(auth()->user()->can('update ticket'))  
                        <a href="{{route('ticket.edit', $tickets->id)}}" target="_blank">Edt attachment</a>
                    @endif    
                </div>
            @else
                Attachment: null
                @if(auth()->user()->can('update ticket'))  
                    <a href="{{route('ticket.edit', $tickets->id)}}" target="_blank">Download attachment</a>
                @endif
            @endif
            @if($commits->isEmpty())
                <p>Commits: null</p>
            @else
                @foreach($commits as $commit)
                    <div class="mb-4">
                        <strong>{{ $commit->user->name }}</strong>
                        <p>{{ $commit->content }}</p>
                        @if($commit->user_id == auth()->user()->id || auth()->user()->can('update ticket'))
                            <a href ="{{route('commit.edit', $commit->id)}}" class="btn btn-primary">Edit comment</a>
                        @endif
                        @if($commit->user_id == auth()->user()->id || auth()->user()->can('destroy commit'))
                            <form action = "{{route('commit.destroy', $commit->id)}}" method = "post">
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="Delet" class="btn btn-danger mt-2">
                            </form>
                        @endif
                        <hr>
                    </div>
                @endforeach
            @endif
            @if(session('deleted_comment_user'))
            <div class="alert alert-info mt-4">
                Comment by user {{ session('deleted_comment_user') }} has been deleted.
            </div>
            @endif
        </div>
        <div>
            @if(auth()->user()->can('create commit'))
                <a href ="{{route('commit.create')}}" class="btn btn-primary">Create comment</a>
            @endif
        </div>
        <div>
            <a href ="{{route('ticket.index')}}" class="btn btn-primary mt-2">Back</a>
        </div>
@endsection

