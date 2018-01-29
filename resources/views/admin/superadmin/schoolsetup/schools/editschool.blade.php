@extends('admin.superadmin.dashboard')

@section('content')


                        <div class="page-header">
                            <h1>
                               Adding School
                               <hr>
                                @include('flash::message')
                                                                
                            </h1>
                        </div><!-- /.page-header -->

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="widget-box">
                                    <div class="widget-header">
                                        <h4 class="widget-title">Adding  School to {{ $schoolyear->school_year}} School year</h4>
                                        
                                    </div>

                                    <div class="widget-body">
                                        <div class="widget-main">
                                <form class="form-group" action="{{ url('/schoolsetup/schools/postschoolupdate', [$school->id]) }}" method="POST">
                            
                                    {{ csrf_field() }}

                                                     <label for="school-year"><strong>School Name</strong></label>

                                                         <div class="row">
                                                            <div class="col-xs-8 col-sm-11">
                                                                <div class="input-group">
                                                                    <input class="form-control" id="name" type="text" name="name" value="{{$school->name}}" />
                                                                    <span class="input-group-addon">
                                                                        <i class="fa fa-user bigger-110"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <hr />


                                                        
                                                         <div class="row">
                                                            <div class="col-xs-8 col-sm-11">
                                                            <label for="school-address"><strong>Current School Address</strong></label>

                                                            <div class="well well-lg">
                                                                {{$school->address}}
                                                            </div>

                                                             <label for="school-motto"><strong>New School Address</strong></label>
                                                            <textarea id="form-field-11" class="autosize-transition form-control" name="address" ></textarea>
                                                        </div>
                                                        </div>

                                                        <hr />

                                                         <label for="school-year"><strong>City</strong></label>

                                                        <div class="row">
                                                            <div class="col-xs-8 col-sm-11">
                                                                <div class="input-group">
                                                                    <input class="form-control" id="city" type="text" name="city" value="{{$school->city}}"/>
                                                                    <span class="input-group-addon">
                                                                        <i class="fa fa-map bigger-110"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <hr />

                                                        <label for="school-year"><strong>State</strong></label>

                                                        <div class="row">
                                                            <div class="col-xs-8 col-sm-11">
                                                                <div class="input-group">
                                                                    <input class="form-control" id="state" type="text" name="state" value="{{$school->state}}"/>
                                                                    <span class="input-group-addon">
                                                                        <i class="fa fa-map bigger-110"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <hr />

                                                       
                                                        <label for="school-year"><strong>Postal Code</strong></label>

                                                        <div class="row">
                                                            <div class="col-xs-8 col-sm-11">
                                                                <div class="input-group">
                                                                    <input class="form-control" id="postal_code" type="text" name="postal_code" value="{{$school->postal_code}}"/>
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
                                                                    <input class="form-control" id="phone" type="text" name="phone" value="{{$school->phone}}"/>
                                                                    <span class="input-group-addon">
                                                                        <i class="fa fa-phone bigger-110"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <hr />

                                                       

                                                         <label for="school-year"><strong>Email</strong></label>

                                                        <div class="row">
                                                            <div class="col-xs-8 col-sm-11">
                                                                <div class="input-group">
                                                                    <input class="form-control" id="email" type="email" name="email" value="{{$school->email}}" />
                                                                    <span class="input-group-addon">
                                                                        <i class="fa fa-user-o bigger-110"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <hr />

                                                         <div class="row">
                                                            <div class="col-xs-8 col-sm-11">
                                                            <label for="school-motto"><strong>Current School Motto</strong></label>

                                                            <div class="well well-lg">
                                                                {{$school->motto}}
                                                            </div>

                                                             <label for="school-motto"><strong>New School Motto</strong></label>
                                                            <textarea id="form-field-11" class="autosize-transition form-control" name="motto" ></textarea>
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
