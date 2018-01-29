@extends('admin.superadmin.dashboard')

@section('content')


    <div class="page-header">
        <h1>
            Add a Course
            <hr>
            <strong>
                <i class="ace-icon fa fa-university fa-2x"></i>
                School Year: {{$schoolyear->school_year}}
            </strong>
            @include('flash::message')
            
        </h1>
    </div><!-- /.page-header -->

    <form class="form-group" action="{{ url('/schoolsetup/postcourse', [ $schoolyear->id, $term->id, $group->id]) }}" method="POST">

		{{ csrf_field() }}

        <div class="row">
            <div class="col-sm-6">
                <div class="widget-box">
                    <div class="widget-header">
                        <h4 class="widget-title">Add {{$group->name}} course for {{$term->term}}</h4>
                        <span class="widget-toolbar">
                            <strong><a href="{{ URL::previous() }}">
                                <i class="ace-icon fa fa-arrow-left fa-2x"></i>
                                Back
                            </a></strong>
                        </span>
                        
                        
                    </div>

                    <div class="widget-body">
                        <div class="widget-main">

                        <label for="school-year">Term : {{$term->term}}</label>

                            <div class="row">
                                <div class="col-xs-8 col-sm-11">
                                    <div class="input-group">
                                        
                                        <input class="form-control" id="term_id" type="hidden" name="term_id" value="{{$term->id}}" />
                                        
                                    </div>
                                </div>
                            </div>

                            <hr />

                            <label for="school-year">Group: {{$group->name}}</label>

                            <div class="row">
                                <div class="col-xs-8 col-sm-11">
                                    <div class="input-group">
                                        
                                        <input class="form-control" id="group_id" type="hidden" name="group_id" value="{{$group->id}}" />
                                        
                                    </div>
                                </div>
                            </div>

                            <hr />

                         <label for="school-year">Course Code</label>

                            <div class="row">
                                <div class="col-xs-8 col-sm-11">
                                    <div class="input-group">
                                        
                                        <input class="form-control" id="course_code" type="text" name="course_code" placeholder="eg. ENG3B6B"  required="" />
                                        
                                    </div>
                                </div>
                            </div>

                            <hr />


                        <label for="school-year">Course Name</label>

                            <div class="row">
                                <div class="col-xs-8 col-sm-11">
                                    <div class="input-group">
                                        
                                        <input class="form-control" id="course" type="text" name="name" placeholder="eg. English"  required="" />
                                        
                                    </div>
                                </div>
                            </div>

                            <hr />

                            
                            <div class="clearfix form-actions">
								<div class="col-md-offset-3 col-md-9">
									
									<input type="submit" value="Submit">

									&nbsp; &nbsp; &nbsp;
									<button class="btn" type="reset">
										<i class="ace-icon fa fa-undo bigger-110"></i>
										Reset
									</button>
								</div>
							</div>
                
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </form>



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
