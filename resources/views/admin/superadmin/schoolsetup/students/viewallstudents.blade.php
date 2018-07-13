@extends('admin.superadmin.dashboard')

@section('content')


    <div class="page-header">
        <h1>
           Add/Upload New Students
           <div class="pull-right"><a href="{{asset('/schoolsetup/students/showgroups') }}"><button type="button" class="btn btn-danger btn-lg"><i class="fa fa-plus"></i>  REGISTER STUDENTS</button></a></div>
           <hr>
           <div class="pull-right"><a href="{{asset('/schoolsetup/students/addnewstudents') }}"><button type="button" class="btn btn-warning btn-lg"><i class="fa fa-plus"></i>  ADD NEW STUDENTS</button></a></div>
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
             Upload New Students
            </h3>
           <form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 20px;" action="{{ URL::to('/schoolsetup/students/importstudents') }}" class="form-horizontal" method="post" enctype="multipart/form-data">

                <input type="file" name="import_file" />
                {{ csrf_field() }}
                <br/>

                <button class="btn btn-primary">Upload New Students</button>

            </form>
            <br/>
                                                                     
        </h1>
        <div class="row">
              <div class="col-md-12">
              <div class="alert alert-info">
                <h5 style=""><strong>Download sample file to use as template to upload <strong style="color: #FF0000;"></strong> students. </strong><a href="{{ URL::to( '/sample-files/sample-students-upload.ods')  }}" target="_blank"><i class="fa fa-hand-o-right fa-2x" aria-hidden="true"></i><strong style="color: #FF0000">Sample Student File</strong></a></h5>
                Please use <strong style="color: #FF0000;">open office</strong> for best result. Excel may throw some errors due to white spaces.
              </div>
              </div>
            </div>

    </div><!-- /.page-header -->

    <div class="row">
        <div class="col-sm-12">
            <div class="widget-box">
                <div class="widget-header">
                    <h4 class="widget-title">Showing all students in Your School </h4>
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
                                <th>Edit</th>
                                <th>Delete</th>
                            </thead>
                            <tbody>
                                @foreach ($students as $key=>$student)

                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>
                                        <strong><a href="{{asset('/schoolsetup/students/studentdetails/'.$student->id) }}">
                                            {{ $student->student_number }}
                                        </a></strong>
                                    </td>
                                    <td>{{ $student->first_name }}</td>
                                    <td>{{ $student->last_name }}</td>
                                    <td>{{ $student->gender }}</td>
                                    <td>{{ $student->dob->toFormattedDateString() }}</td>
                                    <td>
                                        @if($student->date_graduated != null)
                                            Graduated: {{$student->date_graduated}}
                                        @elseif($student->date_unenrolled != null)
                                            UnEnrolled {{$student->date_unenrolled}}
                                        @else
                                            Enrolled {{$student->date_enrolled}}
                                        @endif
                                    </td>
                                    <td>{{ $student->phone }}</td>
                                    <td>{{ $student->email }}</td>
                                    <td>{{ $student->state }}</td>
                                    
                                    <td><strong><a href="{{asset('/schoolsetup/students/editstudent/'.$student->id) }}"><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true">                                                           
                                    </i></a></strong>
                                    </td>
                                    <td><strong><a href="{{asset('/schoolsetup/students/poststudentdelete/'.$student->id) }}" onclick="return confirm('Are you sure you want to Delete this record?')"><i class="fa fa-trash fa-2x" aria-hidden="true">                                                           
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
