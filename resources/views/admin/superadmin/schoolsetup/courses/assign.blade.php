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
                        <h3 class="header smaller lighter blue">Assign <strong>{{@$course->course_code}}: {{@$course->name}}</strong> to an instructor
                            <div class="pull-right">
	                            <a href="{{asset('/schoolsetup/showcourses/'.$group->id)}}/{{$term->id}}">
	                                <button type="submit" class="btn btn-primary">Back</button>
	                            </a>
                            </div>
                        </h3>
                    </div>
                    
                    <div class="row">
					<div class="col-xs-12 col-sm-6">
							<div class="widget-box">
								<div class="widget-header">
									<h4 class="widget-title">Assign an Instructor to {{@$course->course_code}}: {{@$course->name}}</h4>

								</div>

								<div class="widget-body">
									<div class="widget-main">
										
									<form class="form-group" action="{{ url('/schoolsetup/postassigncourse', [$course->id, $course->group_id, $course->term_id] )}}" method="POST">
                      						{{ csrf_field() }}
                      					

										<ul class="list-group">
											 <li class="list-group-item justify-content-between active">
										    Course Details
										   
										  <li class="list-group-item justify-content-between">
										    <strong>Course Code</strong>
										    <span class="badge badge-default badge-pill">{{$course->course_code}}</span>
										  </li>
										  <li class="list-group-item justify-content-between">
										    <strong>Course Name</strong>
										    <span class="badge badge-default badge-pill">{{$course->name}}</span>
										  </li>
										  <li class="list-group-item justify-content-between">
										    <strong>Class</strong>
										    <span class="badge badge-default badge-pill">{{$group->name}}</span>
										  </li>
										  <li class="list-group-item justify-content-between">
										    <strong>Term</strong>
										    <span class="badge badge-default badge-pill">{{$term->term}}</span>
										  </li>
										</ul>
									
										<div>
											<label for="form-field-select-3">Select an Instructor</label>

											<br />
											<select name="staffer_id" class="chosen-select form-control" id="form-field-select-3" data-placeholder="Select an Instructor...">
												<option selected disabled>Please select one option</option>
                                                    @foreach($staffers as $key => $staffer)

                                                        <option value="{{ $key+1 }}" >
                                                            {{ $staffer->first_name }} {{ $staffer->last_name }}
                                                        </option>

                                                    @endforeach
											</select>

										</div>
										<div class="form-actions center">
											<button type="submit" class="btn btn-sm btn-success">
												<strong>Assign Selected Instructor to Course</strong>
												<i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
											</button>
										</div>

									</div>
								</form>
								<hr>

								 <div class="alert-danger">
                            		<ul>
                                        @foreach($errors->all() as $error)

                                          <li> {{ $error }}</li>

                                        @endforeach

                                      </ul>

                                  </div>
								</div>
							</div>
						</div><!-- /.span -->
					</div><!-- /.row -->

					<div class="space-24"></div>
                </div><!-- /.page-content -->
            </div><!-- /.row -->
        </div><!-- /.main-content -->
    </div>

@endsection
