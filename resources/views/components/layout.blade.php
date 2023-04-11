<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{config('app.name')}}</title>
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap-5.3.0-alpha3-dist/css/bootstrap.min.css">
    <style type="text/css">
        header{
            background-color: #ffc700;
            padding: 0 10px;
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
            <img src="Yeelu-white-300.png"/>
        </div>
        @if(Auth::check())
            <div>
            </div>
        @endif
    </header>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
      Alerta de prueba
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    {{$slot}}
    <script type="text/javascript" src="vendor/bootstrap-5.3.0-alpha3-dist/js/bootstrap.min.js"></script>
</body>
</html>