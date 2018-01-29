                
                <div id="sidebar" class="sidebar responsive ace-save-state">
                <script type="text/javascript">
                    try{ace.settings.loadState('sidebar')}catch(e){}
                </script>

               

                <ul class="nav nav-list">

                    <li {{{ (Request::is('headadmin/home') ? 'class=active' : '') }}}>
                        <a href="{{ url('/headadmin/home') }}">
                            <i class="menu-icon fa fa-tachometer"></i>
                            <span class="menu-text">Head Admin Area</span>
                        </a>

                        <b class="arrow"></b>
                    </li>

                    <li {{{ (Request::is('headadmin/students/showstudents') ? 'class=active' : '') }}}>
                        <a href="{{ url('/headadmin/students/showstudents') }}">
                            <i class="menu-icon fa fa-users"></i>
                            <span class="menu-text">Students</span>
                        </a>

                        <b class="arrow"></b>
                    </li>

                    <li {{{ (Request::is('headadmin/teachers/teachers') ? 'class=active' : '') }}}>
                        <a href="{{ url('/headadmin/students/students') }}">
                            <i class="menu-icon fa fa-user-plus"></i>
                            <span class="menu-text">Teachers</span>
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