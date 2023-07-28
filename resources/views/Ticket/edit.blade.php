@extends('main')
@section('content')
    <div>
        <form action="{{ route('ticket.update', $tickets->id) }}" method="post">
            @csrf
            @method('put')
            <div class="form-group">
                <label for="name_project">Name project</label>
                <input type="text" name="name_project" class="form-control" id="name_project" placeholder="name_project" value="{{ $tickets->name_project }}">
            </div>
            <div class="form-group">
                <label for="name_of_the_manager">Name of the manager</label>
                <input type="text" name="name_of_the_manager" class="form-control" id="name_of_the_manager" placeholder="name_of_the_manager" value="{{ $tickets->name_of_the_manager }}">
            </div>
            <div class="form-group">
                <label for="email_of_the_manager">Email_of_the_manager</label>
                <input type="text" name="email_of_the_manager" class="form-control" id="email_of_the_manager" placeholder="email_of_the_manager" value="{{ $tickets->email_of_the_manager }}">
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status">
                    @foreach($status as $statu)
                    <option value="{{ $statu }}" @if($statu === $tickets->status) selected @endif>{{ $statu }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="user">User</label>
                <select class="form-control" id="user" name="user[]">
                    @foreach($users as $user)
                        <option value = "{{$user->id}}"{{ in_array($user->id, $userTicket) ? 'selected' : ''}}>{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
