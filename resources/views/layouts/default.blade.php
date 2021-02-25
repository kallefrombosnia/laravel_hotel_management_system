<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/app.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/daterangepicker.css')}}">
    <title>@yield('title')</title>
    
</head>
<body>
    <header>
        <div class="container">
            <div class="navbar">
                <a href="{{route('dashboard')}}">
                    <div class="hotel-name">
                        <img src="/images/laravel.png" alt="" class="logo">
                        Hotel Laravel
                    </div>
                </a>

                <div class="float-right">
                    <a href="{{route('login')}}"><span class="float-right">Login</span></a>
                    <a href={{route('admin')}}><span class="float-right">Admin panel</span></a>
                </div>   

            </div>
            
        </div>
    </header>

    @yield('content')

    @include('includes.footer')
</body>
</html>