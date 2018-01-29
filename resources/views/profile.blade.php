@extends('layouts.dashboard')

@section('content')
        <div class="content">
            <div class="container-fluid">
            <div class="row">
                    @include('layouts.includes.headdashboardtop')
                </div>


                <div class="row">

                    <div class="col-lg-4 col-md-5">
                        <div class="card card-user">
                            <div class="image">
                                <img src="{{asset('assets/img/background.jpg')}}" alt="..."/>
                            </div>
                            <div class="content">
                                <div class="author">
                                  <img class="avatar border-white" src="{{asset('assets/img/students/'.$user->avatar) }}" alt="..."/>
                                  <h4 class="title">{{ $user->name }}<br />
                                     <a href="#"><small>@Studentname</small></a>
                                  </h4>
                                  <form enctype="multipart/form-data" action="/profile" method="POST">
                                      <div class="form-group">
                                        <label>Update Profile Image</label>
                                        <input type="file" class="form-control-file" name="avatar" style="margin-left: 28%; margin-right: 35%; padding-top: 5px; padding-bottom: 5px;">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                      </div>
                                  </form>
                                </div>
                                
                            </div>
                            <hr>
                           
                        </div>
                        
                    </div>

                    <div class="col-lg-8 col-md-7">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">{{$student->first_name}}&nbsp;{{$student->last_name}}'s Profile</h4>
                            </div>
                            <div class="content">
                                <form>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Class</label>
                                                <input type="text" class="form-control border-input" disabled value="{{$student_group->name}}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Student #</label>
                                                <input type="text" class="form-control border-input" disabled value="{{$student->registration_code}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email address</label>
                                                <input type="email" class="form-control border-input" disabled value="{{$user->email}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>First Name</label>
                                                <input type="text" class="form-control border-input" disabled value="{{$student->first_name}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Last Name</label>
                                                <input type="text" class="form-control border-input" disabled value="{{$student->last_name}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <input type="text" class="form-control border-input" disabled value="{{$student->current_address}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>City</label>
                                                <input type="text" class="form-control border-input" disabled value="{{$student->state}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Country</label>
                                                <input type="text" class="form-control border-input" disabled value="{{$student->nationality}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Postal Code</label>
                                                <input type="text" class="form-control border-input" disabled value="{{$student->phone}}">
                                            </div>
                                        </div>
                                    </div>

                                   
                                   
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
                    


                </div>
            </div>
        </div>
        
@endsection