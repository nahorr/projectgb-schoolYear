@extends('admin.dashboard')

@section('content')
        <div class="content">
            <div class="container-fluid">
            <div class="row">
                    @include('admin.includes.headdashboardtop')
                </div> 


                <div class="row">

                    <div class="col-lg-4 col-md-5">
                        <div class="card card-user">
                            <div class="image">
                                <img src="{{asset('/assets/img/background.jpg')}}" alt="..."/>
                            </div>
                            <div class="content">
                                <div class="author">
                                  <img class="avatar border-white" src="{{asset('/assets/img/staffers/'.$admin_user->avatar) }}" alt="..."/>
                                  <h4 class="title">{{ $admin_user->name }}<br />
                                     
                                  </h4>
                                  <form enctype="multipart/form-data" action="/admin/profile" method="POST">
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
                                <h4 class="title">{{$teacher->first_name}}&nbsp;{{$teacher->last_name}} Profile</h4>
                            </div>
                            <div class="content">
                                <form>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Class</label>
                                                <input type="text" class="form-control border-input" disabled value="{{$group_teacher->name}}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>teacher #</label>
                                                <input type="text" class="form-control border-input" disabled value="{{$teacher->registration_code}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email address</label>
                                                <input type="email" class="form-control border-input" disabled value="{{$admin_user->email}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>First Name</label>
                                                <input type="text" class="form-control border-input" disabled value="{{$teacher->first_name}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Last Name</label>
                                                <input type="text" class="form-control border-input" disabled value="{{$teacher->last_name}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <input type="text" class="form-control border-input" disabled value="{{$teacher->current_address}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>City</label>
                                                <input type="text" class="form-control border-input" disabled value="{{$teacher->state}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Country</label>
                                                <input type="text" class="form-control border-input" disabled value="{{$teacher->nationality}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Postal Code</label>
                                                <input type="text" class="form-control border-input" disabled value="{{$teacher->phone}}">
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