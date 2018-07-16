                
                <div id="sidebar" class="sidebar responsive ace-save-state">
                <script type="text/javascript">
                    try{ace.settings.loadState('sidebar')}catch(e){}
                </script>

               

                <ul class="nav nav-list">

                    

                    <li {{{ (Request::is('schoolsetup') ? 'class=active' : '') }}}>
                        <a href="{{ url('/schoolsetup') }}">
                            <i class="menu-icon fa fa-tachometer"></i>
                            <span class="menu-text">SuperAdmin Area</span>
                        </a>

                        <b class="arrow"></b>
                    </li>

                    <li {{{ (Request::is('schoolsetup/schools/showschools') ? 'class=active' : '') }}}>
                        <a href="{{ url('/schoolsetup/schools/showschools') }}">
                            <i class="menu-icon fa fa-home"></i>
                            <span class="menu-text">Your School</span>
                        </a>

                        <b class="arrow"></b>
                    </li>

                    <li {{{ (Request::is('schoolsetup/showschoolyear') ? 'class=active' : '') }}}>
                        <a href="{{ url('/schoolsetup/showschoolyear') }}">
                            <i class="menu-icon fa fa-list"></i>
                            <span class="menu-text">Step 1: School Year</span>
                        </a>

                        <b class="arrow"></b>
                    </li>

                    <li {{{ (Request::is('schoolsetup/terms/schoolyears') ? 'class=active' : '') }}}>
                        <a href="{{ url('/schoolsetup/terms/schoolyears') }}">
                            <i class="menu-icon fa fa-text-width"></i>
                            <span class="menu-text">Step 2: Terms</span>
                        </a>

                        <b class="arrow"></b>
                    </li>
                   
                   <li {{{ (Request::is('schoolsetup/showgroups') ? 'class=active' : '') }}}>
                        <a href="{{ url('/schoolsetup/showgroups') }}">
                            <i class="menu-icon fa fa-object-group"></i>
                            <span class="menu-text">Step 3: Groups</span>
                        </a>

                        <b class="arrow"></b>
                    </li>

      
                    <li {{{ (Request::is('schoolsetup/courses/schoolyears') ? 'class=active' : '') }}}>
                        <a href="{{ url('/schoolsetup/courses/schoolyears') }}">
                            <i class="menu-icon fa fa-book"></i>
                            <span class="menu-text"> Step 4: Courses </span>
                        </a>

                        <b class="arrow"></b>
                    </li>

                    <li {{{ (Request::is('schoolsetup/students/showgroups') ? 'class=active' : '') }}}>
                        <a href="{{ url('/schoolsetup/students/showgroups') }}">
                            <i class="menu-icon fa fa-users"></i>
                            <span class="menu-text"> Step 5 Students </span>
                        </a>

                        <b class="arrow"></b>
                    </li>

                    <li {{{ (Request::is('schoolsetup/staffers/showstaffers') ? 'class=active' : '') }}}>
                        <a href="{{ url('/schoolsetup/staffers/showstaffers') }}">
                            <i class="menu-icon fa fa-user-plus"></i>
                            <span class="menu-text"> Step 6: Teachers </span>
                        </a>

                        <b class="arrow"></b>
                    </li>

                     <li>
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-money"></i>
                            <span class="menu-text"> Step 8: Fees </span>

                            <b class="arrow fa fa-angle-down"></b>
                        </a>

                        <b class="arrow"></b>

                        <ul class="submenu">
                            <li >
                                <a href="{{ url('/schoolsetup/feetypes/showfeetypes') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Add/Edit Fee types
                                </a>

                                <b class="arrow"></b>
                            </li>
                            <li >
                                <a href="{{ url('/schoolsetup/fees/showfees') }}">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Add/Edit Fees
                                </a>

                                <b class="arrow"></b>
                            </li>
                            
                        </ul>
                    </li>

                    <li {{{ (Request::is('schoolsetup/attendancecodes/showcodes') ? 'class=active' : '') }}}>
                        <a href="{{ url('/schoolsetup/attendancecodes/showcodes') }}">
                            <i class="menu-icon fa fa-calendar-check-o"></i>
                            <span class="menu-text"> Attendance Code</span>
                        </a>

                        <b class="arrow"></b>
                    </li>

                    <li {{{ (Request::is('schoolsetup/messages/contactus') ? 'class=active' : '') }}}>
                        <a href="{{url('/schoolsetup/messages/contactus')}}">
                            <i class="menu-icon fa fa-envelope"></i>
                            <span class="menu-text">Contact Messages</span>
                        </a>

                        <b class="arrow"></b>
                    </li>

                    <li {{{ (Request::is('admin_home') ? 'class=active' : '') }}}>
                        <a href="{{url('/admin_home')}}">
                            <i class="menu-icon fa fa-desktop"></i>
                            <span class="menu-text"> Staff Dashbord</span>
                        </a>

                        <b class="arrow"></b>
                    </li>

                    <li {{{ (Request::is('schoolsetup/logs/studentsloginactivities') ? 'class=active' : '') }}}>
                        <a href="{{url('/schoolsetup/logs/studentsloginactivities')}}">
                            <i class="menu-icon fa fa-history"></i>
                            <span class="menu-text"> Log-Students</span>
                        </a>

                        <b class="arrow"></b>
                    </li>

                    <li {{{ (Request::is('schoolsetup/logs/adminsloginactivities') ? 'class=active' : '') }}}>
                        <a href="{{url('/schoolsetup/logs/adminsloginactivities')}}">
                            <i class="menu-icon fa fa-history"></i>
                            <span class="menu-text"> Log-Admins</span>
                        </a>

                        <b class="arrow"></b>
                    </li>

                    <li>
                        <a href="#{{ route('logout') }}"
                            onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                            <i class="menu-icon fa fa-power-off"></i>
                                            <span class="menu-text">Logout</span>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                    </form>
                    </li>


                   

                </ul><!-- /.nav-list -->

                <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
                    <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
                </div>
            </div>