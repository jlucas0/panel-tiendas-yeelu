<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{config('app.name')}}</title>
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap-5.3.0-alpha3-dist/css/bootstrap.min.css">
    <style type="text/css">
        *{
            box-sizing: border-box;
        }
        header{
            background-color: #ffc700;
            padding: 20px 0;
            display: flex;
            justify-content: center;
        }
        .btn-primary{
            --bs-btn-bg: #ffc700;
            --bs-btn-border-color: #ffc700;
            --bs-btn-hover-color: #fff;
            --bs-btn-hover-bg: #97790e;
            --bs-btn-hover-border-color: #8d6e00;
            --bs-btn-active-bg: #8d6e00;
            --bs-btn-active-border-color: #685203;
            --bs-btn-disabled-bg: #ffc700;
            --bs-btn-disabled-border-color: #ffc700;
        }
        .form-control:focus{
            border-color: #f2d775;
            box-shadow: 0 0 0 0.25rem rgb(255 199 0 / 34%);
        }
    </style>
</head>
<body>
    <header>
        <div>
            <img src="Yeelu-white-300.png" @if(Route::current() && Route::current()->getName() != "login") width="150" @endif/>
        </div>
        @if(Auth::check()||true)
            <nav class="navbar navbar-expand-lg ms-3">
              <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                  <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                      <a @class(['nav-link','active'=>Route::current() && Route::current()->getName() == "datos"]) href="{{route('datos')}}">Datos</a>
                    </li>
                    <li>
                        <a href="{{route('login')}}" class="btn btn-secondary">Salir</a>
                    </li>
                  </ul>
                </div>
              </div>
            </nav>
        @endif
    </header>
    <x-alerta/>
    {{$slot}}
    <script type="text/javascript" src="vendor/bootstrap-5.3.0-alpha3-dist/js/bootstrap.min.js"></script>
</body>
</html>