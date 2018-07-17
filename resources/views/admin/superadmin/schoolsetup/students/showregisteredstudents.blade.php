@extends('admin.superadmin.dashboard')

@section('content')


    <div class="page-header">
        <h1>
           Register <span style="color: darkred;">{{$group->name}}</span> Students in Bulk for <span style="color: darkred;">{{$current_term->term}} {{$current_school_year->school_year}}</span> school year.
           <hr>
           @include('flash::message')
           <hr>

           @include('flash::message')
            @if ($message = Session::get('success'))
                <div class="alert alert-success" role="alert">
                    {{ Session::get('success') }}
                </div>
            @endif

            @if ($message = Session::get('error'))
                <div class="alert alert-danger" role="alert">
                    {{ Session::get('error') }}
                </div>
            @endif

            <h3> <i class="ace-icon fa fa-cloud-upload fa-2x"></i>
             Upload and Bulk Register Students into {{$group->name}} for {{$current_term->term}} {{$current_school_year->school_year}} school year.
            </h3>
           <form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 20px;" action="{{ URL::to('/schoolsetup/students/importregisterstudents', [$group->id]) }}" class="form-horizontal" method="post" enctype="multipart/form-data">

                <input type="file" name="import_file" />
                {{ csrf_field() }}
                <br/>

                <button class="btn btn-primary">Upload & Bulk Register {{$group->name}} Students for {{$current_term->term}} {{$current_school_year->school_year}}</button>
                <hr>
                <div class="row">
                  <div class="col-md-12">
                  <div class="alert alert-info">
                    <h5 style=""><strong>Download sample file to use as template to upload and register <strong style="color: #FF0000;">{{@$group->name}}</strong> students for {{$current_term->term}} {{$current_school_year->school_year}} school year. </strong><a href="{{ URL::to( '/sample-files/sample-studentsregistration-upload.ods')  }}" target="_blank"><i class="fa fa-hand-o-right fa-2x" aria-hidden="true"></i><strong style="color: #FF0000">Sample Bulk Student Registration File</strong></a></h5>
                    Please use <strong style="color: #FF0000;">open office</strong> for best result. Excel may throw some errors due to white spaces.
                  </div>
                  </div>
                </div>
            </form>

             <br>
        <div class="row">
              <div class="col-md-12">
                <div class="alert alert-info">
                <h5 style="">
                  <strong>Downlod Staffers and Registration Codes: <br>

                  <a href="{{ URL::to('/schoolsetup/students/downloadExcelStudents/xls') }}"><button class="btn btn-success">Download Students xls</button></a>
                  <a href="{{ URL::to('/schoolsetup/students/downloadExcelStudents/xlsx') }}"><button class="btn btn-success">Download Students xlsx</button></a>
                  <a href="{{ URL::to('/schoolsetup/students/downloadExcelStudents/csv') }}"><button class="btn btn-success">Download Students CSV</button></a>

              </h5>
                </div>
              </div>
          </div>
            <br/>
           
           <strong><a href="{{asset('/schoolsetup/students/addstudent/'.$group->id)}}">
             <i class="ace-icon fa fa-plus-circle fa-2x"></i>
                Register a Student
            </a></strong>
           
            
                                            
        </h1>
            

    </div>

       <div class="row">
        <div class="col-sm-12">
            <div class="widget-box">
                <div class="widget-header">
                    <h4 class="widget-title" style="color: darkred"><strong>Register a Student into {{$group->name}} - {{$current_term->term}} {{$current_school_year->school_year}} </strong></h4>
                </div>

                <div class="widget-body">
                    <div class="widget-main">

                        <form class="form-group" method="POST" action="{{ url('/schoolsetup/students/postregisterstudent' ) }}">
                                {{ csrf_field() }}
                         

                            <div class="row">
                                <div class="form-group col-md-4" style="display: none;">
                                  <label for="Name">School Year:</label>
                                  <input type="hidden" class="form-control" name="school_year_id" id="school_year_id" value="{{ $current_school_year->id}}">
                                </div>
                            </div>
                            <div class="row">
                              <div class="form-group col-md-4" style="display: none;">
                                <label for="Club">Term:</label>
                                <input type="hidden" class="form-control" name="term_id" id="term_id" value="{{$current_term->id}}">
                              </div>
                            </div>

                            <div class="row">
                              <div class="form-group col-md-4">
                                <label for="Club"><span style="color: darkred">Group Name: {{$group->name}}</span></label>
                                <input type="hidden" class="form-control" name="group_id" id="group_id" value="{{$group->id}}">
                              </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-5">
                                  <label for="Name">Select A Student:</label>
                                    <select name="student_id" class="chosen-select form-control" id="student_id" data-placeholder="Select a Student..." >
                                        <option selected disabled> Please select one Class</option>
                                            

                                              @foreach($students as $student)

                                                <option value="{{ $student->id }}">

                                                  
                                                  {{$student->registration_code}}({{$student->first_name}} {{$student->last_name}})
                                                  @foreach($current_students_registrations as $current_student_registration)
                                                     @if($student->id == $current_student_registration->student_id)
                                                        - Registered in {{$current_student_registration->group->name}}
                                                    @endif
                                                  @endforeach 
                                                 
                                                </option>

                                              @endforeach      
                                            
                                    </select>
                                </div>
                            </div>
                                    
                         
                         
                            <button  class="btn btn-success" id="submit">Submit Registration</button>
                         
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

   <hr

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="widget-box">
                                    <div class="widget-header">
                                        <h4 class="widget-title">Showing all students in {{$group->name}} this term {{$current_term->term}} and school year, {{$current_school_year->school_year}}.  </h4>
                                        <span class="widget-toolbar">
                                            <a href="">
                                                <i class="ace-icon fa fa-users"></i>
                                                of students: 
                                            </a>

                                        </span>
                                                    
                                        
                                    </div>

                                    <div class="widget-body">
                                        <div class="widget-main">

                                    	   <table class="table table-striped table-bordered table-hover">
                                                <thead>
                                                    <th>#</th>
                                                    <th>Student #</th>
                                                    <th>First Name</th>
                                                    <th>Last Name</th>
                                                    <th>Gender</th>
                                                    <th>DoB</th>
                                                    <th>Status</th>
                                                    <th>Parent Phone</th>
                                                    <th>Parent Email</th>
                                                    <th>State</th>                                               
                                                    <th>Delete Registration</th>
                                                </thead>
                                                <tbody>
                                                    @foreach ($current_students_registrations->where('group_id', '=', $group->id) as $key=>$registered_student)

                                                    <tr>
                                                        <td>{{ $key+1 }}</td>
                                                        <td>
                                                            {{ $registered_student->registration_code }}
                                                            <strong><a href="{{asset('/schoolsetup/students/studentdetails/'.$registered_student->student_id) }}">
                                                                <button type="button" class="btn btn-sm btn-warning">View</button>
                                                            </a></strong>
                                                           
                                                        </td>
                                                        
                                                        <td>{{ $registered_student->student->first_name }}</td>
                                                        <td>{{ $registered_student->student->last_name }}</td>
                                                        <td>{{ $registered_student->student->gender }}</td>
                                                        <td>{{ $registered_student->student->dob->toFormattedDateString() }}</td>
                                                        <td>
                                                            @if($registered_student->student->date_graduated != null)
                                                                Graduated: {{$registered_student->student->date_graduated}}
                                                            @elseif($registered_student->student->date_unenrolled != null)
                                                                UnEnrolled {{$registered_student->student->date_unenrolled}}
                                                            @else
                                                                Enrolled {{$registered_student->student->date_enrolled}}
                                                            @endif

                                                        </td>
                                                        <td>{{ $registered_student->student->phone }}</td>
                                                        <td>{{ $registered_student->student->email }}</td>
                                                        <td>{{ $registered_student->student->state }}</td>
                                                        
                                                        <td><strong><a href="{{asset('/schoolsetup/students/postdeleteregisterstudent/'.$registered_student->id) }}" onclick="return confirm('Are you sure you want to Delete this record?')"><i class="fa fa-trash fa-2x" aria-hidden="true">                                                           
                                                        </i></a></strong>
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
