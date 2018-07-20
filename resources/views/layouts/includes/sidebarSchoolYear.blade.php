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
            <div class="col-md-8 col-md-offset-2">
                <select name="school_year_id" id="dynamic_select_schoolyear">
                <option selected disabled>Select School Year</option>
                      @foreach($school_years as $key => $school_year)
                            <option value="{{ $school_year->id }}" >
                                <a href="{{ url('/home/'.$school_year->id) }}">{{ $school_year->school_year }}</a>
                            </option>

                      @endforeach
                </select>
               
            </div>
            
            <br>

            @foreach($school_years as $school_year)

            @if($school_year->id == $current_school_year->id)
            <ul class="nav">
                
                <li {{{ (Request::is('home') ? 'class=active' : '') }}}>
                    <a href="{{ url('/home/'.$school_year->id) }}">
                        <i class="ti-dashboard"></i>
                        <p>Term Dashboard</p>
                    </a>
                </li>

                <li {{{ (Request::is('profile') ? 'class=active' : '') }}}>
                    <a href="{{ url('/profile/'.$school_year->id) }}">
                        <i class="ti-user"></i>
                        <p>Student Profile</p>
                    </a>
                </li>

                
                <li {{{ (Request::is('courses') ? 'class=active' : '') }}}>
                    <a href="{{ url('/courses/'.$school_year->id) }}">
                        <i class="ti-view-list-alt"></i>
                        <p>Current Courses</p>
                    </a>
                </li>

                <li {{{ (Request::is('reportcards') ? 'class=active' : '') }}}>
                    <a href="{{ url('/reportcards/'.$school_year->id) }}">
                        <i class="ti-check-box"></i>
                        <p>Report Cards</p>
                    </a>
                </li>

                <li {{{ (Request::is('attendances/terms') ? 'class=active' : '') }}}>
                    <a href="{{ url('/attendances/terms') }}">
                        <i class="ti-calendar"></i>
                        <p>Attendance Record</p>
                    </a>
                </li>

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

                <li {{{ (Request::is('messages/messagetoteacher') ? 'class=active' : '') }}}>
                    <a href="{{ url('/messages/messagetoteacher') }}">
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
            @endif
            @endforeach
            <script>
                $(function(){
                  // bind change event to select
                  $('#dynamic_select_schoolyear').on('change', function () {
                      var url = $(this).val(); // get selected value
                      if (url) { // require a URL
                          window.location = url; // redirect
                      }
                      return false;
                  });
                });
            </script>
        </div>
    </div>
    