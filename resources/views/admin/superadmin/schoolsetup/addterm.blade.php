@extends('admin.superadmin.dashboard')

@section('content')

    <div class="page-header">
        <h1>
            Add Term - School Year: <span>{{$schoolyear->school_year}}</span>
            <hr>
            @include('flash::message')
            
        </h1>
    </div><!-- /.page-header -->

<form class="form-group" action="{{ url('/schoolsetup/postterm', [$schoolyear->id]) }}" method="POST">

		{{ csrf_field() }}

        <div class="row">
            <div class="col-sm-6">
                <div class="widget-box">
                    <div class="widget-header">
                        <h4 class="widget-title">Adding Term for <strong>{{$schoolyear->school_year}}</strong> School Year </h4>
                        <span class="widget-toolbar">
                            <a href="{{asset('/schoolsetup/showterms/'.$schoolyear->id)}}">
                                <i class="ace-icon fa fa-cog"></i>
                                Edit Term
                            </a>

                        </span>
                        
                        
                    </div>

                    <div class="widget-body">
                        <div class="widget-main">

                        <input class="form-control" id="school_year_id" type="hidden" name="school_year_id" value="{{$schoolyear->id}}" required="" />

                        <label for="school-year">Term </label>

                            <div class="row">
                                <div class="col-xs-8 col-sm-11">
                                    <div class="input-group">
                                        
                                        <input class="form-control" id="term" type="text" name="term" placeholder="eg. 1st Term"  required="" />
                                        
                                    </div>
                                </div>
                            </div>

                            <hr />

                            <label for="id-date-picker-1">Start Date (yyyy-mm-dd)</label>

                            <div class="row">
                                <div class="col-xs-8 col-sm-11">
                                    <div class="input-group">
                                        <input class="form-control date-picker" id="start_date" type="text" data-date-format="yyyy-mm-dd" name="start_date" required="" />
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar bigger-110"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <hr />

                            <label for="id-date-picker-1">End Date (yyyy-mm-dd)</label>
                            <div class="row">
                                <div class="col-xs-8 col-sm-11">
                                    <div class="input-group">
                                        <input class="form-control date-picker" id="end_date" type="text" data-date-format="yyyy-mm-dd" name="end_date" required="" />
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar bigger-110"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <hr />
                            <ul>
                            <li><label for="show_until">Show Until (yyyy-mm-dd)</label></li>
                            <li><label for="show_until">Set this to 1 day before next term's start date</label></li>
                            <li><label for="show_until">Make sure you add next school year before the current school year ends</label></li>
                            </ul>
                            <div class="row">
                                <div class="col-xs-8 col-sm-11">
                                    <div class="input-group">
                                        <input class="form-control date-picker" id="show_until" type="text" data-date-format="yyyy-mm-dd" name="show_until" required="" />
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar bigger-110"></i>
                                        </span>
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
