<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel = "stylesheet" href =  {{ asset('bootstrap/css/bootstrap.css') }}>
    <title>Document</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <a class="navbar-brand" href="{{ route('main.index') }}">Main</a>
          <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ route('ticket.index') }}">Просмотр</a>
              </li>
            </ul>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ route('logout') }}">Выход</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
                </form>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    <div>
        @yield('content')
    </div>
    <div>
      <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name Project</th>
                <th>Name of the Manager</th>
                <th>Email of the Manager</th>
                <th>Start Date of Execution</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tickets as $ticket)
                <tr>
                    <td>{{ $ticket->id }}</td>
                    <td>{{ $ticket->name_project }}</td>
                    <td>{{ $ticket->name_of_the_manager }}</td>
                    <td>{{ $ticket->email_of_the_manager }}</td>
                    <td>{{ $ticket->start_date_of_execution }}</td>
                    <td>{{ $ticket->status }}</td>
                </tr>
            @endforeach
        </tbody>
      </table>
    </div>
</body>
</html>