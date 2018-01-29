@extends('admin.superadmin.dashboard')

@section('content')


                        <div class="page-header">
                            <h1>
                                Add event
                                <hr>
                                @include('flash::message')
                                
                            </h1>
                        </div><!-- /.page-header -->

                        	<form class="form-group" action="{{ url('/schoolsetup/events/postevent') }}" method="POST">
                            
									{{ csrf_field() }}

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="widget-box">
                                                <div class="widget-header">
                                                    <h4 class="widget-title">Add event for {{$schoolyear->school_year}} School Year </h4>
                                                    <span class="widget-toolbar">
                                                        <a href="{{asset('/schoolsetup/events/showevents')}}">
                                                            <i class="ace-icon fa fa-cog"></i>
                                                            Edit event
                                                        </a>

                                                    </span>
                                                    
                                                    
                                                </div>

                                                <div class="widget-body">
                                                    <div class="widget-main">


                                                 
                                                    <label for="eventtype"><strong>Select event Type</strong></label>
                                                    <div class="row">
                                                            <div class="col-xs-8 col-sm-11">
                                                                <div class="input-group">

                                                        <select name="eventtype_id" id="eventtype_id">
                                                            @foreach($eventtypes as $key=>$eventtype)

                                                                <option value="{{ $key }}">
                                                                    {{ $eventtype }}
                                                                </option>

                                                            @endforeach
                                                        </select>
                                                        </div>
                                                        </div>
                                                        </div>
                                                   
                                                    <hr />


                                                    <label for="group"><strong>Select Group</strong></label>
                                                    <div class="row">
                                                            <div class="col-xs-8 col-sm-11">
                                                                <div class="input-group">
                                                                    
                                                                     <select name="group_id" id="group_id">
                                                                        @foreach($groups as $key=>$group)

                                                                            <option value="{{ $key }}">
                                                                                {{ $group }}
                                                                            </option>

                                                                        @endforeach
                                                                     </select>
                                                                                                                        
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <hr />

                                                 <label for="term"><strong>Select Term</strong></label>
                                                    <div class="row">
                                                            <div class="col-xs-8 col-sm-11">
                                                                <div class="input-group">
                                                                    
                                                                     <select name="term_id" id="term_id">
                                                                        @foreach($terms as $key=>$term)

                                                                            <option value="{{ $key }}">
                                                                                {{ $term }}
                                                                            </option>

                                                                        @endforeach
                                                                    </select>
                                                                                                                        
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <hr />

                                                    <label for="school-year">Event Details</label>

                                                        <div class="row">
                                                            <div class="col-xs-8 col-sm-11">
                                                          
                                                            <textarea id="form-field-11" class="autosize-transition form-control" name="description"></textarea>
                                                        </div>
                                                        </div>

                                                        <hr />


                                                    <label for="school-year">Start Date</label>

                                                        <div class="row">
                                                            <div class="col-xs-8 col-sm-11">
                                                                <div class="input-group">
                                                                    <input class="form-control date-picker" id="start_date" name="start_date" type="text" data-date-format="yyyy-mm-dd" />
                                                                    <span class="input-group-addon">
                                                                        <i class="fa fa-calendar bigger-110"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <hr />

                                                        <label for="school-year">End Date</label>

                                                        <div class="row">
                                                            <div class="col-xs-8 col-sm-11">
                                                                <div class="input-group">
                                                                    <input class="form-control date-picker" id="end_date" name="end_date" type="text" data-date-format="yyyy-mm-dd" />
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
