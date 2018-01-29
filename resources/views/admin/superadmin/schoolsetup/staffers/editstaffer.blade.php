@extends('admin.superadmin.dashboard')

@section('content')


                        <div class="page-header">
                            <h1>
                               Editing Teacher
                               <hr>
                                @include('flash::message')
                                                                
                            </h1>
                        </div><!-- /.page-header -->

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="widget-box">
                                    <div class="widget-header">
                                        <h4 class="widget-title">Editing  Teacher for  {{ $schoolyear->school_year}} School year</h4>
                                        
                                    </div>

                                    <div class="widget-body">
                                        <div class="widget-main">
                                <form class="form-group" action="{{ url('/schoolsetup/staffers/poststafferupdate', [$staffer->id]) }}" method="POST">
                            
                                    {{ csrf_field() }}

                                                <div class="widget-body">
                                                    <div class="widget-main">

                                                    <label for="school-year"><strong>Registration Key: {{$staffer->registration_code}}</strong></label>

                                                        <div class="row">
                                                            <div class="col-xs-8 col-sm-11">
                                                                <div class="col-sm-9">

                                                                    <input class="form-control" id="registration_code" type="hidden" name="registration_code" value="{{$staffer->registration_code}}" />
                                                                   
                                                            </div>
                                                        </div>

                                                        <hr />


                                                    <label for="school-year"><strong>Select Group</strong></label>
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

                                                        
                                                    <label for="school-year"><strong>Title</strong></label>

                                                         <div class="row">
                                                            <div class="col-xs-8 col-sm-11">
                                                                <div class="input-group">
                                                                    <input class="form-control" id="title" type="text" name="title" value="{{$staffer->title}}"/>
                                                                    <span class="input-group-addon">
                                                                        <i class="fa fa-user bigger-110"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <hr />

                                                     <label for="school-year"><strong>First name</strong></label>

                                                         <div class="row">
                                                            <div class="col-xs-8 col-sm-11">
                                                                <div class="input-group">
                                                                    <input class="form-control" id="first_name" type="text" name="first_name" required="required" value="{{$staffer->first_name}}" />
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
                                                                    <input class="form-control" id="last_name" type="text" name="last_name" required="required" value="{{$staffer->last_name}}" />
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
                                                                    <input class="form-control" id="gender" type="text" name="gender" value="{{$staffer->gender}}" />
                                                                    <span class="input-group-addon">
                                                                        <i class="fa fa-genderless custom bigger-110"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <hr />

                                                     

                                                    <label for="school-year"><strong>Employment Status</strong></label>

                                                        
                                                        <div class="row">
                                                            <div class="col-xs-8 col-sm-11">
                                                                <div class="input-group">
                                                                    <input class="form-control" id="employment_status" type="text" name="employment_status" value="{{$staffer->employment_status}}"/>
                                                                    <span class="input-group-addon">
                                                                        <i class="fa fa-info-circle bigger-110"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <hr />

                                                        <label for="school-year"><strong>Employment Date</strong></label>

                                                        <div class="row">
                                                            <div class="col-xs-8 col-sm-11">
                                                                <div class="input-group">
                                                                    <input class="form-control date-picker" id="date_of_employment" name="date_of_employment" type="text" data-date-format="yyyy-mm-dd" value="{{$staffer->date_of_employment}}" />
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
                                                                    <input class="form-control" id="nationality" type="text" name="nationality" value="{{$staffer->nationality}}"/>
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
                                                                    <input class="form-control" id="national_card_number" type="" name="national_card_number" value="{{$staffer->national_card_number}}"/>
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
                                                                    <input class="form-control" id="passport_number" type="text" name="passport_number" value="{{$staffer->passport_number}}"/>
                                                                    <span class="input-group-addon">
                                                                        <i class="fa fa-id-card-o bigger-110"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <hr />

                                                        <label for="school-year"><strong>Phone</strong></label>

                                                        <div class="row">
                                                            <div class="col-xs-8 col-sm-11">
                                                                <div class="input-group">
                                                                    <input class="form-control" id="phone" type="text" name="phone" value="{{$staffer->phone}}"/>
                                                                    <span class="input-group-addon">
                                                                        <i class="fa fa-phone bigger-110"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <hr />

                                                        <label for="school-year"><strong>State</strong></label>

                                                        <div class="row">
                                                            <div class="col-xs-8 col-sm-11">
                                                                <div class="input-group">
                                                                    <input class="form-control" id="state" type="text" name="state" value="{{$staffer->state}}"/>
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

                                                            <div class="well well-lg">{{$staffer->current_address}}
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
