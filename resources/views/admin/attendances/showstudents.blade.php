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
       @if($term->id == $current_term->id)
        <div class="row">

          <div class="col-md-12">
            <div class="card">
              <div class="header">
                  <h4 class="title">Take Attendance for today: {{$today->toFormattedDateString()}}</h4>
                  <p class="category">Class: {{@\App\StafferRegistration::where('school_year_id', '=', $schoolyear->id)->where('term_id', '=', $term->id)->where('staffer_id', $teacher->id)->first()->group->name }} </p>
                  <p class="category">Current Term: {{$term->term}} </p>
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
                    
                      @foreach (@$join_students_regs->where('term_id', $term->id)->where('group_id', \App\StafferRegistration::where('school_year_id', '=', $schoolyear->id)->where('term_id', '=', $term->id)->where('staffer_id', '=', $teacher->id)->first()->group_id ) as $key => $reg_student)

                                                             
                          <tr>

                            <td>{{$number_init++}}</td>

                            
                            <td>
                            @foreach ($all_users as $st_user)

                              @if ($reg_student->registration_code === $st_user->registration_code )

                                <img class="avatar border-white" src="{{asset('assets/img/students/'.$st_user->avatar) }}" alt="..."/>
                                
                              @endif
                              
                            @endforeach

                            </td>
                            <td>{{$reg_student->student->first_name}}</td>

                            <td>{{$reg_student->student->last_name}}</td>
                           
                            <td>
                            @foreach($attendances as $attendance)

                              @if($attendance->student_id == $reg_student->student_id && $attendance->day == $today->format('Y-m-d') )

                                 {{$attendance->day}}

                                @endif

                            @endforeach

                            
                           </td>

                           <td>
                            @foreach($attendances as $attendance)

                              @foreach($attendancecodes as $attendancecode)

                               @if($attendance->student_id == $reg_student->student_id && $attendance->day == $today->format('Y-m-d') )

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

                               @if($attendance->student_id == $reg_student->student_id && $attendance->day == $today->format('Y-m-d') )

                                @if($attendance->attendance_code_id == $attendancecode->id)

                                {{$attendance->teacher_comment}}
                                  
                                @endif

                              @endif

                            @endforeach
                            
                            @endforeach
                           </td>

                                                               
                                                                     
                            <td>


                            <strong><a href="{{asset('/attendances/addattendance/'.Crypt::encrypt($reg_student->student_id)) }}/{{$schoolyear->id}}/{{$term->id}}"><i class="fa fa-plus fa-2x" aria-hidden="true"></i>&nbsp;&nbsp;Take attendance</a>
                           
                            </td>
                            <td>
                            @foreach($attendances as $attendance)

                              @if($attendance->student_id == $reg_student->student_id  && $attendance->day == $today->format('Y-m-d'))

                            <strong><a href="{{asset('/attendances/editattendance/'.Crypt::encrypt($attendance->id)) }}/{{$schoolyear->id}}/{{$term->id}}"><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i>&nbsp;&nbsp;edit attendance</a></strong>

                              @endif

                            @endforeach
                           
                            </td>

                            <td>
                            @foreach($attendances as $attendance)
                              @if($attendance->student_id == $reg_student->student_id  && $attendance->day == $today->format('Y-m-d'))
                                <strong>
                                <a href="{{asset('/attendances/postattendancedelete/'.Crypt::encrypt($attendance->id)) }}/{{$schoolyear->id}}/{{$term->id}}" onclick="return confirm('Are you sure you want to Delete this record?')">
                                <i class="fa fa-times fa-2x" aria-hidden="true"></i>&nbsp;&nbsp;
                                Delete attendance
                                </a>
                                </strong>
                              @endif
                            @endforeach
                            </td>
                          </tr>

                            
                          @endforeach 
                                                                                               
                  </tbody>
                </table>
              </div>
              <hr>
              </div>
            </div>
          </div>
        </div>
      @else

      <div class="row">
        <div class="col-md-12">
        <div class="alert alert-danger">
          <h5><strong>Term Ended!</strong> This term has ended. You can no longer take attendances for this term. Please go to <a href="{{ url('/attendances/showstudents/'.$current_school_year->id) }}/{{$current_term->id}}"><strong>current term</strong></a></h5>
        </div>
        </div>
      </div>
        
      @endif
    </div>
  </div>
            
@endsection
