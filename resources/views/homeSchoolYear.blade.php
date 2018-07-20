@extends('layouts.dashboard')

@section('content')

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                     @include('layouts.includes.headdashboardtop')
                </div>

                @if($schoolyear->id == $current_school_year->id)
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
                                    <div class=" col-md-6 alert alert-danger">
                                      <p><strong>We miss you {{$student->first_name}}! </p>
                                      <br>
                                      <p><strong>Hope you are doing great! </strong> </p>
                                      <br>
                                      <p>Your were {{$attendance_today->code_name}} tody. We look forward to seeing your awesome face tomorrow. </p>
                                    </div>
                                @endif

                                    <div class="well well-sm">
                                      <a href="{{url('/attendances/'.$schoolyear->id)}}" class="btn btn-primary btn-lg">View  {{$schoolyear->school_year}} attendance records</a>
                                      
                                    </div>
                                    
                               
                                                          
                                <div class="footer">
                                    
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-users" aria-hidden="true"></i>

                                        Total # of records in  {{$schoolyear->school_year}}: {{ $attendance_records->where('student_id', $student->id)->count() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @else

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">{{$schoolyear->school_year}} Attendance Records </h4>
                                <p class="category"> </p>
                                <div class="stats">
                                    <i class="fa fa-calendar-check-o" aria-hidden="true"></i> View  {{$schoolyear->school_year}} attendance records.
                                </div>
                            </div>
                            <div class="content">
                            <div class="well well-sm">
                                <a href="{{url('/attendances/'.$schoolyear->id)}}" class="btn btn-primary btn-lg">View  {{$schoolyear->school_year}} attendance records</a>
                            </div> 
                                                          
                                <div class="footer">
                                    
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-users" aria-hidden="true"></i> Total # of records in  {{$schoolyear->school_year}}: {{ $join_term_attendance->where('student_id', $student->id)->where('school_year_id', $schoolyear->id)->count() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @endif

                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="header">
                                <h4 class="title"><strong>Courses by term</strong></h4>
                                <p class="category"> School Year: &nbsp;&nbsp;{{ $schoolyear->school_year}}</p>
                            </div>
                            <br>
                            <div class="row>">
                             <div class="alert alert-success" style="margin-right: 2%; margin-left: 2%">
                                      
                                <p>Selecet a term to view courses and grades.</p>

                            </div>
                            </div>
                            <div class="content">
                                <table class="table table-hover table-bordered  table-striped">
                                    <thead>
                                        <th>TERM</th>
                                        <th>START DATE</th>
                                        <th>END DATE</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($terms as $schoolyear_term)

                                            @if($schoolyear_term->school_year_id == $schoolyear->id)

                                        <tr>
                                            <td><strong><a href="{{asset('/showtermcourses/'.$schoolyear->id) }}/{{Crypt::encrypt($schoolyear_term->id)}}">{{ $schoolyear_term->term }}</a></strong></td>
                                            <td>{{ $schoolyear_term->start_date->toFormattedDateString() }}</td>
                                            <td>{{ $schoolyear_term->end_date->toFormattedDateString() }}</td>
                                           
                                        </tr>
                                            @endif
                                         
                                        @endforeach
                                        
                                    </tbody>
                                </table>

                                <div class="footer">
                                    <div class="chart-legend">
                                        <i class="fa fa-circle text-info"></i>
                                        @if($schoolyear->id == $current_school_year->id) 
                                            <strong>Current Term: {{ $current_term->term }}</strong>
                                        @else
                                            Terms Ended
                                        @endif
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
                                    {{@$schoolyear->school_year}} School Year
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
                                        <i class="fa fa-university"></i>
                                        @if($schoolyear->id == $current_school_year->id) 
                                            <strong>Current School Year: {{ $current_school_year->school_year }}</strong>
                                        @else
                                            This School Year has Ended
                                        @endif 
                                       
                                    <p>Above bar charts show your curent term statistics(Minimum, Maximum, and Average) so far for the {{@$school_year->school_year}} School Year. It gives an indication on how you are doing compared to the rest of your class and the school as a whole. The graph is dynamic - it will change from time to time as new grades are entered and as some grades are edited or deleted.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                     
                   
                    </div>
                    @if($schoolyear->id == $current_school_year->id)
                    <div class="row">
                        <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Current Class Members </h4>
                                <p class="category">Current Class teacher : {{@$students_teacher_current->staffer->first_name}} {{@$students_teacher_current->staffer->last_name}} </p>
                                
                            </div>
                            <div class="content">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <th>Faces</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        
                                    </thead>
                                    <tbody>
                                        
                                         @foreach ($class_members_current as $member)

                                            

                                        <tr>
                                            <td>
                                            @foreach($all_users as $st_user)

                                                @if($member->student->registration_code == $st_user->registration_code)

                                                <img class="avatar border-white" src="{{asset('assets/img/students/'.$st_user->avatar) }}" alt="..."/>
                                                @if($st_user->registration_code == Auth::user()->registration_code)
                                                    Awesome You!
                                                @endif
                                            @endif
                                        @endforeach
                                            </td>
                                            <td>{{$member->student->first_name }} </td>
                                            <td> {{ $member->student->last_name }}</td>
                                            
                                           
                                        </tr>

                                            
                                     @endforeach
                                        
                                    </tbody>
                                </table>
                                {{-- <div class="pagination"> {{ $class_members->links() }} </div> --}}
                                <div class="footer">
                                    
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-users" aria-hidden="true"></i> There are {{ $class_members_current->count()}} students in your class.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

            </div>
        </div>
@endsection
