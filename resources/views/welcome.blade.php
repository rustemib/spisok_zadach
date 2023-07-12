<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Список задач</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</head>
<body class="d-flex h-100 text-center text-bg-dark">
            <div class="container bg-dark text-secondary px-4 py-5 text-center">
                <div class="py-5">
                    <h1 class="display-5 fw-bold text-white">Список задач</h1>
                    <div class="col-lg-6 mx-auto">
                        <p class="fs-5 mb-4 text-center">Какой то приветсвенный текст</p>
                        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                            @if(Auth::check() && Auth::user()->is_admin)
                                <a href="{{ url('/admin') }}" class="btn btn-outline-secondary btn-lg px-4 me-sm-3 fw-bold">Админка</a>
                            @endif
                            @if (Auth::check())
                            @auth
                                <a href="{{ url('/tasks/index') }}" class="btn btn-outline-secondary btn-lg px-4 me-sm-3 fw-bold">К задачам</a>
                            @else
                            @endauth
                            @endif
                            <a href="{{ route('login') }}" class="btn btn-outline-info btn-lg px-4 me-sm-3 fw-bold">Loggin</a>
                            @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg px-4">Register</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
</body>
</html>
