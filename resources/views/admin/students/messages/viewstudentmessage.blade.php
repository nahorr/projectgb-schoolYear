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
                          <h5 class="title"><strong>Subject:</strong> <span style="font: italic;">{{$message->subject}}</span></h5>
                         <small>
                          @foreach($all_user->where('id', '=', $message->sent_student) as $user)
                          <strong>From:</strong> {{$user->name}}
                          @endforeach
                          <br>
                          <strong>Date received:</strong> {{$message->created_at}}
                         </small>
                          <div class="pull-right">
                              <a href="{{asset('/students/messages/replystudentmessage/'.$message->id)}}"><button type="button" class="btn btn-success">Reply Message</button></a>
                              <a href="{{asset('/students/messages/studentmessages/'.$message->user_id)}}"><button type="button" class="btn btn-info">BACK</button></a>
                          </div>
                      </div>
                      <div class="content">
                        <hr>
                       <div class="header">
                          <h5 class="title"><strong>Body</strong></h5>
                          <blockquote>
                             <p>
                            {{$message->body}}
                             </p>
                            </blockquote>
                       </div>
                        <hr>

                        <div class="header">
                          <h5 class="title"><strong>View Attached File</strong></h5>
                          @if($message->message_file != null)
                             <p>
                              <a href="{{ asset('messages/'. $message->message_file) }}" target="_blank"><i class="fa fa-file fa-2x"></i></a>
                            
                             </p>
                          @endif 
                       </div>
                        <hr>
                       
                         
                         <form style="margin-bottom: 45px;" action="{{ url('students/messages/deletemessageforstaffer', [$message->id, $message->user_id]) }}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="staffer_delete" value="1" >
                            <button type="submit" class="btn btn-danger pull-right">DELETE</button>
                          </form>
                        </div>
                      
                       
                        
                      </div>
   
                  </div>
                </div>
              </div>
            </div>
          </div>

@endsection