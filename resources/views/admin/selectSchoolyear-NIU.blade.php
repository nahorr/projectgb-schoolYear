<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/img/apple-icon.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('assets/img/favicon.png')}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Totalgrades -Admin Dashboard</title>

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

    

    

</head>
<body>

<div class="wrapper">



    <div class="main-panel" style="float: none; width: calc(100%);">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar bar1"></span>
                        <span class="icon-bar bar2"></span>
                        <span class="icon-bar bar3"></span>
                    </button>
                    <a class="navbar-brand" href="{{ url('/admin_home') }}">Admin Dashboard</a>&nbsp;&nbsp;&nbsp;
                    
                                           
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        @if(Auth::guard('web_admin')->user()->is_super_admin)
                        <li>
                            <a href="{{ url('/schoolsetup') }}">
                                <i class="ti-settings"></i>
                                <p>School Setup</p>
                            </a>
                        </li>
                        @endif
                        @if(Auth::guard('web_admin')->user()->is_head_admin)
                        <li>
                            <a href="{{ url('/headadmin/home') }}">
                                <i class="ti-settings"></i>
                                <p>Head Admin Home</p>
                            </a>
                        </li>
                        @endif
                        <li>
                            <a href="{{ url('/admin_home') }}" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="ti-calendar"></i>
                                <p>{{ $today->toFormattedDateString() }}</p>
                            </a>
                        </li>
                        <li class="dropdown">

                              <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="position:relative; padding-left:50px;">
                                <img src="{{asset('/assets/img/staffers/'. Auth::guard('web_admin')->user()->avatar) }}" style="width:32px; height:32px; position:absolute; top:10px; left:10px; border-radius:50%">
                                {{ Auth::guard('web_admin')->user()->name }} <span class="caret"></span>
                              </a>
                              
                              <ul class="dropdown-menu">

                                <li><a href="{{ url('/admin/profile') }}"><i class="fa fa-btn fa-user"></i>Profile</a></li>
                                <li><a href="{{ url('/admincourses') }}"><i class="fa fa-list-ul"></i>My Courses</a></li>
                                <li><a href="{{ url('/admin/reportcards/terms') }}"><i class="fa fa-check-square-o"></i>Report card</a></li>
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

        <div class="content">

        
           
           
              <div class="row" style="margin-left: 25%; margin-right: 25%;">

               
                @foreach($school_years as $schoolyear)
                <div class="col-lg-6 col-sm-6">
                  <a href="{{ url('/admin_home/'.$schoolyear->id)}}">
                    <div class="card">
                        <div class="content">
                            <div class="row">
                                <div class="col-xs-5">
                                  @if( $schoolyear->id == $current_school_year->id)
                                    <div class="icon-big icon-success text-center">
                                        <i class="fa fa-university" aria-hidden="true"></i>
                                    </div>
                                    @else
                                    <div class="icon-big icon-warning text-center">
                                        <i class="fa fa-university" aria-hidden="true"></i>
                                    </div>
                                    @endif
                                </div>
                                <div class="col-xs-7">
                                    <div class="numbers">
                                      @if( $schoolyear->id == $current_school_year->id)
                                        <p class="text-success">Current School Year</p>
                                        <p class="text-success">{{$schoolyear->school_year}}</p>
                                        @else
                                        <p>School Year</p>
                                        <p>{{$schoolyear->school_year}}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="footer">
                                <hr />
                                <div class="stats">
                                  @if( $schoolyear->id == $current_school_year->id)
                                    
                                    <span class="text-success"> <i class="ti-calendar icon-success"></i> Start Date: {{$schoolyear->start_date->toFormatteddateString()}} <i class="ti-calendar icon-success"></i> End Date: {{$schoolyear->end_date->toFormatteddateString()}}</span>
                                  @else
                                  <span> <i class="ti-calendar icon-warning"></i> Start Date: {{$schoolyear->start_date->toFormatteddateString()}} <i class="ti-calendar icon-warning"></i> End Date: {{$schoolyear->end_date->toFormatteddateString()}}</span>
                                  @endif
                                </div>
                            </div>
                        </div>
                    </div>
                  </a>
                </div>
             @endforeach 

              </div>
            


            </div>

         
                 


        @include('admin.includes.footer')

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

</html>
