<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    </head>
    <body>

    <div class="container px-0">
    <nav class="navbar navbar-expand bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ route('home') }}">iuser</a>
      <ul class="navbar-nav ms-auto mb-0">
        @if(Auth::check())
            @if(Auth::user()->isAdmin())
            <li class="nav-item">
            <a class="nav-link" href="{{ route('users.index') }}">Адмінка</a>
            </li>
            @endif
            <li class="nav-item">
            <a class="nav-link" href="{{ route('user.index') }}">Особистий кабінет</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}">Вийти</a>
            </li>
        @else
            <li class="nav-item">
            <a class="nav-link" href="{{ route('login.create') }}">Авторизуватись</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="{{ route('register.create') }}">Зареєструватись</a>
            </li>
        @endif
      </ul>
  </div>
</nav>
</div>

<div class="container pt-5">
<div class="container">
            <div class="row">
                <div class="col-12">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="list-unstyled mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if(session()->has('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if(session()->has('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>

    @yield('content')  
</div>
          
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    @yield('scripts')
    </body>
</html>
