@extends('admin.dashboard')

@section('content')

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                     @include('admin.includes.headdashboardtop')
                </div>
                <div class="row">
                  <div class="col-md-12">
                  <div class="alert alert-info">
                    <h5><strong>Registration Alert!</strong> If student's face does not display, It means that the student is yet to register. Please remind the student to register.</h5>
                  </div>
                  </div>
                </div>
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Take Attendance for today: {{$today->toFormattedDateString()}}</h4>
                                <p class="category">Class: {{$group_teacher->name}} </p>
                                @foreach ($terms as $term)

                                    @if($today->between($term->start_date, $term->show_until))

                                <p class="category">Current Term: {{$term->term}} </p>
                                @endif
                                @endforeach
                                <p class="category">Attendance Date: {{$today->toFormattedDateString()}} </p>
                            </div>
                            <div class="content">
                            <div class="table-responsive">
                          <table class="table table-bordered table-hover" table-responsive>
                            <thead>
                              <tr class="info">
                                <th>#</th>
                                <th>Faces</th>
                                <th>First Name</th>
                                <th>Last name</th>
                                <th>Day</th>
                                <th>Present/Absent/Late</th>
                                <th>Teacher's Comment</th>
                                <th>Add attendance</th>
                                <th>Edit attendance</th>
                                <th>Delete attendance</th>

                              </tr>
                            </thead>
                            <tbody>
                                    @foreach($students_in_group as $key => $student)

                                      @foreach ($terms as $term)

                                            @if($today->between($term->start_date, $term->show_until))

                                                                           
                                    <tr>

                                      <td>{{$key+1}}</td>

                                      
                                      <td>
                                      @foreach ($all_user as $st_user)

                                        @if ($student->registration_code === $st_user->registration_code )

                                          <img class="avatar border-white" src="{{asset('assets/img/students/'.$st_user->avatar) }}" alt="..."/>
                                          
                                    
                                        
                                        @endif
                                        
                                      @endforeach

                                      </td>
                                      <td>{{$student->first_name}}</td>

                                      <td>{{$student->last_name}}</td>
                                     
                                      <td>
                                      @foreach($attendances as $attendance)

                                        @if($attendance->student_id == $student->id && $attendance->day == $today->format('Y-m-d') )

                                           {{$attendance->day}}

                                          @endif

                                      @endforeach

                                      
                                     </td>

                                     <td>
                                      @foreach($attendances as $attendance)

                                        @foreach($attendancecodes as $attendancecode)

                                         @if($attendance->student_id == $student->id && $attendance->day == $today->format('Y-m-d') )

                                          @if($attendance->attendance_code_id == $attendancecode->id)

                                          {{$attendancecode->code_name}}
                                            
                                          @endif

                                        @endif

                                      @endforeach
                                      
                                      @endforeach
                                     </td>

                                      <td>
                                      @foreach($attendances as $attendance)

                                        @foreach($attendancecodes as $attendancecode)

                                         @if($attendance->student_id == $student->id && $attendance->day == $today->format('Y-m-d') )

                                          @if($attendance->attendance_code_id == $attendancecode->id)

                                          {{$attendance->teacher_comment}}
                                            
                                          @endif

                                        @endif

                                      @endforeach
                                      
                                      @endforeach
                                     </td>

                                                                         
                                                                               
                                      <td>


                                      <strong><a href="{{asset('/attendances/addattendance/'.Crypt::encrypt($student->id)) }}"><i class="fa fa-plus fa-2x" aria-hidden="true"></i>&nbsp;&nbsp;Take attendance</a>
                                     
                                      </td>
                                      <td>
                                      @foreach($attendances as $attendance)

                                        @if($attendance->student_id == $student->id  && $attendance->day == $today->format('Y-m-d'))

                                      <strong><a href="{{asset('/attendances/editattendance/'.Crypt::encrypt($student->id)) }}"><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i>&nbsp;&nbsp;edit attendance</a></strong>

                                        @endif

                                      @endforeach
                                     
                                      </td>

                                      <td>
                                      @foreach($attendances as $attendance)
                                        @if($attendance->student_id == $student->id  && $attendance->day == $today->format('Y-m-d'))
                                          <strong>
                                          <a href="{{asset('/attendances/postattendancedelete/'.Crypt::encrypt($attendance->id)) }}" onclick="return confirm('Are you sure you want to Delete this record?')">
                                          <i class="fa fa-times fa-2x" aria-hidden="true"></i>&nbsp;&nbsp;
                                          Delete attendance
                                          </a>
                                          </strong>
                                        @endif
                                      @endforeach
                                      </td>
                                    </tr>

                                       @endif
                                    @endforeach                                                                        
                                  @endforeach
                               
                            </tbody>
                          </table>
                        </div>
                                
                                
                                    <hr>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              
                </div>
            </div>
        </div>

@endsection
