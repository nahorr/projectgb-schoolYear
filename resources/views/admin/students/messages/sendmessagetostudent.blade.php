@extends('admin.dashboard')

@section('content')

        <div class="content">
          <div class="container-fluid">
            <div class="row">
                 @include('admin.includes.headdashboardtop')
            </div>
            @include('flash::message')
            <hr>

              <div class="col-md-8 col-md-offset-2">
                  <div class="card">
                      <div class="header">
                          <h4 class="title">
                            <button type="button" class="btn btn-info">Sending Message to {{$user->name}}</button>
                            <div class="pull-right"><a href="{{asset('/students/messages/showstudents/'.$schoolyear->id)}}/{{$term->id}}"><button type="button" class="btn btn-info">Back</button></a></div>
                          </h4>
                          
                      </div>
                      <hr>
                      <div class="content">
                       
                         <form class="form-group" action="{{ url('/students/messages/postsendmessagetostudent', [$schoolyear->id, $term->id, $user->id]) }}" method="POST"  enctype="multipart/form-data" style="border: 5px solid #5bc2df; border-radius: 4px;">
                              {{ csrf_field() }}
                            <br>
                            <input type="hidden" class="form-control border-input" name="user_id" value="{{$user->id}}" >
                            <input type="hidden" class="form-control border-input" name="staffer_id" value="{{Auth::guard('web_admin')->user()->id}}" >
                            <input type="hidden" class="form-control border-input" name="sent_to_student" value="{{$user->id}}" >
                          <div class="row">
                        
                             
                              <div class="col-md-9 col-md-offset-1">
                                  <div class="form-group">
                                      <label><strong>Subject</strong></label>
                                      <input type="text" class="form-control border-input" name="subject" required="">
                                  </div>
                              </div>
                            </div> 
                            <hr>
                            <div class="row">
                              <div class="col-md-9 col-md-offset-1">
                                  <div class="form-group">
                                      <label><strong>Write a message</strong> </label>
                                      <div class="form-group">
                                        <textarea class="form-control" name="body" id="body" rows="3" required=""></textarea>
                                      </div>
                                  </div>
                              </div>
                             <hr>
                            </div>
                            <div class="row">
                            <div class="col-md-6 col-md-offset-1">
                              <div class="form-group">
                                <label><strong>Upload File or picture</strong> </label>
                                <input type="file" name="message_file" id="message_file">
                                <p class="help-block">Please upload a file or picture if any(jpg,png,doc,pdf only).</p>
                            </div>
                         </div>
                     </div>
                     <hr>
                         <div class="row">
                            <div class="col-md-6 col-md-offset-1">                                  
                          <div class="">
                              <input type="submit" class="btn btn-primary" value="Submit">
                          </div>
                          <div class="clearfix"></div>
                      </div>
                    </div>
                    <br>
                    </form>
                    <hr>

                       <br>

                      <div class="alert-danger">
                  
                          <ul>
                            @foreach($errors->all() as $error)

                              <li> {{ $error }}</li>

                            @endforeach

                          </ul>

                      </div> 
                      </div>
                      
                       
                        
                      </div>
   
                  </div>
                </div>
              </div>
            </div>
          </div>

@endsection