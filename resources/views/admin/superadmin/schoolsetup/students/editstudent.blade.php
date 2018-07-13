@extends('admin.superadmin.dashboard')

@section('content')


                        <div class="page-header">
                            <h1>
                               Editing {{$student->first_name}} {{$student->last_name}}
                               <hr>
                                @include('flash::message')
                                                                
                            </h1>
                        </div><!-- /.page-header -->

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="widget-box">
                                    <div class="widget-header">
                                        <h4 class="widget-title">Editing  {{$student->first_name}} {{$student->last_name}}</h4>
                                        
                                    </div>

                                    <div class="widget-body">
                                        <div class="widget-main">
                                <form class="form-group" action="{{ url('/schoolsetup/students/poststudentupdate', [$student->id]) }}" method="POST">
                            
                                    {{ csrf_field() }}

                                <div class="widget-body">
                                    <div class="widget-main">

                                        

                                            <label for="Student Number"><strong>Student #: {{$student->student_number}} </strong></label>

                                        <div class="row">
                                                
                                                <input class="form-control col-xs-10 col-sm-5" id="student_number" type="hidden" name="student_number" value="{{$student->student_number}}" />
                                                            
                                        </div>

                                        <hr />

                                        <label for="Reg Key"><strong>Registration Key: {{$student->registration_code}} </strong></label>

                                        <div class="row">
                                            
                                                    <input class="form-control col-xs-10 col-sm-5" id="registration_code" type="hidden" name="registration_code" value="{{$student->registration_code}}" />
                                                    
                                        </div>

                                        <hr />

                                             <label for="First Name"><strong>First name</strong></label>

                                                 <div class="row">
                                                    <div class="col-xs-8 col-sm-11">
                                                        <div class="input-group">
                                                            <input class="form-control" id="first_name" type="text" name="first_name" required="required" value="{{$student->first_name}}" />
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-user bigger-110"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <hr />

                                                <label for="Last Name"><strong>Last name</strong></label>

                                                <div class="row">
                                                    <div class="col-xs-8 col-sm-11">
                                                        <div class="input-group">
                                                            <input class="form-control" id="last_name" type="text" name="last_name" required="required" value="{{$student->last_name}}" />
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-user-o bigger-110"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <hr />



                                                <label for="Gender"><strong>Gender</strong></label>

                                                <div class="row">
                                                    <div class="col-xs-8 col-sm-11">
                                                        <div class="input-group">
                                                            <input class="form-control" id="gender" type="text" name="gender" required="required" value="{{$student->gender}}" />
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-genderless custom bigger-110"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <hr />

                                             <label for="Date of Birth"><strong>Date of Birth</strong></label>

                                                <div class="row">
                                                    <div class="col-xs-8 col-sm-11">
                                                        <div class="input-group">
                                                            <input class="form-control date-picker" id="dob" 
                                                           name="dob" type="text" data-date-format="yyyy-mm-dd" value="{{$student->dob->format('Y-m-d')}}" />
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-calendar bigger-110"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr />


                                            <label for="school-year"><strong>Enrollment Date</strong></label>

                                                        <div class="row">
                                                            <div class="col-xs-8 col-sm-11">
                                                                <div class="input-group">
                                                                    <input class="form-control date-picker" id="date_enrolled" name="date_enrolled" type="text" data-date-format="yyyy-mm-dd" value="{{$student->date_enrolled}}" />
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
                                                                    <input class="form-control" id="nationality" type="text" name="nationality" value="{{$student->nationality}}"/>
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
                                                                    <input class="form-control" id="national_card_number" type="" name="national_card_number" value="{{$student->national_card_number}}"/>
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
                                                                    <input class="form-control" id="passport_number" type="text" name="passport_number" value="{{$student->passport_number}}"/>
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
                                                                    <input class="form-control" id="phone" type="text" name="phone" value="{{$student->phone}}"/>
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
                                                                    <input class="form-control" id="parent_email" type="email" name="email"  value="{{$student->email}}" required="" />
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
                                                                    <input class="form-control" id="state" type="text" name="state" value="{{$student->state}}"/>
                                                                    <span class="input-group-addon">
                                                                        <i class="fa fa-map bigger-110"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <hr />

                                                <div class="row">
                                                            <div class="col-xs-8 col-sm-11">
                                                            <label for="school-year"><strong>Current Address</strong></label>

                                                            <div class="well well-lg">                                   {{$student->current_address}}
                                                            </div>

                                                             <label for="school-year"><strong>New Address</strong></label>
                                                            <textarea id="form-field-11" class="autosize-transition form-control" name="current_address" ></textarea>
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
