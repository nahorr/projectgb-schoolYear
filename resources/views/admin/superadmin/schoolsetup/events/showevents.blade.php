@extends('admin.superadmin.dashboard')

@section('content')


                        <div class="page-header">
                            <h1>
                               Step 8: Add/Edit event
                               <hr>
                                @include('flash::message')
                                                                
                            </h1>
                        </div><!-- /.page-header -->

                        <div class="row">
                            <div class="col-sm-8">
                                <div class="widget-box">
                                    <div class="widget-header">
                                        <h4 class="widget-title">Showing events for {{ $schoolyear->school_year}} school year </h4>
                                        <span class="widget-toolbar">
                                            <strong><a href="{{asset('/schoolsetup/events/addevent')}}">
                                                <i class="ace-icon fa fa-pencil-square-o fa-2x"></i>
                                                Add event
                                            </a></strong>
                                        </span>
                                    </div>

                                    <div class="widget-body">
                                        <div class="widget-main">

                                           <table class="table table-striped table-bordered">
                                                <thead>
                                                    <th>Type</th>
                                                    <th>Details</th>
                                                    <th>Group</th>
                                                    <th>Term</th>
                                                    <th>Start Date</th>
                                                    <th>End Date</th>
                                                    <th>Edit</th>
                                                    <th>Delete</th>
                                                    
                                                </thead>
                                                <tbody>
                                                    @foreach ($events_join as $key=>$event)

                                                    <tr>
                                                        
                                                        <td>{{ $event->event_type}}</td>
                                                        <td>{{ $event->description}}</td>
                                                        <td>{{ $event->name}}</td>
                                                        <td>{{ $event->term}}</td>
                                                        <td>{{ $event->start_date->toFormattedDateString()}}</td>
                                                        <td>{{ $event->end_date->toFormattedDateString()}}</td>
                                                        <td><strong><a href="{{asset('/schoolsetup/events/editevent/'.$event->id) }}/{{$event->group_id}}/{{$event->term_id}}/{{$event->eventtype_id}}"><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i></a></strong>
                                                        </td>
                                                        <td><strong><a href="{{asset('/schoolsetup/events/posteventdelete/'.$event->id) }}" onclick="return confirm('Are you sure you want to Delete this record?')"><i class="danger fa fa-trash-o fa-2x" aria-hidden="true" style="color:red"></i></a></strong>
                                                        </td>
                                                       
                                                    </tr>
                                                 @endforeach
                                                    
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>


                <div class="hr hr-18 dotted hr-double"></div>
                <br>

                <div class="alert-danger">
                    
                        <ul>
                            @foreach($errors->all() as $error)

                                <li> {{ $error }}</li>

                            @endforeach

                        </ul>

                </div>


@endsection
