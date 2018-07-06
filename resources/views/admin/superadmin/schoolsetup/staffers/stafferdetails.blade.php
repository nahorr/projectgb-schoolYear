@extends('admin.superadmin.dashboard')

@section('content')

<div class="main-content">
                <div class="main-content-inner">
                    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                        <ul class="breadcrumb">
                            <li>
                                <i class="ace-icon fa fa-user fa-3x"></i>
                                <a href="#"><h3>{{$staffer->first_name}} {{$staffer->last_name}}</h3></a>
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
                                                @foreach($admin_users as $admin_user)
                                                    @if($admin_user->registration_code == $staffer->registration_code )
                                                        <img id="avatar" class="editable img-responsive" alt="schoo{{$staffer->name}}" 
                                                        src="{{asset('/assets/img/staffers/'.$admin_user->avatar) }}"/>
                                                    @endif
                                                @endforeach
                                                </span>

                                                <div class="space-4"></div>

                                                <div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
                                                    <div class="inline position-relative">
                                                       
                                                            <i class="ace-icon fa fa-user light-green"></i>
                                                            &nbsp;
                                                            <span class="white">{{$staffer->first_name}} {{$staffer->last_name}}</span>
                                                        

                                                       
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="space-6"></div>                                          
                                           
                                        </div>

                                        <div class="col-xs-12 col-sm-6">
                                            <div class="center">

                                            <div class="profile-user-info profile-user-info-striped">
                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> Full Name </div>

                                                    <div class="profile-info-value">
                                                        <i class="fa fa-user light-orange bigger-110"></i>
                                                        <span class="editable" id="username"><strong>{{$staffer->title}} {{$staffer->first_name}} {{$staffer->last_name}}</strong></span>
                                                    </div>
                                                </div>

                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> Staffer # </div>

                                                    <div class="profile-info-value">
                                                        <span class="editable" id="username">{{$staffer->staffer_number}}</span>
                                                    </div>
                                                </div>

                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> Registration Code </div>

                                                    <div class="profile-info-value">
                                                        
                                                        <span class="editable" id="country">{{$staffer->registration_code}}</span>
                                                    </div>
                                                </div>

                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> Gender </div>

                                                    <div class="profile-info-value">
                                                        <span class="editable" id="age">{{$staffer->gender}}</span>
                                                    </div>
                                                </div>

                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> Employment Status </div>

                                                    <div class="profile-info-value">
                                                        <span class="editable" id="signup">{{$staffer->employment_status}}</span>
                                                    </div>
                                                </div>


                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> Date of Employment </div>

                                                    <div class="profile-info-value">
                                                        <span class="editable" id="about">{{$staffer->date_of_employment}}</span>
                                                    </div>
                                                </div>

                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> Nationality </div>

                                                    <div class="profile-info-value">
                                                        <span class="editable" id="login">{{$staffer->nationality}}</span>
                                                    </div>
                                                </div>

                                                <div class="profile-info-row">
                                                    <div class="profile-info-name">     national_card_number </div>

                                                    <div class="profile-info-value">
                                                        <span class="editable" id="about">{{$staffer->national_card_number}}</span>
                                                    </div>
                                                </div>
                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> Passport # </div>

                                                    <div class="profile-info-value">
                                                        <span class="editable" id="login">{{$staffer->passport_number}}</span>
                                                    </div>
                                                </div>

                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> Pone # </div>

                                                    <div class="profile-info-value">
                                                        <span class="editable" id="login">{{$staffer->phone}}</span>
                                                    </div>
                                                </div>

                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> Email </div>

                                                    <div class="profile-info-value">
                                                        <span class="editable" id="login">{{$staffer->email}}</span>
                                                    </div>
                                                </div>

                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> State </div>

                                                    <div class="profile-info-value">
                                                        <span class="editable" id="about">{{$staffer->state}}</span>
                                                    </div>
                                                </div>

                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> Current Address </div>

                                                    <div class="profile-info-value">
                                                        <span class="editable" id="about">{{$staffer->current_address}}</span>
                                                    </div>
                                                </div>

                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> Date Created </div>

                                                    <div class="profile-info-value">
                                                        <span class="editable" id="about">{{$staffer->created_at}}</span>
                                                    </div>
                                                </div>

                                                <div class="profile-info-row">
                                                    <div class="profile-info-name"> Date Updated </div>

                                                    <div class="profile-info-value">
                                                        <span class="editable" id="about">{{$staffer->updated_at}}</span>
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
    </div>


@endsection
