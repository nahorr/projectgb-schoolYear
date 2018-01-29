@extends('admin.superadmin.dashboard')

@section('content')
    <div class="main-content">
                <div class="main-content-inner">
                    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                        <ul class="breadcrumb">
                            <li>
                                <i class="ace-icon fa fa-home fa-3x"></i>
                                <a href="#"><h3>{{@$school->name}}</h3></a>
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
                                <h3 class="header smaller lighter blue">You are viewing message #  {{@$message->id}} <div class="pull-right"> <a href="{{url('/schoolsetup/messages/contactus')}}"> Back to Messages</a></div></h3>
                                <!--message content starts-->
                                    <div class="message-header clearfix">
                                        <div class="pull-left">

                                            <div class="space-4"></div>

                                            <i class="ace-icon fa fa-star orange2"></i>

                                            &nbsp;
                                            From
                                            &nbsp;
                                            <a href="#" class="sender">{{@$message->first_name}} {{@$message->last_name}}({{@$message->email}})</a>


                                            &nbsp;
                                            <i class="ace-icon fa fa-phone bigger-110 orange middle"></i>
                                            <span class="time grey">{{@$message->phone}}</span>

                                            &nbsp;
                                            <i class="ace-icon fa fa-clock-o bigger-110 orange middle"></i>
                                            <span class="time grey">{{@$message->created_at->toDayDateTimeString()}}</span>

                                        </div>

                                        <div class="pull-right action-buttons">
                                            <a href="{{url('/schoolsetup/messages/contactus')}}">
                                                <i class="ace-icon fa fa-reply green icon-only bigger-130"></i>
                                            </a>

                                            <a href="#">
                                                <i class="ace-icon fa fa-trash-o red icon-only bigger-130"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="hr hr-double"></div>

                                    <div class="message-body">
                                        <p>
                                            {{@$message->message}}
                                        </p>
                                    </div>

                                    <div class="hr hr-double"></div>

                            </div>
                        </div>
                    </div>


                       
                     
            </div><!-- /.page-content -->
        </div><!-- /.row -->
    </div><!-- /.main-content -->

@endsection
