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
                          
                          <strong>From:</strong> {{$message->user->name}}
                          
                          <br>
                          <strong>Date received:</strong> {{$message->created_at}}
                         </small>
                          <div class="pull-right">
                              <a href="{{asset('/students/messages/replystudentmessage/'.$schoolyear->id)}}/{{$term->id}}/{{$message->id}}"><button type="button" class="btn btn-success">Reply Message</button></a>
                              <a href="{{asset('/students/messages/allstudents/'.$schoolyear->id)}}/{{$term->id}}"><button type="button" class="btn btn-info">BACK</button></a>
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
                          
                          @if($message->message_file != null)
                             <p><a href="{{ asset('messages/'. $message->message_file) }}" target="_blank"><i class="fa fa-file fa-2x"></i>&nbsp; View Attached File</a></p>
                          @else
                            <h5 class="title"><strong>No Attached File</strong></h5>
                          @endif 
                       </div>
                        <hr>
                       
                         
                         <form style="margin-bottom: 45px;" action="{{ url('students/messages/deletemessageforstaffer', [$schoolyear->id, $term->id, $message->id]) }}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="staffer_delete" value="1" >
                            <button type="submit" class="btn btn-danger pull-right">DELETE</button>
                          </form>
                        </div>
                      
                       <hr>
                        
                      </div>
   
                  </div>
                </div>
              </div>
            </div>
          </div>

@endsection