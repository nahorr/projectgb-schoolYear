@extends('admin.headadmin.dashboard')

@section('content')

            <div class="main-content">
                <div class="main-content-inner">
                    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                        <ul class="breadcrumb">
                            <li>
                                <i class="ace-icon fa fa-user fa-3x"></i>
                                <a href="#"><h3>{{@$student->first_name}} {{@$student->last_name}}</h3></a>
                            </li>

                        </ul><!-- /.breadcrumb -->

                        <div class="pull-right">
                            <ul class="breadcrumb">
                                <li>
                                    <i class="ace-icon fa fa-calendar fa-3x"></i>&nbsp;
                                    <a href="#"><h3>{{$today->toFormattedDateString()}}</h3></a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="page-content">
                    			
                       <div class="row">
                            <div class="col-xs-12">
                                <!-- PAGE CONTENT BEGINS -->
                              
                                <div>
                                    <div id="user-profile-1" class="user-profile row">
                                        <div class="col-xs-12 col-sm-3 center">
                                            <div>
                                                <span class="profile-picture">
                                                @foreach($all_users as $user)
                                                    @if(@$student->registration_code == @$user->registration_code)
                                                    <img id="avatar" class="editable img-responsive" alt="{{@$school->name}} logo" src="{{asset('/assets/img/students/'.@$user->avatar)}}" />
                                                    @endif
                                                @endforeach
                                                </span>

                                            </div>
                                            <div class="width-80 label label-info label-xlg">
                                                    <div class="inline position-relative">
                                                       <a href="{{asset('/headadmin/students/showstudent/'.$student->id) }}/terms" class="text-center">
                                                            <i class="ace-icon fa fa-pie-chart light-green"></i>
                                                            &nbsp;
                                                            <span class="white">View Grades & report Cards</span>
                                                        </a>
                                                    </div>
                                            </div>

                                            <div class="space-4"></div>
                                            <div class="width-80 label label-success label-xlg">
                                                    <div class="inline position-relative">
                                                       <a href="#" class="text-center">
                                                            <i class="ace-icon fa fa-calendar white"></i>
                                                            &nbsp;
                                                            <span class="white">View Attendance Records</span>
                                                       </a>
                                                    </div>
                                            </div>

                                            <div class="space-4"></div>

                                            <div class="width-80 label label-warning label-xlg">
                                                    <div class="inline position-relative">
                                                       <a href="#" class="text-center">
                                                            <i class="ace-icon fa fa-bar-chart light-green"></i>
                                                            &nbsp;
                                                            <span class="white">View/Add Incident Reports</span>
                                                        </a>
                                                    </div>
                                            </div>
                                           
                                        </div>

                                        <div class="col-xs-12 col-sm-5">
                                            <div class="center">

                                            <div class="profile-user-info profile-user-info-striped">
                                            @foreach($terms as $key => $term)
                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> <stron>{{$term->term}}</stron> </div>

                                                    <div class="profile-info-value">
                                                    <a href="{{asset('/headadmin/students/'.$student->id) }}/terms/{{$term->id}}/courses" class="text-center">
                                                    
                                                    @if( @$courses->where('term_id', '=', $term->id)->where('group_id', '=', $student->group_id)->count() !=null )
                                                        <span class="editable" id="username"><strong>Courses ({{@$courses->where('term_id', '=', $term->id)->where('group_id', '=', $student->group_id)->count()}}) </strong></span>

                                                        @else
                                                        <span class="editable" id="username"><strong>Courses (0)</strong></span>
                                                    @endif
                                                    </a>
                                                    </div>
                                                     
                                                </div>
                                            @endforeach
                                                

                                            </div>
                                            

                                            <div class="space-20"></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            		</div><!-- /.page-content -->
        		</div><!-- /.row -->
    		</div><!-- /.main-content -->
     


@endsection



    