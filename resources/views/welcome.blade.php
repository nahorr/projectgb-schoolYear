<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Eginny Gradebook</title>

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

            .flex-center {
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

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 3px;
                
                
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            

            <div class="content">
                <div class="logo">
                    <a href="https://socidy.com/" class="simple-text">
                        <img src="{{asset('/assets/img/logo/logo.jpg')}}" style="width: 120px; height: 120px; border-radius: 50%; margin-right: 25px;">
                    </a>
                </div>
                <div class="title m-b-md ">
                    eGradebook
                </div>
                <div style="margin: 0;">
                    <h2>School Year: {{$school_year->school_year}}</h1>
                </div>
                <div class="links">
                    <a href="{{ url('/login') }}">Students/Parents Login</a>
                    <a href="{{ url('/admin_login') }}">Staffers/Teachers Login</a>
                    <!-- <a href="https://laravel-news.com">Students</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a> -->
                </div>
            </div>
        </div>
    </body>
</html>
