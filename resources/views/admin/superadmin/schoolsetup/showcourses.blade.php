@extends('admin.superadmin.dashboard')

@section('content')


    <div class="page-header">
        <h1>
           Add/Edit/Upload {{$term->term}} Courses for {{$group->name}}
           <hr>
            <strong>
                <i class="ace-icon fa fa-university fa-2x"></i>
                School Year: {{$current_school_year->school_year}}
            </strong>
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
             Upload {{$term->term}} Courses for {{$group->name}}
            </h3>
           <form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 20px;" action="{{ URL::to('/schoolsetup/importcourses', [$group->id, $term->id]) }}" class="form-horizontal" method="post" enctype="multipart/form-data">

                <input type="file" name="import_file" />
                {{ csrf_field() }}
                <br/>

                <button class="btn btn-primary">Upload Courses</button>

            </form>
            <br/>
            <div class="row">
              <div class="col-md-12">
              <div class="alert alert-info">
                <h5 style=""><strong>Download sample file to use as template to upload <strong style="color: #FF0000;">{{@$term->term}}</strong> courses for <strong style="color: #FF0000;">{{@$group->name}}</strong>. </strong><a href="{{ URL::to( '/sample-files/sample-courses-upload.ods')  }}" target="_blank"><i class="fa fa-hand-o-right fa-2x" aria-hidden="true"></i><strong style="color: #FF0000">Sample Course file</strong></a></h5>
                Please use <strong style="color: #FF0000;">open office</strong> for best result. Excel may throw some errors due to white spaces.
              </div>
              </div>
            </div>

           
                                            
        </h1>
    </div><!-- /.page-header -->

    <div class="row">
        <div class="col-sm-8">
            <div class="widget-box">
                <div class="widget-header">
                    <h4 class="widget-title">Showing {{$term->term}} Courses for {{$group->name}} </h4>
                   
                    <span class="widget-toolbar">
                        <strong><a href="{{asset('/schoolsetup/addcourse/'.$schoolyear->id) }}/{{$term->id}}/{{$group->id}}">
                            <i class="ace-icon fa fa-pencil-square-o fa-2x"></i>
                            Add Course
                        </a></strong>
                    </span>
                    <span class="widget-toolbar">
                        <strong><a href="{{ URL::previous() }}">
                            <i class="ace-icon fa fa-arrow-left fa-2x"></i>
                            Back
                        </a></strong>
                    </span>
                </div>

                <div class="widget-body">
                    <div class="widget-main">

                	   <table class="table table-striped table-bordered">
                            <thead>
                                <th>Course Code</th>
                                <th>Course Name</th>
                                <th>Course Instructor</th>
                                <th>Assign/unAssign Instructor</th>
                                <th>Edit Course</th>
                                <th>Delete Course</th>

                                
                                
                            </thead>
                            <tbody>
                                @foreach ($courses as $course)
                                    

                                <tr>
                                    <td>{{ $course->course_code }}</td>
                                    <td>{{ $course->name }}</td>
                                    <td>
                                        @foreach ($staffers->where('id', '=', $course->staffer_id) as $staffer)
                                            
                                                {{ @$staffer->first_name }} {{ @$staffer->last_name }}
                                           
                                         @endforeach
                                    </td>
                                    <td>
                                        @if($course->staffer_id == null)
                                            <a href="{{asset('/schoolsetup/assigncourse/'.$schoolyear->id) }}/{{$course->id}}/{{$course->group_id}}/{{$course->term_id}}" class="btn btn-info" role="button"><strong>Assign To an Instructor</strong></a>
                                        @else
                                        <form class="form-group" action="{{ url('/schoolsetup/postunassigncourse', [$course->id] )}}" method="POST">
                                          {{ csrf_field() }}
                                          <input id="staffer_id" name="staffer_id" type="hidden" value="null">
                                          <input type="submit" value="usAssign this Instructor" style="color: red">
                                        </form>
                                            
                                        @endif
                                    </td>
                                    <td><strong><a href="{{asset('/schoolsetup/editcourse/'.$schoolyear->id) }}/{{$course->id}}/{{$term->id}}/{{$group->id}}"><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i></a></strong>
                                    </td>
                                    <td><strong><a href="{{asset('/schoolsetup/postcoursedelete/'.$course->id) }}" onclick="return confirm('Are you sure you want to Delete this record?')"><i class="danger fa fa-trash-o fa-2x" aria-hidden="true" style="color:red"></i></a></strong>
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
