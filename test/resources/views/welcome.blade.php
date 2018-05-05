<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Appointment Assistant</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .imagepos {
                padding-top: 50px;
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            a{
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
            <div class="imagepos">
                <img src="\image\home_page2.jpg" height="300" width="500"> </img>
            </div>
            <div class="content">
                <div class="title m-b-md">
                    Appointment Assistant
                </div>
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/home') }}">My Profile</a>
                        <a href="{{ url('/logout') }}">Logout</a>
                        <a href="/user">User's</a>

                    @else
                        <a href="{{ route('login') }}" style="text-decoration: none">Login</a>
                        <a href="{{ route('register') }}" style="text-decoration: none">Register</a>
                    @endauth
                 @endif
            </div>
    </body>
</html>
