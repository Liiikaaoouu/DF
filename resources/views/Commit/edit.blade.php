@extends('main')
@section('content')
    <div>
        <h2>Edit Comment</h2>
        <p>Your Name: {{ auth()->user()->name }}</p>
        <form action="{{ route('commit.update', $commit->id) }}" method="post">
            @csrf
            <div class="form-group">
                <label for="content">Comment</label>
                <textarea class="form-control" id="content" name="content" rows="3" required>{{ $commit->content }}</textarea>
            </div>
            <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
            <button type="submit" class="btn btn-primary">Add Comment</button>
        </form>
    </div>
    <div>
        <a href="{{ route('ticket.show', $ticket->id) }}" class="btn btn-primary mt-4">Back</a>
    </div>
@endsection
