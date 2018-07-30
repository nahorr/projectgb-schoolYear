    <div class="sidebar" data-background-color="white" data-active-color="danger">

    <!--
        Tip 1: you can change the color of the sidebar's background using: data-background-color="white | black"
        Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
    -->

        <div class="sidebar-wrapper">
            <div class="logo">
                <a href="{{url('admin_home')}}" class="simple-text">
                    <img src="{{asset('/assets/img/logo/logo.jpg')}}" style="width: 120px; height: 120px; border-radius: 50%; margin-right: 25px;">
                </a>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6  col-md-offset-3">
                  <button type="button" class="btn btn-info" id="selectTermModal">Select Term</button>
                </div>
                  @include('admin.selectTermModal')

                  <script type="text/javascript">
                    $('#selectTermModal').on('click', function(){
                      $('#termSelectionModal').modal('show');
                    })
                  </script>

            </div>

            @if($schoolyear->id == $current_school_year->id && $term->id == $current_term->id)
            

                <ul class="nav">
        
                    <!--
                    <li {{{ (Request::is('admin_home') ? 'class=active' : '') }}}>
                        <a href="{{ url('/admin_home') }}">
                            <i class="ti-panel"></i>
                            <p>Select Term</p>
                        </a>
                    </li>
                    -->
                    <li {{{ (Request::is('admin_home/*') ? 'class=active' : '') }}}>
                        <a href="{{ url('/admin_home/'.$schoolyear->id) }}/{{$term->id}}">
                            <i class="ti-dashboard"></i>
                            <p>Term Dashboard</p>
                        </a>
                    </li>
     
                    <li {{{ (Request::is('admin/profile/*') ? 'class=active' : '') }}} >
                        <a href="{{ url('/admin/profile/'.$schoolyear->id) }}/{{$term->id}}">
                            <i class="ti-user"></i>
                            <p>Profile</p>
                        </a>
                    </li>


                    <li {{{ (Request::is('attendances/showstudents/*') ? 'class=active' : '') }}}>
                        <a href="{{ url('/attendances/showstudents/'.$schoolyear->id) }}/{{$term->id}}">
                            <i class="fa fa-calendar-check-o"></i>
                            <p>Attendance</p>
                        </a>
                    </li>

                    <li {{{ (Request::is('admincourses/*') ? 'class=active' : '') }}}>
                        <a href="{{ url('/admincourses/'.$schoolyear->id) }}/{{$term->id}}">
                            <i class="fa fa-font"></i>
                            <p>Enter Grades</p>
                        </a>
                    </li>

                    <li {{{ (Request::is('admin/reportcards/students/*') ? 'class=active' : '') }}}>
                        <a href="{{ url('/admin/reportcards/students/'.$schoolyear->id) }}/{{$term->id}}">
                            <i class="fa fa-print"></i>
                            <p>Report Cards</p>
                        </a>
                    </li>

                    <li {{{ (Request::is('admin/observationsonconduct/*') ? 'class=active' : '') }}}>
                        <a href="{{ url('/admin/observationsonconduct/'.$schoolyear->id) }}/{{ $term->id }}">
                            <i class="ti-check-box"></i>
                            <p>Observations</p>
                        </a>
                    </li>

            
                    <li {{{ (Request::is('healthrecords/showstudents/*') ? 'class=active' : '') }}}>
                        <a href="{{ url('/healthrecords/showstudents/'.$schoolyear->id) }}/{{ $term->id}}">
                            <i class="fa fa-medkit"></i>
                            <p>Health Records</p>
                        </a>
                    </li>
                    
                    <!--
                    <li {{{ (Request::is('groupevents/showgroupevents') ? 'class=active' : '') }}}>
                        <a href="{{ url('/groupevents/showgroupevents') }}">
                            <i class="fa fa-calendar-plus-o"></i>
                            <p>Group Events</p>
                        </a>
                    </li>

                    <li {{{ (Request::is('students/activities/showstudentsactivitytypes') ? 'class=active' : '') }}}>
                        <a href="{{ url('/students/activities/showstudentsactivitytypes') }}">
                            <i class="fa fa-cog fa-spin fa-3x fa-fw"></i>
                            <span class="sr-only">Loading...</span>

                            <p>Activities - Students</p>
                        </a>
                    </li>
                    -->

                    <li {{{ (Request::is('admin/banstudents/*') ? 'class=active' : '') }}}>
                        <a href="{{ url('/admin/banstudents/'.$schoolyear->id) }}/{{ $term->id}}">
                            <i class="fa fa-users"></i>
                            <p>Ban Students</p>
                        </a>
                    </li>

                    <li {{{ (Request::is('students/messages/allstudents/*') ? 'class=active' : '') }}}>
                        <a href="{{ url('/students/messages/allstudents/'.$schoolyear->id) }}/{{ $term->id}}">
                            <i class="fa fa-envelope"></i>
                            <p>Messages</p>
                        </a>
                    </li>

                    <!-- <li {{{ (Request::is('admin/stats/showstatstypes') ? 'class=active' : '') }}}>
                        <a href="{{ url('/admin/stats/showstatstypes') }}">
                            <i class="fa fa-line-chart"></i>
                            <p>Statistics</p>
                        </a>
                    </li>

     -->
                    
                    <li >
                        <a href="#{{ route('logout') }}"
                                onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                                <i class="ti-power-off"></i><p>Logout</p>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                        </form>
                    </li>
                    
                    
                </ul>
            @else

               <ul class="nav">
       

                   <li {{{ (Request::is('admin_home/*') ? 'class=active' : '') }}}>
                       <a href="{{ url('/admin_home/'.$schoolyear->id) }}/{{$term->id}}">
                           <i class="ti-dashboard"></i>
                           <p>Term Dashboard</p>
                       </a>
                   </li>
    
                   <li {{{ (Request::is('admin/profile/*') ? 'class=active' : '') }}} >
                       <a href="{{ url('/admin/profile/'.$schoolyear->id) }}/{{$term->id}}">
                           <i class="ti-user"></i>
                           <p>Profile</p>
                       </a>
                   </li>


                   <li {{{ (Request::is('admincourses/*') ? 'class=active' : '') }}}>
                       <a href="{{ url('/admincourses/'.$schoolyear->id) }}/{{$term->id}}">
                           <i class="fa fa-font"></i>
                           <p>Past Courses</p>
                       </a>
                   </li>

                   <li {{{ (Request::is('admin/reportcards/students/*') ? 'class=active' : '') }}}>
                       <a href="{{ url('/admin/reportcards/students/'.$schoolyear->id) }}/{{$term->id}}">
                           <i class="fa fa-print"></i>
                           <p>Report Cards</p>
                       </a>
                   </li>

                                   
                   <li >
                       <a href="#{{ route('logout') }}"
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
        </div>
    </div>
