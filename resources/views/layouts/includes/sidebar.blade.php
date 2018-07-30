    <div class="sidebar" data-background-color="white" data-active-color="danger">

    <!--
        Tip 1: you can change the color of the sidebar's background using: data-background-color="white | black"
        Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
    -->

        <div class="sidebar-wrapper">
            <div class="logo">
                <a href="https://socidy.com/" class="simple-text">
                    <img src="{{asset('/assets/img/logo/logo.jpg')}}" style="width: 120px; height: 120px; border-radius: 50%; margin-right: 25px;">
                </a>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6  col-md-offset-3">
                  <button type="button" class="btn btn-info" id="selectYearModal">Select School Year</button>
                </div>
                  @include('selectYearModal')

                  <script type="text/javascript">
                    $('#selectYearModal').on('click', function(){
                      $('#yearSelectionModal').modal('show');
                    })
                  </script>

            </div>


            <ul class="nav">
                <!--
                <li {{{ (Request::is('home') ? 'class=active' : '') }}}>
                    <a href="{{ url('/home') }}">
                        <i class="fa fa-university"></i>
                        <p>School Years</p>
                    </a>
                </li>
                -->
                <li {{{ (Request::is('home/*') ? 'class=active' : '') }}}>
                    <a href="{{ url('/home/'.$schoolyear->id) }}">
                        <i class="ti-dashboard"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li {{{ (Request::is('profile/*') ? 'class=active' : '') }}}>
                    <a href="{{ url('/profile/'.$schoolyear->id) }}">
                        <i class="ti-user"></i>
                        <p>Student Profile</p>
                    </a>
                </li>

                
                <li {{{ (Request::is('currentcourses/*') ? 'class=active' : '') }}}>
                    <a href="{{ url('/currentcourses/'.$schoolyear->id) }}">
                        <i class="ti-view-list-alt"></i>
                        <p>Current Courses</p>
                    </a>
                </li>

                <li {{{ (Request::is('reportcards/*') ? 'class=active' : '') }}}>
                    <a href="{{ url('/reportcards/'.$schoolyear->id) }}">
                        <i class="ti-check-box"></i>
                        <p>Report Cards</p>
                    </a>
                </li>

                <li {{{ (Request::is('attendances/*') ? 'class=active' : '') }}}>
                    <a href="{{ url('/attendances/'.$schoolyear->id) }}">
                        <i class="ti-calendar"></i>
                        <p>Attendance Record</p>
                    </a>
                </li>
                <!--
                 <li {{{ (Request::is('dailyactivity/activities') ? 'class=active' : '') }}}>
                    <a href="{{ url('/dailyactivity/activities') }}">
                        <i class="fa fa-cubes"></i>
                        <p>Daily Activities</p>
                    </a>
                </li>

                <li {{{ (Request::is('discipline/records') ? 'class=active' : '') }}}>
                    <a href="{{ url('/discipline/records') }}">
                        <i class="fa fa-balance-scale"></i>
                        <p>Disciplinary Records</p>
                    </a>
                </li>
                -->
                <li {{{ (Request::is('messages/messagetoteacher/*') ? 'class=active' : '') }}}>
                    <a href="{{ url('/messages/messagetoteacher/'.$schoolyear->id) }}">
                        <i class="fa fa-envelope"></i>
                        <p>Messages</p>
                    </a>
                </li>
               
                     <li>
                    <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                            <i class="ti-power-off"></i><p>Logout</p>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                    </form>
                </li>
                
                
            </ul>


        </div>
    </div>
    