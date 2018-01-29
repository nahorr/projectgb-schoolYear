@extends('layouts.dashboard')

@section('content')

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                     @include('layouts.includes.headdashboardtop')
                </div>
                <div class="row">
                 <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Today's Attendance Record </h4>
                                <p class="category"> </p>
                                <div class="stats">
                                    <i class="fa fa-calendar-check-o" aria-hidden="true"></i> Today's date : {{$today->toFormattedDateString()}}
                                </div>
                            </div>
                            <div class="content">

                                @if($attendance_today === null)

                                   <div class="alert alert-info">
                                      
                                      <p>You have no attendance record yet!</p>
                                    </div>
                           

                                @elseif($attendance_today->code_name === 'Present')

                                    <div class="alert alert-success">
                                      <p><strong>Welldone {{$student->first_name}}! </p>
                                      <br>
                                      <p><strong>Keep it up! </strong> </p>
                                      <br>
                                      <p>Your are {{$attendance_today->code_name}} today. You were also on time!</p>
                                    </div>

                                @elseif($attendance_today->code_name === 'Late')
                                    <div class="alert alert-warning">
                                      <p><strong>Good Job {{$student->first_name}}! </p>
                                      <br>
                                      <p><strong>But you can make it on time next time! </strong> </p>
                                      <br>
                                      <p>Your were a bit {{$attendance_today->code_name}} today!</p>
                                    </div>
                                @elseif($attendance_today->code_name === 'Absent')
                                    <div class="alert alert-danger">
                                      <p><strong>We miss you {{$student->first_name}}! </p>
                                      <br>
                                      <p><strong>Hope you are doing great! </strong> </p>
                                      <br>
                                      <p>Your were {{$attendance_today->code_name}} tody. We look forward to seeing your awesome face tomorrow. </p>
                                    </div>
                                @endif

                                                          
                                <div class="footer">
                                    
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-users" aria-hidden="true"></i> There are {{$class_members_count}} students in your class.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="header">
                                <h4 class="title"><strong>Courses by term</strong></h4>
                                <p class="category"> School Year: &nbsp;&nbsp;{{ $school_year->school_year}}</p>
                            </div>
                            <br>
                            <div class="row>">
                             <div class="alert alert-success" style="margin-right: 2%; margin-left: 2%">
                                      
                                <p>Selecet a term to view courses and grades.</p>

                            </div>
                            </div>
                            <div class="content">
                                <table class="table table-striped">
                                    <thead>
                                        <th>TERM</th>
                                        <th>START DATE</th>
                                        <th>END DATE</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($terms as $term)

                                        <tr>
                                            <td><strong><a href="{{asset('/terms/' .Crypt::encrypt($term->id)) }}" >{{ $term->term }}</a></strong></td>
                                            <td>{{ $term->start_date->toFormattedDateString() }}</td>
                                            <td>{{ $term->end_date->toFormattedDateString() }}</td>
                                           
                                        </tr>
                                     @endforeach
                                        
                                    </tbody>
                                </table>

                                <div class="footer">
                                    <div class="chart-legend">
                                        <i class="fa fa-circle text-info"></i> 
                                        <strong>
                                           @foreach ($terms as $term)
                                                    @if ($today->between($term->start_date, $term->show_until ))
                                                        Current Term: {{ $term->term }}
                                                    @endif
                                                    
                                                @endforeach
                                        </strong>
                                    </div>
                                    <hr>
                                    
                                    <div class="stats">
                                        
                                        <p>You can view courses by term by selecting a term or click on the current course link on the left sidebar panel to view your current courses.</p>
                                    </div>
                                  
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="card">
                            <div class="header">
                                <h4 class="title"><strong>Year Statistics</strong></h4>
                                <p class="category">
                                    {{@$school_year->school_year}} School Year
                                </p>
                            </div>
                            <div class="content">

                            {!! $school_class_student_chart->render() !!}
                                
                                



                                <div class="footer">
                                   <div class="chart-legend">
                                        <i class="fa fa-circle text-primary"></i> Minimum: {{@$school_min}}
                                        <i class="fa fa-circle text-danger"></i> Maximum: {{@$school_max}}
                                        <i class="fa fa-circle text-warning"></i> Average: {{number_format(@$school_avg, 1)}}
                                        
                                    </div> 
                                    <hr>
                                   <div class="stats">
                                        <i class="ti-reload"></i> 
                                        @foreach ($terms as $term)
                                        @if ($today->between($term->start_date, $term->show_until ))
                                            Current Term: {{ $term->term }} 
                                        @endif
                                        
                                    @endforeach 
                                    <p>Above bar charts show your curent term statistics(Minimum, Maximum, and Average) so far for the {{@$school_year->school_year}} School Year. It gives an indication on how you are doing compared to the rest of your class and the school as a whole. The graph is dynamic - it will change from time to time as new grades are entered and as some grades are edited or deleted.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                     
                   
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Class Members </h4>
                                <p class="category">Class teacher : {{@$student_teacher->first_name}} {{@$student_teacher->last_name}} </p>
                                
                            </div>
                            <div class="content">
                                <table class="table table-striped">
                                    <thead>
                                        <th>Faces</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        
                                    </thead>
                                    <tbody>
                                        
                                         @foreach ($class_members as $member)

                                            

                                        <tr>
                                            <td>
                                            @foreach($all_users as $st_user)

                                                @if($member->registration_code == $st_user->registration_code)

                                                <img class="avatar border-white" src="{{asset('assets/img/students/'.$st_user->avatar) }}" alt="..."/>
                                                @if($st_user->registration_code == $user->registration_code)
                                                    Awesome You!
                                                @endif
                                            @endif
                                        @endforeach
                                            </td>
                                            <td>{{$member->first_name }} </td>
                                            <td> {{ $member->last_name }}</td>
                                            
                                           
                                        </tr>

                                            
                                     @endforeach
                                        
                                    </tbody>
                                </table>
                                {{-- <div class="pagination"> {{ $class_members->links() }} </div> --}}
                                <div class="footer">
                                    
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-users" aria-hidden="true"></i> There are {{$class_members_count}} students in your class.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card" >
                            <div class="header">
                                <div class="row">
                                    <div class="col-md-8">
                                    <h5 class="title"><strong>
                                      
                                            @foreach ($terms as $term)
                                                        @if ($today->between($term->start_date, $term->show_until ))
                                                           Events: {{ $term->term }}
                                                        @endif
                                                        
                                                    @endforeach
                                                </strong></h5>
                                        </div>
                                        <div class="col-md-4">
                                                <h5 class="title pull-right"> {{ @$student_group->name}}</h5>
                                        </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-4 ">
                                       <p class="text-info alert alert-success">Active: {{ @$active_events }}</p>
                                    </div>
                                    <div class="col-md-4"> 
                                       <p class="text-success alert alert-info"> Upcomming: {{ @$upcomming_events}}</p>
                                    </div> 
                                    <div class="col-md-4">
                                       <p class="text-danger alert alert-warning" >Expired: {{ @$expired_events}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="content">
                              <table class="table table-striped">
                                    <thead>
                                        <th>#</th>
                                        <th>Type</th>
                                        <th>Description</th>
                                        <th>Start Date</th>
                                        <th>End date</th>
                                        <th>Status</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($events as $key => $event)

                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $event->type }}</td>
                                            <td>{{ $event->description }}</td>
                                            <td>{{ $event->start_date->toFormattedDateString() }}</td>
                                            <td>{{ $event->end_date->toFormattedDateString() }}</td>
                                            <td>
                                              @if($today->between(@$event->start_date, @$event->end_date))
                                              Active
                                              @elseif($today->lt(@$event->start_date))
                                              Up Comming
                                              @elseif($today->gt(@$event->end_date))
                                              Expired
                                              @endif

                                            </td>
                                           
                                        </tr>
                                     @endforeach
                                        
                                    </tbody>
                                </table>
                                <div class="pagination"> {{ $events->links() }} </div>

                            </div>
                        </div>
                        </div>


                    
                   
                </div>

                </div>
            </div>
        </div>
 </div>
</div>
@endsection
