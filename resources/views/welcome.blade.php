<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Base Laravel 8</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition lockscreen">
    <!-- Automatic element centering -->
    <div class="lockscreen-wrapper">
        <div class="lockscreen-logo">
            <a href="/"><b>Welcome</b> To Boiler Laravel 8</a>
        </div>
        <!-- User name -->
        <div class="lockscreen-name">Before using it, Make sure : </div>
        <div class="text-center">
            <span>Import database file in folder <b>db file</b>, after that the default login is : <br> username
                <b>superadmin</b> <br> password <b>superadmin</b></span>
        </div>
        <div class="text-center">
            <br>
            @auth
                <a href="{{ url('/home') }}" class="btn btn-primary">Home</a>
            @else
                <a href="{{ route('login') }}" class="btn btn-primary">Login</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn btn-success ml-1">Register</a>
                @endif
                @endif
            </div>
        </div>

        <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    </body>

    </html>
