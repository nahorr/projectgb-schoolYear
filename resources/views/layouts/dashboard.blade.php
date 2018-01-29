<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{asset('assets/img/apple-icon.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('assets/img/favicon.png')}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Totalgrades - Dashboard</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" />

        <!-- Animation library for notifications   -->
    <link href="{{asset('assets/css/animate.min.css')}}" rel="stylesheet"/>

    <!--  Paper Dashboard core CSS    -->
    <link href="{{asset('assets/css/paper-dashboard.css')}}" rel="stylesheet"/>

     
    <!--  Fonts and icons     -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="{{asset('assets/css/themify-icons.css')}}" rel="stylesheet">

    {!! Charts::assets() !!}

</head>
<body>

<div class="wrapper">

 @include('layouts.includes.sidebar')

    <div class="main-panel">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar bar1"></span>
                        <span class="icon-bar bar2"></span>
                        <span class="icon-bar bar3"></span>
                    </button>
                    <a class="navbar-brand" href="{{ url('/home') }}">{{@$school->name}}</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-clock-o"></i>Your last login activity was 
                                <p>{{ @$login_activity->created_at->diffForHumans()}}</p><br>
                                <i class="fa fa-map-pin"></i>You are currently logged in from
                                <p>{{ @$location->cityName}}, {{ @$location->regionName}}</p><br>
                                
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/home') }}" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="ti-calendar"></i>
                                <p>{{ $today->toFormattedDateString() }}</p>
                            </a>
                        </li>
                        <li class="dropdown">

                              <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="position:relative; padding-left:50px;">
                                <img src="{{asset('/assets/img/students/'. Auth::user()->avatar )}}" style="width:32px; height:32px; position:absolute; top:10px; left:10px; border-radius:50%">
                                {{ Auth::user()->name }} <span class="caret"></span>
                              </a>
                              
                              <ul class="dropdown-menu">

                                <li><a href="{{ url('/profile') }}"><i class="fa fa-btn fa-user"></i>Profile</a></li>
                                <li><a href="{{ url('/courses') }}"><i class="fa fa-list-ul"></i>My Courses</a></li>
                                <!--<li><a href="{{ url('/currentreportcard') }}"><i class="fa fa-check-square-o"></i>Report card</a></li>-->
                                <li>
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                            <i class="fa fa-btn fa-sign-out"></i>Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>

                                
                                
                              </ul>
                        </li>
                        <!--
                        <li>
                            <a href="#">
                                <i class="ti-settings"></i>
                                <p>Settings</p>
                            </a>
                        </li>
                        -->
                    </ul>

                </div>
            </div>
        </nav>

        
        @yield('content')

        @include('layouts.includes.footer')
        

    </div>
</div>


</body>
   

    <!--   Core JS Files   -->
    <script src="{{asset('assets/js/jquery-1.10.2.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/bootstrap.min.js')}}" type="text/javascript"></script>

    <!--  Checkbox, Radio & Switch Plugins -->
    <script src="{{asset('assets/js/bootstrap-checkbox-radio.js')}}"></script>

    <!--  Charts Plugin -->
    <script src="{{asset('assets/js/chartist.min.js')}}"></script>

    <!--  Notifications Plugin    -->
    <script src="{{asset('assets/js/bootstrap-notify.js')}}"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>

     <!-- Paper Dashboard Core javascript and methods for Demo purpose -->
    <script src="{{asset('assets/js/paper-dashboard.js')}}"></script>
    
    <script type="text/javascript">
        $(document).ready(function(){

            demo.initChartist();

           
        });
    </script>

</html>
