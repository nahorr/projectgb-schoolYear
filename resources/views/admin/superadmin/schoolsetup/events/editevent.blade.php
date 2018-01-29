@extends('admin.superadmin.dashboard')

@section('content')


                        <div class="page-header">
                            <h1>
                                Edit event
                                <hr>
                                @include('flash::message')
                                
                            </h1>
                        </div><!-- /.page-header -->

                        	<form class="form-group" action="{{ url('/schoolsetup/events/posteventupdate', [$event->id, $group->id, $term->id, $eventtype->id]) }}" method="POST">
                            
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

                                                    
                                                    <label for="school-year"><strong>event TYPE : {{$eventtype->event_type}}</strong></label>

                                                        <div class="row">
                                                            <div class="col-xs-8 col-sm-11">
                                                                <div class="input-group">
                                                                    
                                                                    <input class="form-control" id="eventtype_id" type="hidden" name="eventtype_id" value="{{$eventtype->id}}"  required="" />
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <hr />

                                                        <label for="school-year"><strong>GROUP : {{$group->name}}</strong></label>

                                                        <div class="row">
                                                            <div class="col-xs-8 col-sm-11">
                                                                <div class="input-group">
                                                                    
                                                                    <input class="form-control" id="group_id" type="hidden" name="group_id" value="{{$group->id}}"  required="" />
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <hr />

                                                        <label for="school-year"><strong>TERM : {{$term->term}}</strong></label>

                                                        <div class="row">
                                                            <div class="col-xs-8 col-sm-11">
                                                                <div class="input-group">
                                                                    
                                                                    <input class="form-control" id="term_id" type="hidden" name="term_id" value="{{$term->id}}"  required="" />
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <hr />


                                                    <div class="row">
                                                            <div class="col-xs-8 col-sm-11">
                                                            <label for="school-year"><strong>Current Event Details</strong></label>

                                                            <div class="well well-lg">{{$event->description}}
                                                            </div>

                                                             <label for="school-year"><strong>New Event Description</strong></label>
                                                            <textarea id="form-field-11" class="autosize-transition form-control" name="description"></textarea>
                                                        </div>
                                                        </div>

                                                        <hr />

                                                        <hr />

                                                  

                                                    <label for="school-year">Start Date</label>

                                                        <div class="row">
                                                            <div class="col-xs-8 col-sm-11">
                                                                <div class="input-group">
                                                                    <input class="form-control date-picker" id="start_date" name="start_date" type="text" data-date-format="yyyy-mm-dd" value="{{$event->start_date->format('Y-m-d')}}" />
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
                                                                    <input class="form-control date-picker" id="end_date" name="end_date" type="text" data-date-format="yyyy-mm-dd" value="{{$event->end_date->format('Y-m-d')}}" />
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
