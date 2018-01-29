@extends('admin.superadmin.dashboard')

@section('content')


                        <div class="page-header">
                            <h1>
                               Add/Edit {{$term->term}} Courses for {{$group->name}}
                               <hr>

                                            <strong><a href="{{asset('/schoolsetup/addgroup')}}">
                                                <i class="ace-icon fa fa-cloud-upload fa-2x"></i>
                                                Upload Courses
                                            </a></strong>
                                       
                               <hr>
                                @include('flash::message')
                                                                
                            </h1>
                        </div><!-- /.page-header -->

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="widget-box">
                                    <div class="widget-header">
                                        <h4 class="widget-title">Showing {{$term->term}} Courses for {{$group->name}} </h4>
                                       
                                        <span class="widget-toolbar">
                                            <strong><a href="{{asset('/schoolsetup/addcourse/'.$group->id) }}/{{$term->id}}">
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
                                                    <th>Edit Course</th>
                                                    <th>Delete Course</th>

                                                    
                                                    
                                                </thead>
                                                <tbody>
                                                    @foreach ($courses as $course)

                                                    <tr>
                                                        <td>{{ $course->course_code }}</td>
                                                        <td>{{ $course->name }}</td>
                                                        <td><strong><a href="{{asset('/schoolsetup/editcourse/'.$course->id) }}/{{$group->id}}/{{$term->id}}"><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i></a></strong>
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
