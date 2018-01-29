@extends('admin.superadmin.dashboard')

@section('content')


                        <div class="page-header">
                            <h1>
                               Adding Student
                               <hr>
                                @include('flash::message')
                                                                
                            </h1>
                        </div><!-- /.page-header -->

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="widget-box">
                                    <div class="widget-header">
                                        <h4 class="widget-title">Adding  student to {{$group->name}} Group for {{ $schoolyear->school_year}} School year</h4>
                                        
                                    </div>

                                    <div class="widget-body">
                                        <div class="widget-main">
                                <form class="form-group" action="{{ url('/schoolsetup/students/poststudent', [$group->id]) }}" method="POST">
                            
                                    {{ csrf_field() }}

                                                <div class="widget-body">
                                                    <div class="widget-main">

                                                    <div class="form-group">
                                                    <label for="school-year"><strong>Group: {{$group->name}}</strong></label>

                                                        <div class="row">
                                                            <div class="col-xs-8 col-sm-11">
                                                                <div class="col-sm-9">
                                                                    
                                                                    <input class="form-control col-xs-10 col-sm-5" id="group_id" type="hidden" name="group_id" value="{{$group->id}}" />
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                        <hr />

                                                        <label for="school-year"><strong>Registration Key</strong></label>

                                                        <div class="row">
                                                            <div class="col-xs-8 col-sm-11">
                                                                <div class="input-group">
                                                                    <input class="form-control" id="registration_code" type="text" name="registration_code" required="required" />
                                                                    <span class="input-group-addon">
                                                                        <i class="fa fa-key bigger-110"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <hr />

                                                     <label for="school-year"><strong>First name</strong></label>

                                                         <div class="row">
                                                            <div class="col-xs-8 col-sm-11">
                                                                <div class="input-group">
                                                                    <input class="form-control" id="first_name" type="text" name="first_name" required="required" />
                                                                    <span class="input-group-addon">
                                                                        <i class="fa fa-user bigger-110"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <hr />

                                                        <label for="school-year"><strong>Last name</strong></label>

                                                        <div class="row">
                                                            <div class="col-xs-8 col-sm-11">
                                                                <div class="input-group">
                                                                    <input class="form-control" id="last_name" type="text" name="last_name" required="required" />
                                                                    <span class="input-group-addon">
                                                                        <i class="fa fa-user-o bigger-110"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <hr />



                                                        <label for="school-year"><strong>Gender</strong></label>

                                                        <div class="row">
                                                            <div class="col-xs-8 col-sm-11">
                                                                <div class="input-group">
                                                                    <input class="form-control" id="gender" type="text" name="gender" required="required" />
                                                                    <span class="input-group-addon">
                                                                        <i class="fa fa-genderless custom bigger-110"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <hr />

                                                     <label for="school-year"><strong>Date of Birth</strong></label>

                                                        <div class="row">
                                                            <div class="col-xs-8 col-sm-11">
                                                                <div class="input-group">
                                                                    <input class="form-control date-picker" id="dob" 
                                                                   name="dob" type="text" data-date-format="yyyy-mm-dd" />
                                                                    <span class="input-group-addon">
                                                                        <i class="fa fa-calendar bigger-110"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr />


                                                    <label for="school-year"><strong>Enrollment Status</strong></label>

                                                        
                                                        <div class="row">
                                                            <div class="col-xs-8 col-sm-11">
                                                                <div class="input-group">
                                                                    <input class="form-control" id="status" type="text" name="status" required="required" />
                                                                    <span class="input-group-addon">
                                                                        <i class="fa fa-info-circle bigger-110"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <hr />

                                                        <label for="school-year"><strong>Enrollment Date</strong></label>

                                                        <div class="row">
                                                            <div class="col-xs-8 col-sm-11">
                                                                <div class="input-group">
                                                                    <input class="form-control date-picker" id="date_enrolled" name="date_enrolled" type="text" data-date-format="yyyy-mm-dd" />
                                                                    <span class="input-group-addon">
                                                                        <i class="fa fa-calendar bigger-110"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <hr />

                                                        <label for="school-year"><strong>Nationality</strong></label>

                                                        <div class="row">
                                                            <div class="col-xs-8 col-sm-11">
                                                                <div class="input-group">
                                                                    <input class="form-control" id="nationality" type="text" name="nationality" />
                                                                    <span class="input-group-addon">
                                                                        <i class="fa fa-flag bigger-110"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <hr />

                                                        <label for="school-year"><strong>ID Card #</strong></label>

                                                        <div class="row">
                                                            <div class="col-xs-8 col-sm-11">
                                                                <div class="input-group">
                                                                    <input class="form-control" id="national_card_number" type="" name="national_card_number" />
                                                                    <span class="input-group-addon">
                                                                        <i class="fa fa-address-card bigger-110"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <hr />

                                                        <label for="school-year"><strong>Passport #</strong></label>

                                                        <div class="row">
                                                            <div class="col-xs-8 col-sm-11">
                                                                <div class="input-group">
                                                                    <input class="form-control" id="passport_number" type="text" name="passport_number"/>
                                                                    <span class="input-group-addon">
                                                                        <i class="fa fa-id-card-o bigger-110"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <hr />

                                                        <label for="school-year"><strong>Parent Phone</strong></label>

                                                        <div class="row">
                                                            <div class="col-xs-8 col-sm-11">
                                                                <div class="input-group">
                                                                    <input class="form-control" id="phone" type="text" name="phone" />
                                                                    <span class="input-group-addon">
                                                                        <i class="fa fa-phone bigger-110"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <hr />

                                                        <label for="school-year"><strong>Parent Email</strong></label>

                                                        <div class="row">
                                                            <div class="col-xs-8 col-sm-11">
                                                                <div class="input-group">
                                                                    <input class="form-control" id="parent_email" type="email" name="email" required="" />
                                                                    <span class="input-group-addon">
                                                                        <i class="fa fa-envelope bigger-110"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <hr />

                                                        <label for="school-year"><strong>State</strong></label>

                                                        <div class="row">
                                                            <div class="col-xs-8 col-sm-11">
                                                                <div class="input-group">
                                                                    <input class="form-control" id="state" type="text" name="state"/>
                                                                    <span class="input-group-addon">
                                                                        <i class="fa fa-map bigger-110"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <hr />

                                                        <label for="school-year"><strong>Address</strong></label>

                                                        <div class="row">
                                                            <div class="col-xs-8 col-sm-11">
                                                          
                                                            <textarea id="form-field-11" class="autosize-transition form-control" name="current_address"></textarea>
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
                                       
                                </form>


                                    	  
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
