@extends('main')
@section('content')
        <div>
            <form action = "{{route('ticket.store')}}" method = "post">
                @csrf
                <div class="form-group">
                  <label for="name_project">Name project</label>
                  <input
                  
                    value="{{old('name_project')}}"

                    type="text" name ="name_project" class="form-control" id="name_project" placeholder="name project">
                  
                  @error('name_project')
                  <p class = "text-danger">{{ $message }}</p>
                  @enderror
                </div>
                <div class="form-group">
                    <label for="name_of_the_manager">Name of the manager</label>
                    <input
                  
                    value="{{old('name_of_the_manager')}}"

                    type="text" name ="name_of_the_manager" class="form-control" id="name_of_the_manager" placeholder="name of the manager">

                    @error('name_of_the_manager')
                      <p class = "text-danger">{{ $message }}</p>
                    @enderror
                  
                </div>
                <div class="form-group">
                  <label for="email_of_the_manager">Email of the manager</label>
                  <input 
                    
                    value="{{old('email_of_the_manager')}}"

                    type="text" name = "email_of_the_manager" class="form-control" id="email_of_the_manager" placeholder="email of the manager">
                  
                  @error('email_of_the_manager')
                    <p class = "text-danger">{{ $message }}</p>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="start_date_of_execution">Start date of execution</label>
                  <input 
                    
                    value="{{old('start_date_of_execution')}}"

                    type="text" name = "start_date_of_execution" class="form-control" id="start_date_of_execution" placeholder="2000-10-10">
                  
                  @error('start_date_of_execution')
                    <p class = "text-danger">{{ $message }}</p>
                  @enderror
                </div>
                  
                <div class="form-group">
                  <label for="status">Status</label>
                  <select class="form-control" id="status" name="status">
                    @foreach($status as $statu)
                      <option value="{{ $statu }}">{{ $statu }}</option>
                    @endforeach
                  </select>
                </div>
                @error('status')
                  <p class = "text-danger">{{ $message }}</p>
                @enderror
                <div class="form-group">
                  <label for="user">User</label>
                    <select class="form-control" id="user" name="user[]">
                      @foreach($users as $user)
                      <option value = "{{$user->id}}">{{ $user->name }}</option>
                      @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
              </form>
        </div>
@endsection