<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Fabchain</title>
    {{Html::style('css/basscss.css')}}
    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">
        <nav class="clearfix py1 bg-white">
        <div class="sm-flex center nowrap">
          <div class="flex-auto">
            <a href="{{ url('/home') }}" class="btn black btn-primary white bg-black navbtn">Home</a>
          </div>
          <div class="flex-auto">
            <a href="{{ url('/info') }}" class="btn black navbtn">View Object Info</a>
          </div>
          @if (Auth::guest())
          <div class="flex-auto">
            <a href="{{ url('/login')}}" class="btn black navbtn">login</a>
          </div>
          <div class="flex-auto">
            <a href="{{ url('/register') }}" class="btn black navbtn">Register</a>
          </div>
          @else
          <div class="flex-auto">
            <a href="{{ url('/logout') }}" class="btn black navbtn">Logout</a>
          </div>
          @endif
      </div>
    </nav>
    @yield('content')
</body>
</html>
