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
                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> <stron>School Year</stron> </div>

                                                    <div class="profile-info-value">
                                                        <span class="editable" id="username"><strong>{{@$school_year->school_year}}</strong></span>
                                                    </div>
                                                </div>

                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> Student Name </div>

                                                    <div class="profile-info-value">
                                                        <i class="fa fa-user light-orange bigger-110"></i>
                                                        <span class="editable" id="username">{{@$student->first_name}} {{@$student->last_name}}</span>
                                                    </div>
                                                </div>

                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> Registration Code </div>

                                                    <div class="profile-info-value">
                                                        
                                                        <span class="editable" id="country">{{@$student->registration_code}}</span>
                                                    </div>
                                                </div>

                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> Gender </div>

                                                    <div class="profile-info-value">
                                                        <span class="editable" id="age">{{@$student->gender}}</span>
                                                    </div>
                                                </div>

                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> Date of Birth </div>

                                                    <div class="profile-info-value">
                                                        <span class="editable" id="signup">{{@$student->dob->toFormattedDateString()}}</span>
                                                    </div>
                                                </div>

                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> Status </div>

                                                    <div class="profile-info-value">
                                                        <span class="editable" id="login">{{@$student->status}}</span>
                                                    </div>
                                                </div>

                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> Nationality </div>

                                                    <div class="profile-info-value">
                                                        <span class="editable" id="about">{{@$student->nationality}}</span>
                                                    </div>
                                                </div>

                                                <div class="profile-info-row">
                                                    <div class="profile-info-name">National Card Number </div>

                                                    <div class="profile-info-value">
                                                        <span class="editable" id="login">{{@$student->national_card_number}}</span>
                                                    </div>
                                                </div>

                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> Passport Number </div>

                                                    <div class="profile-info-value">
                                                        <span class="editable" id="about">{{@$student->passport_number}}</span>
                                                    </div>
                                                </div>
                                                 <div class="profile-info-row">
                                                    <div class="profile-info-name"> Phone #</div>

                                                    <div class="profile-info-value">
                                                        <span class="editable" id="about">{{@$student->phone}}</span>
                                                    </div>
                                                </div>

                                                <div class="profile-info-row">
                                                    <div class="profile-info-name">State </div>

                                                    <div class="profile-info-value">
                                                        <span class="editable" id="login">{{@$student->state}}</span>
                                                    </div>
                                                </div>

                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> Current Address </div>
                                                    <div class="profile-info-value">
                                                    <i class="fa fa-map-marker light-orange bigger-110"></i>
                                                        <span class="editable" id="about">{{@$student->current_address}}</span>
                                                    </div>
                                                </div>
                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> Date Enrolled</div>

                                                    <div class="profile-info-value">
                                                        <span class="editable" id="about">{{@$student->date_enrolled}}</span>
                                                    </div>
                                                </div>

                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> Curent Class </div>

                                                    <div class="profile-info-value">
                                                        <span class="editable" id="login">{{@$student->group_id}}</span>
                                                    </div>
                                                </div>

                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> Created </div>

                                                    <div class="profile-info-value">
                                                        <span class="editable" id="about">{{@$student->created_at->toFormattedDateString()}}</span>
                                                    </div>
                                                </div>
                                                <div class="profile-info-row">
                                                    <div class="profile-info-name">Updated </div>

                                                    <div class="profile-info-value">
                                                        <span class="editable" id="about">{{@$student->updated_at->toFormattedDateString()}}</span>
                                                    </div>
                                                </div>
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



    